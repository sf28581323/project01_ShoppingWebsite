<?php require_once('./Connections/conn_db.php') ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once("./php_lib.php") ?>
<?php
if (!isset($_SESSION['login'])) {
    $sPath = "login.php?sPath=profile";
    header(sprintf("Location: %s", $sPath));
}
?>
<!doctype html>
<html lang="zh-TW">

<head>
    <?php require_once("./headfile.php") ?>
    <style type="text/css">
        .input-group>.form-control {
            width: 100%;
        }

        span.error-tips,
        span.error-tips::before {
            font-family: "Font Awesome 5 Free";
            color: red;
            font-weight: 900;
            content: "\f0c4";
        }

        span.valid-tips,
        span.valid-tips::before {
            font-family: "Font Awesome 5 Free";
            color: greenyellow;
            font-weight: 900;
            content: "\f00c";
        }

        .text-white {
            color: white;
        }
    </style>
</head>

<body>
    <section id="header">
        <?php require_once("./navbar.php") ?>
    </section>
    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <?php require_once("./accordion.php") ?>
                    <?php require_once("./hot.php") ?>
                </div>
                <div class="col-md-10">
                    <?php //require_once("profile_content.php") 
                    ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>會員資料修改頁面</h1>
                            <p>請輸入相關資料，*為必填欄位</p>
                        </div>
                    </div>
                    <div class="row" id="modify" name="modify">
                        <div class="col-8 offset-2 text-left">
                            <form id="reg" name="reg" action="" method="GET">
                                <div class="input-group mb-3">
                                    <input type="email" v-model="member.email" class="form-control" placeholder="請輸入email帳號" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" v-model="member.cname" name="cname" id="cname" class="form-control" placeholder="請輸入姓名" :readonly="readonly">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" v-model="member.tssn" name="tssn" id="tssn" class="form-control" placeholder="請輸入身分證字號" :readonly="readonly">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="date" v-model="member.birthday" name="birthday" id="birthday" outfocus="(this.type='date')" class="form-control" placeholder="請選擇生日" :readonly="readonly">
                                </div>
                                <label for="fileToUpload" class="form-label">上傳相片：</label>
                                <div class="input-group mt-3" v-show="!readonly">
                                    <input type="file" id="fileToUpload" name="fileToUpload" class="form-control" title="請上傳相片圖示" accept="image/png, image/jpeg, image/gif" style="width: 100%;">
                                    <p class="mt-1"><button type="button" class="btn btn-danger" id="uploadForm" name="uploadForm">開始上傳</button></p>
                                    <div id="progress-div01" class="progress" style="width:100%;display:none">
                                        <div id="progress-bar01" class="progress-bar progress-bar-striped" role="progressbar" style="width:0%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                    <input type="hidden" id="uploadname" name="uploadname" value="">
                                    <img id="showimg" name="showimg" src="" alt="photo" style="display:none;" class="img-fluid">
                                </div>
                                <div class="input-group mt-3" v-if="readonly">
                                    <img :src="`uploads/${(member.imgname)?member.imgname:'avatar.svg'}`" alt="photo" style="width: 20%;" :title="`檔名:${(member.imgname)?member.imgname:'avatar.svg'}`">
                                </div>
                                <div class="input-group mt-3" v-show="!readonly">
                                    <input type="hidden" v-model="captcha" id="captcha" name="captcha">
                                    <a href="javascript:void(0)" title="按我更新驗證" @click="getCaptcha();">
                                        <canvas id="can"></canvas>
                                    </a>
                                    <input type="text" id="recaptcha" name="recaptcha" class="form-control"
                                        placeholder="請輸入驗證碼">
                                </div>
                                <input type="hidden" id="formct1" name="formct1" value="reg">
                                <div class="input-group mt-3">
                                    <button type="button" class="btn btn-warning btn-lg me-2 text-white" @click="editMember"
                                        v-if="readonly">更新會員資料</button>
                                    <button type="button" class="btn btn-info btn-lg text-white" v-if="readonly" data-bs-toggle="modal" data-bs-target="#exampleModal">變更會員密碼</button>
                                    <button type="button" class="btn btn-primary btn-lg me-2 text-white" @click="saveMember" v-if="!readonly">儲存資料</button>
                                    <button type="button" class="btn btn-secondary btn-lg text-white" @click="readonly=true" v-if="!readonly">離開</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-user-lock me-2">會員密碼變更作業</i></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="changePW" name="changePW">
                                            <div class="mb-3">
                                                <label for="PWOld" class="form-label">請輸入舊密碼</label>
                                                <input type="password" class="form-control" id="PWOld" name="PWOld" placeholder="Current Password" v-model="PWOld">
                                            </div>
                                            <div class="mb-3">
                                                <label for="PWNew1" class="form-label">請輸入新密碼</label>
                                                <input type="password" class="form-control" id="PWNew1" name="PWNew1" placeholder="New Password" v-model="PWNew1">
                                            </div>
                                            <div class="mb-3">
                                                <label for="PWNew2" class="form-label">請再次確認新密碼</label>
                                                <input type="password" class="form-control" id="PWNew2" name="PWNew2" placeholder="Verify Password" v-model="PWNew2">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="mClose" name="mClose" type="button" class="btn btn-secondary" data-bs-dismiss="modal">離開</button>
                                        <button type="button" class="btn btn-primary" @click="savePW();">儲存</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="scontent">
        <?php require_once("./scontent.php") ?>
    </section>
    <section id="footer">
        <?php require_once("./footer.php") ?>
    </section>

    <?php require_once("./jsfile.php") ?>
    <script type="text/javascript" src="./jquery.validate.js"></script>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        const Vue3 = Vue.createApp({
            data() {
                return {
                    emailid: <?php echo $_SESSION['emailid']; ?>,
                    member: [],
                    captcha: '',
                    readonly: true,
                    PWOld: '',
                    PWNew1: '',
                    PWNew2: '',
                }
            },
            methods: {
                async savePW() {
                    let valid = $('#changePW').valid();
                    if (valid) {
                        await axios.get('reqchangePW.php', {
                                params: {
                                    emailid: this.member.emailid,
                                    PWNew1: MD5(this.PWNew1),
                                }
                            })
                            .then((res) => {
                                let data = res.data;
                                if (data.c == true) {
                                    $('#changePW').validate().resetForm();
                                    this.PWOld='';
                                    this.PWNew1='';
                                    this.PWNew2='';
                                    $('#mClose').click();
                                    alert(data.m);
                                }
                            })
                            .catch(function(error) {
                                alert(error);
                            });
                    }
                },
                async saveMember() {
                    let valid = $('#reg').valid();
                    if (valid) {
                        let imgfile = $('#uploadname').val();
                        if (imgfile != '') {
                            this.member.imgname = imgfile;
                        }
                        await axios.get('reqMember.php', {
                                params: {
                                    birthday: this.member.birthday,
                                    cname: this.member.cname,
                                    emailid: this.member.emailid,
                                    imgname: this.member.imgname,
                                    tssn: this.member.tssn,
                                }
                            })
                            .then((res) => {
                                let data = res.data;
                                if (data.c == true) {
                                    alert(data.m);
                                    location.reload();
                                }
                            })
                            .catch(function(error) {
                                alert(error);
                            });
                    }
                },
                editMember() {
                    this.readonly = false;
                },
                getMemberInfo() {
                    axios.get('memberinfo.php', {
                            params: {
                                emailid: this.emailid,
                            }
                        })
                        .then((res) => {
                            let data = res.data;
                            if (data.c == true) {
                                this.member = data.d[0];
                            } else {
                                alert(data.m);
                            }
                        })
                        .catch(function(error) {
                            alert("系統目前無法連接到後台資料庫");
                        });
                },
                getCaptcha() {
                    this.captcha = captchaCode("can", 150, 50, "blue", "white", "28px", 5);
                },
            },
            mounted() {
                this.getCaptcha();
                this.getMemberInfo();
            }
        });
        Vue3.mount('#modify');

        $(function() {
            jQuery.validator.addMethod("tssn", function(value, element, param) {
                var tssn = /^[A-Z][12]\d{8}$/;
                return this.optional(element) || (tssn.test(value));
            });
            $("#reg").validate({
                onfocusout: false,
                rules: {
                    cname: {
                        required: true,
                    },
                    tssn: {
                        required: true,
                        tssn: true
                    },
                    birthday: {
                        required: true,
                    },
                    recaptcha: {
                        required: true,
                        equalTo: "#captcha"
                    },
                },
                messages: {
                    cname: {
                        required: "姓名不得為空白",
                    },
                    tssn: {
                        required: "身分證字號不得為空白",
                        tssn: "身分證字號格式有誤"
                    },
                    birthday: {
                        required: "生日不得為空白",
                    },
                    recaptcha: {
                        required: "驗證碼不得為空白",
                        equalTo: "驗證碼不一致"
                    },
                },
            });
            $("#changePW").validate({
                rules: {
                    PWOld: {
                        required: true,
                        remote: 'checkPW.php?emailid=<?php echo $_SESSION['emailid']; ?>',
                    },
                    PWNew1: {
                        required: true,
                        maxlength: 20,
                        minlength: 4,
                    },
                    PWNew2: {
                        required: true,
                        equalTo: "#PWNew1",
                    },
                },
                messages: {
                    PWOld: {
                        required: '會員密碼不得空白！！',
                        remote: '原始密碼有誤，請重新輸入',
                    },
                    PWNew1: {
                        required: '密碼不得空白！！',
                        maxlength: '密碼最大長度為20',
                        minlength: '密碼最小長度為4',
                    },
                    PWNew2: {
                        required: '確認密碼不得空白！！',
                        equalTo: '兩次輸入密碼必須一致！',
                    },
                },
            });

            function getId(el) {
                return document.getElementById(el);
            }

            $("#uploadForm").click(function(e) {
                var fileName = $("#fileToUpload").val();
                var idxDot = fileName.lastIndexOf(".") + 1;
                let extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

                if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "gif") {
                    $("#progress-div01").css("display", "flex");
                    let file1 = getId("fileToUpload").files[0];
                    let formdata = new FormData();
                    formdata.append("file1", file1);
                    let ajax = new XMLHttpRequest();

                    ajax.upload.addEventListener("progress", progressHandler, false);
                    ajax.addEventListener("load", completeHandler, false);
                    ajax.addEventListener("error", errorHandler, false);
                    ajax.addEventListener("abort", abortHandler, false);

                    ajax.open("POST", "file_upload_parser.php");
                    ajax.send(formdata);

                    return false;
                } else {
                    alert("目前只支援 jpg、jpeg、png、gif 檔案格式上傳！");
                }
            });

            // 上傳進程顯示百分比
            function progressHandler(event) {
                let percent = Math.round((event.loaded / event.total) * 100);
                $("#progress-bar01").css("width", percent + "%");
                $("#progress-bar01").html(percent + "%");
            }

            // 上傳完成處理顯示圖片
            function completeHandler(event) {
                let data = JSON.parse(event.target.responseText);
                if (data.success == 'true') {
                    $("#uploadname").val(data.fileName);
                    $("#showimg").attr({
                        'src': 'uploads/' + data.fileName,
                        'style': 'display:block;'
                    });
                    $("button.btn.btn-danger").attr({
                        'style': 'display:none;'
                    });
                } else {
                    alert(data.error);
                }
            }

            function errorHandler(event) {
                alert('Upload Failed: 上傳時發生錯誤')
            }

            function abortHandler(event) {
                alert('Upload Failed: 上傳作業取消')
            }
        })
    </script>
</body>

</html>