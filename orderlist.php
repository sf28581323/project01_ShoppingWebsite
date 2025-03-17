<?php require_once('./Connections/conn_db.php') ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once("./php_lib.php") ?>
<?php
if (!isset($_SESSION['login'])) {
    $sPath = "./login.php?sPath=orderlist";
    header(sprintf("Location: %s", $sPath));
}
?>
<!doctype html>
<html lang="zh-TW">

<head>
    <?php require_once("./headfile.php") ?>
    <style type="text/css">
        .accordion-header a {
            text-decoration: none;
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
                    <?php require_once("./order_content.php") ?>
                </div>
            </div>
            <hr>
        </div>
    </section>
    <section id="scontent">
        <?php require_once("./scontent.php") ?>
    </section>
    <section id="footer">
        <?php require_once("./footer.php") ?>
    </section>
</body>
<?php require_once("./jsfile.php") ?>

</html>