<?php require_once('./Connections/conn_db.php') ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once("./php_lib.php") ?>
<?php
if (!isset($_SESSION['login'])) {
    $sPath = "login.php?sPath=checkout";
    header(sprintf("Location: %s", $sPath));
    exit();
}
?>
<!doctype html>
<html lang="zh-TW">

<head>
    <?php require_once("./headfile.php") ?>
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
                    <?php require_once("./checkout_content.php") ?>
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
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <?php
    $SQLstring = sprintf("SELECT *,city.Name AS ctName,town.Name AS toName FROM addbook,city,town WHERE emailid='%d' AND addbook.myzip=town.Post AND town.AutoNo=city.AutoNo", $_SESSION['emailid']);
    $addbook_rs = $link->query($SQLstring);
    ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">收件人資訊</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="cname" name="cname" placeholder="收件人姓名">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="收件人電話">
                            </div>
                            <div class="col">
                                <select name="myCity" id="myCity" class="form-control">
                                    <option value="">請選擇縣市</option>
                                    <?php $city = "SELECT * FROM `city` WHERE State=0";
                                    $city_rs = $link->query($city);
                                    while ($city_rows = $city_rs->fetch()) { ?>
                                        <option value="<?php echo $city_rows['AutoNo']; ?>">
                                            <?php echo $city_rows['Name']; ?>
                                        </option>
                                    <?php } ?>
                                </select><br>
                            </div>
                            <div class="col">
                                <select name="myTown" id="myTown" class="form-control">
                                    <option value="">請選擇鄉鎮市區</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <input type="hidden" id="myZip" name="myZip" value="">
                                <label for="address" id="add_label" name="add_label">郵遞區號:</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="收件人地址">
                            </div>
                        </div>
                        <div class="row mt-4 justify-content-center">
                            <div class="col-auto">
                                <button type="button" class="btn btn-success" id="recipient" name="recipient">新增收件人</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>收件者姓名</th>
                                <th>電話</th>
                                <th>地址</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($data = $addbook_rs->fetch()) { ?>
                                <tr>
                                    <th scope="row"><input type="radio" name="gridRadios" id="gridRadios[]" value="<?php echo $data['addressid'] ?>" <?php echo ($data['setdefault']) ? 'checked' : ''; ?>></th>
                                    <td><?php echo $data['cname']; ?></td>
                                    <td><?php echo $data['mobile']; ?></td>
                                    <td><?php echo $data['myzip'] . $data['ctName'] . $data['toName'] . $data['address']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="loading" name="loading" style="display:none;position:fixed;width:100%;height:100%;top:0;left:0;background-color:rgba(255,255,255,.5);z-index:9999;"><i class="fas fa-spinner fa-spin fa-5x fa-fw" style="position:absolute;top:50%;left:50%;"></i></div>
</body>
<script type="text/javascript">
    $(function() {
        // 系統進行結帳處理
        $('#btn04').click(function() {
            let msg = "系統將進行結帳處理，請確認產品金額與收件人是否正確！";
            if (!confirm(msg)) return false;
            $("#loading").show();
            var addressid = $('input[name=gridRadios]:checked').val();
            $.ajax({
                url: 'addorder.php',
                type: 'post',
                dataType: 'json',
                data: {
                    addressid: addressid,
                },
                success: function(data) {
                    if (data.c == true) {
                        alert(data.m);
                        window.location.href = "index.php";
                    } else {
                        alert("Database response error: " + data.m);
                    }
                },
                error: function(data) {
                    alert("ajax request error");
                }
            });
        });
        $('input[name=gridRadios]').change(function() {
            var addressid = $(this).val();
            $.ajax({
                url: 'changeaddr.php',
                type: 'post',
                dataType: 'json',
                data: {
                    addressid: addressid,
                },
                success: function(data) {
                    if (data.c == true) {
                        alert(data.m);
                        window.location.reload();
                    } else {
                        alert("Database response error:" + data.m);
                    }
                },
                error: function(data) {
                    alert("ajax request error");
                }
            });
        });
        $('#recipient').click(function() {
            var validate = 0,
                msg = "";
            var cname = $('#cname').val();
            var mobile = $('#mobile').val();
            var myZip = $('#myZip').val();
            var address = $('#address').val();
            var checkphone = /^09\d{8}$/;
            if (cname == "") {
                msg = msg + "收件人不得為空白！\n";
                validate = 1;
            }
            if (mobile == "") {
                msg = msg + "電話不得為空白！\n";
                validate = 1;
            }
            if (mobile != "") {
                if (checkphone.test(mobile) == false) {
                    msg = msg + "電話號碼格式有誤！\n";
                    validate = 1;
                }
            }
            if (myZip == "") {
                msg = msg + "郵遞區號不得為空白！\n";
                validate = 1;
            }
            if (address == "") {
                msg = msg + "地址不得為空白！\n";
                validate = 1;
            }
            if (validate) {
                alert(msg);
                return false;
            }
            $.ajax({
                url: 'addbook.php',
                type: 'post',
                dataType: 'json',
                data: {
                    cname: cname,
                    mobile: mobile,
                    myZip: myZip,
                    address: address,
                },
                success: function(data) {
                    if (data.c == true) {
                        alert(data.m);
                        window.location.reload();
                    } else {
                        alert("Database response error:" + data.m);
                    }
                },
                error: function(data) {
                    alert("系統目前無法連接到後台資料庫");
                }
            });
        });
        $('#myCity').change(function() {
            var CNo = $('#myCity').val();
            if (CNo == '') {
                return false;
            }
            $('#myZip').val("");
            $('#add_label').html("郵遞區號：");
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
                    } else {
                        alert("Database response error:" + data.m);
                    }
                },
                error: function(data) {
                    alert("系統目前無法連接到後台資料庫");
                }
            })
        });
        $('#myTown').change(function() {
            var AutoNo = $('#myTown').val();
            if (AutoNo == '') {
                $('#myZip').val("");
                $('#add_label').html("");
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
                    if (data.c == true) {
                        $('#myZip').val(data.Post);
                        $('#add_label').html('郵遞區號：' + data.Post + data.Cityname + data.Name);
                    } else {
                        alert("Database response error:" + data.m);
                    }
                },
                error: function(data) {
                    alert("系統目前無法連接到後台資料庫");
                }
            })
        });
    });
</script>
</html>