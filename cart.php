<?php require_once('./Connections/conn_db.php') ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once("./php_lib.php") ?>
<!doctype html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>B|3C購物網|Q</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="website_p01.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.1/css/all.css">
    <style type="text/css">
        table input:invalid {
            border: solid red 3px !important;
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
                    <?php require_once("./cart_content.php") ?>
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

<script type="text/javascript">
    $("input").change(function() {
        var qty = $(this).val();
        const cartid = $(this).attr("cartid");
        if (qty <= 0 || qty >= 50) {
            alert("更改數量需大於0以上，以及小於50以下。");
            return false;
        }
        $.ajax({
            url: 'change_qty.php',
            type: 'post',
            dataType: 'json',
            data: {
                cartid: cartid,
                qty: qty,
            },
            success: function(data) {
                if (data.c == true) {
                    //alert(data.m);
                    window.location.reload();
                } else {
                    alert(data.m);
                }
            },
            error: function(data) {
                alert("系統目前無法連接到後台資料庫");
            }
        })
    })
</script>

</html>