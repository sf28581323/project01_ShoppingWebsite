<?php require_once('./Connections/conn_db.php') ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once("./php_lib.php") ?>
<?php
if(isset($_GET['sPath'])){
    $sPath = $_GET['sPath'] . ".php";
}else{
    $sPath = "index.php";
}
if(isset($_SESSION['login'])){
    header(sprintf("location: %s", $sPath));
}
?>
<!doctype html>
<html lang="zh-TW">

<head>
    <?php require_once("./headfile.php") ?>
    <style type="text/css">
        .col-md-10 {
            min-height: 80vh;
            background: linear-gradient(135deg, #00b09b, #96c93d);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 80px;
        }

        .mycard.mycard-container {
            max-width: 400px;
            min-height: 500px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 30px;
            border-radius: 20px;
            transition: transform 0.3s ease;
        }

        .mycard.mycard-container:hover {
            transform: translateY(-5px);
        }

        .profile-img-card {
            width: 120px;
            height: auto;
            margin: 0 auto 20px;
            display: block;
            transition: transform 0.3s ease;
        }

        .profile-img-card:hover {
            transform: scale(1.1);
        }

        .profile-name-card {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-signin input[type="email"],
        .form-signin input[type="password"] {
            width: 100%;
            height: 50px;
            font-size: 16px;
            padding: 10px 15px;
            margin-bottom: 20px;
            border: 2px solid #e1e1e1;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-signin input:focus {
            border-color: #96c93d;
            box-shadow: 0 0 8px rgba(150, 201, 61, 0.4);
            outline: none;
        }

        .btn.btn-signin {
            width: 100%;
            height: 50px;
            font-size: 18px;
            font-weight: 600;
            color: white;
            background: linear-gradient(to right, #00b09b, #96c93d);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn.btn-signin:hover {
            background: linear-gradient(to right, #008f7f, #7ba831);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 176, 155, 0.4);
        }

        .other {
            text-align: center;
            margin-top: 25px;
            font-size: 15px;
        }

        .other a {
            color: #00b09b;
            text-decoration: none;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .other a:hover {
            color: #008f7f;
            text-decoration: underline;
        }

        /* Loading 動畫樣式 */
        #loading {
            background-color: rgba(255, 255, 255, 0.8);
        }

        #loading i {
            color: #00b09b;
            transform: translate(-50%, -50%);
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
                    <div class="mycard mycard-container">
                        <img id="profile-img" class="profile-img-card" src="./images/logo03.svg" alt="logo">
                        <p id="profile-name" class="profile-name-card">會員登入</p>
                        <form action="" method="POST" class="form-signin" id="form1">
                            <input type="email" id="inputAccount" name="inputAccount" class="form-control" placeholder="Account" required autofocus>
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
                            <button type="submit" class="btn btn-signin mt-4">登入</button>

                        </form>
                        <div class="other mt-5 text-center">
                            <a href="./register.php">註冊會員</a>/<a href="#">忘記密碼？</a>
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
    <div id="loading" name="loading" style="display:none;position:fixed;width:100%;height:100%;top:0;left:0;background-color:rgba(255,255,255,.5);z-index:9999;"><i class="fas fa-spinner fa-spin fa-5x fa-fw" style="position:absolute;top:50%;left:50%;"></i></div>
</body>
<script type="text/javascript">
    $(function(){
        $('#form1').submit(function(){
            const inputAccount = $("#inputAccount").val();
            const inputPassword = MD5($("#inputPassword").val());
            $("#loading").show();
            $.ajax({
                url: 'auth_user.php',
                type:'post',
                dataType:'json',
                data:{
                    inputAccount: inputAccount,
                    inputPassword: inputPassword,
                },
                success: function(data){
                    if(data.c == true){
                        alert(data.m);
                        // window.location.reload();
                        window.location.href = <?php echo $sPath; ?>
                    }else{
                        alert(data.m);
                    }
                },
                error: function(data){
                    alert("系統目前無法連接到後台資料庫")
                }
            });
        });
    });
</script>
</html>