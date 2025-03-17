<?php require_once('./Connections/conn_db.php') ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once("./php_lib.php") ?>
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
    </style>
</head>

<body>
    <section id="header">
        <?php require_once("./navbar.php") ?>
    </section>
    <?php
    if (isset($_POST['formct1']) && $_POST['formct1'] == 'reg') {
        // 取得表單資料
        $email = $_POST['email'];
        $pw1 = md5($_POST['pw1']);  // 密碼加密
        $cname = $_POST['cname'];
        $tssn = $_POST['tssn'];
        $birthday = $_POST['birthday'];
        $mobile = $_POST['mobile'];
        $myzip = $_POST['myZip'] == '' ? NULL : $_POST['myZip'];
        $address = $_POST['address'] == '' ? NULL : $_POST['address'];
        $imgname = $_POST['uploadname'] == '' ? NULL : $_POST['uploadname'];

        // 建立 member 資料表的 SQL
        $insertsql = "INSERT INTO member (email,pw1,cname,tssn,birthday,imgname) VALUES (?,?,?,?,?,?)";
        $Result = $link->prepare($insertsql);
        $Result->execute(array($email, $pw1, $cname, $tssn, $birthday, $imgname));

        // 取得新增的會員編號
        $emailid = $link->lastInsertId();

        if ($Result) {
            // 新增會員聯絡資料到 addbook
            $insertsql = "INSERT INTO addbook (emailid,setdefault,cname,mobile,myzip,address) VALUES (?,?,?,?,?,?)";
            $Result = $link->prepare($insertsql);
            $Result->execute(array($emailid, '1', $cname, $mobile, $myzip, $address));

            // 設定會員註冊完成後自動登入
            $_SESSION['login'] = true;
            $_SESSION['emailid'] = $emailid;
            $_SESSION['email'] = $email;
            $_SESSION['cname'] = $cname;

            // 導向到首頁
            echo "<script language='javascript'>alert('謝謝您，會員資料已完成註冊！');location.href='index.php';</script>";
        }
    }
    ?>
    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <?php require_once("./accordion.php") ?>
                    <?php require_once("./hot.php") ?>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>會員註冊</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 offset-2 text-left">
                            <form id="reg" name="reg" action="register.php" method="POST">
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="請輸入email帳號" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="password" name="pw1" id="pw1" class="form-control" placeholder="請輸入密碼">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="password" name="pw2" id="pw2" class="form-control" placeholder="請再次確認密碼">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="text" name="cname" id="cname" class="form-control" placeholder="請輸入姓名">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="text" name="tssn" id="tssn" class="form-control" placeholder="請輸入身分證字號">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="date" name="birthday" id="birthday" class="form-control" placeholder="請選擇生日">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="請輸入手機號碼">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="address" class="form-label" id="zipcode" name="zipcode">郵遞區號：地址</label>
                                        <input type="hidden" name="myZip" id="myZip" value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <select name="myCity" id="myCity" class="form-control">
                                            <option value="">請選擇地區</option>
                                            <?php
                                            $city = "SELECT * FROM city WHERE State=0";
                                            $city_rs = $link->query($city);
                                            while ($city_rows = $city_rs->fetch()) {
                                            ?>
                                                <option value="<?php echo $city_rows['AutoNo'] ?>"><?php echo $city_rows['Name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="myTown" id="myTown" class="form-control">
                                            <option value="">請選擇地區</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="address" id="address" class="form-control" placeholder="請輸入後續地址">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="fileToUpload" class="form-label">上傳相片：</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-9">
                                        <input type="file" id="fileToUpload" name="fileToUpload" class="form-control" title="請上傳相片圖示" accept="image/png, image/jpeg, image/gif" style="width: 100%;">
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-end">
                                        <button type="button" class="btn btn-danger w-100" id="uploadForm" name="uploadForm">開始上傳</button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div id="progress-div01" class="progress" style="width:100%;display:none">
                                            <div id="progress-bar01" class="progress-bar progress-bar-striped" role="progressbar" style="width:0%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">0%</div>
                                        </div>
                                        <input type="hidden" id="uploadname" name="uploadname" value="">
                                        <img id="showimg" name="showimg" src="" alt="photo" style="display:none;" class="img-fluid">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="hidden" id="captcha" name="captcha" value="">
                                        <a href="javascript:void(0)" title="按我更新驗證" onclick="getCaptcha();">
                                            <canvas id="can"></canvas>
                                        </a>
                                        <input type="text" id="recaptcha" name="recaptcha" class="form-control" placeholder="請輸入驗證碼">
                                    </div>
                                </div>
                                <input type="hidden" id="formct1" name="formct1" value="reg">
                                <div class="row mb-3">
                                    <div class="col">
                                        <button type="submit" class="btn btn-success btn-lg w-100">送出</button>
                                    </div>
                                </div>
                            </form>
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
    <script type="text/javascript">
        jQuery.validator.addMethod("tssn", function(value, element, param) {
            var tssn = /^[A-Z][12]\d{8}$/;
            return this.optional(element) || (tssn.test(value));
        });
        jQuery.validator.addMethod("checkphone", function(value, element, param) {
            var checkphone = /^09\d{8}$/;
            return this.optional(element) || (checkphone.test(value));
        });
        jQuery.validator.addMethod("checkMyTown", function(value, element, param) {
            var townValue = $("#myTown").val();
            return townValue !== "" && townValue !== "請選擇地區";
        });

        $("#reg").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: "checkemail.php"
                },
                pw1: {
                    required: true,
                    minlength: 4,
                    maxlength: 20
                },
                pw2: {
                    required: true,
                    equalTo: "#pw1"
                },
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
                mobile: {
                    required: true,
                    checkphone: true
                },
                address: {
                    required: true,
                },
                myCity: {
                    required: true
                },
                myTown: {
                    required: true,
                    checkMyTown: true
                },
                recaptcha: {
                    required: true,
                    equalTo: "#captcha"
                },
            },
            messages: {
                email: {
                    required: "email信箱不得為空白",
                    email: "email信箱格式有誤",
                    remote: "email信箱已經註冊"
                },
                pw1: {
                    required: "密碼不得為空白",
                    minlength: "密碼長度不得小於4個字",
                    maxlength: "密碼長度不得大於20個字"
                },
                pw2: {
                    required: "密碼不得為空白",
                    equalTo: "密碼不一致"
                },
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
                mobile: {
                    required: "手機號碼不得為空白",
                    checkphone: "手機號碼格式有誤"
                },
                address: {
                    required: "地址不得為空白",
                },
                myCity: {
                    required: "請選擇縣市"
                },
                myTown: {
                    required: "請選擇地區",
                    checkMyTown: "請選擇地區"
                },
                recaptcha: {
                    required: "驗證碼不得為空白",
                    equalTo: "驗證碼不一致"
                },
            },
        });

        function getId(el) {
            return document.getElementById(el);
        }
        let ajax; // 將 ajax 變數移到全域

        $("#uploadForm").click(function(e) {
            var fileName = $("#fileToUpload").val();
            var idxDot = fileName.lastIndexOf(".") + 1;
            let extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "gif") {
                // 中止之前的上傳（如果存在）
                if (ajax && ajax.readyState != 4) {
                    ajax.abort();
                }

                // 完全重置進度條狀態
                $("#progress-div01").hide();
                $("#progress-bar01")
                    .css("width", "0%")
                    .html("0%")
                    .removeClass("bg-success")
                    .addClass("progress-bar-striped")
                    .addClass("progress-bar-animated");

                // 短暫延遲後顯示進度條，確保重置完成
                setTimeout(function() {
                    $("#progress-div01").show();
                }, 100);

                let file1 = getId("fileToUpload").files[0];
                let formdata = new FormData();
                formdata.append("file1", file1);

                // 建立新的 ajax 物件
                ajax = new XMLHttpRequest();
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
            $("#progress-bar01")
                .css("width", percent + "%")
                .html(percent + "%");

            // 當上傳完成時
            if (percent === 100) {
                $("#progress-bar01")
                    .removeClass("progress-bar-striped")
                    .removeClass("progress-bar-animated")
                    .addClass("bg-success");
            }
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

        function getCaptcha() {
            var inputTxt = document.getElementById("captcha");
            inputTxt.value = captchaCode("can", 150, 50, "blue", "white", "28px", 5);
        }
        $(function() {
            getCaptcha();
        })
        $(function() {
            $("#myCity").change(function() {
                var CNo = $('#myCity').val();
                if (CNo == "") {
                    return false;
                }
                $.ajax({
                    url: 'Town_ajax.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        CNo: CNo,
                    },
                    success: function(data) {
                        if (data.c == true) {
                            $('#myTown').html(data.m);
                            $('#myZip').val("");
                        } else {
                            alert(data.m);
                        }
                    },
                    error: function(data) {
                        alert("系統目前無法連接到後台資料庫");
                    }
                });
            });
            $("#myTown").change(function() {
                var AutoNo = $('#myTown').val();
                if (AutoNo == "") {
                    return false;
                }
                $.ajax({
                    url: 'Zip_ajax.php',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        AutoNo: AutoNo,
                    },
                    success: function(data) {
                        console.log("接收到的數據:", data);
                        console.log("Post:", data.Post);
                        console.log("Cityname:", data.Cityname);
                        console.log("Name:", data.Name);
                        if (data.c == true) {
                            $('#myZip').val(data.Post);
                            $('#zipcode').html(data.Post + data.Cityname + data.Name);
                        } else {
                            alert(data.m);
                        }
                    },
                    error: function(data) {
                        alert("系統目前無法連接到後台資料庫");
                    }
                });
            });
        })
    </script>
</body>

</html>