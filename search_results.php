<?php require_once('./Connections/conn_db.php') ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once("./php_lib.php") ?>
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
                    <?php require_once("./search.php") ?>
                    <div class="mt-4">
                        <?php
                        $maxRows_rs = 12;
                        $pageNum_rs = 0;
                        if (isset($_GET['pageNum_rs'])) {
                            $pageNum_rs = $_GET['pageNum_rs'];
                        }
                        $startRow_rs = $pageNum_rs * $maxRows_rs;

                        // 搜尋功能
                        if (isset($_GET['search_name']) && !empty($_GET['search_name'])) {
                            $search_name = "%" . $_GET['search_name'] . "%";
                            $queryFirst = sprintf(
                                "SELECT * FROM product, product_img 
         WHERE p_open = 1 AND product_img.sort = 1 AND product.p_id = product_img.p_id 
         AND product.p_name LIKE '%s' 
         ORDER BY product.p_id DESC",
                                $search_name
                            );
                        } else {
                            // 若沒有搜尋關鍵字，顯示錯誤訊息
                            echo '<div class="alert alert-warning" role="alert">請輸入搜尋關鍵字</div>';
                            exit();
                        }

                        $query = sprintf("%s LIMIT %d, %d", $queryFirst, $startRow_rs, $maxRows_rs);
                        $pList01 = $link->query($query);
                        $i = 1;
                        ?>
                        <?php if ($pList01->rowCount() != 0) { ?>
                            <?php while ($pList01_Rows = $pList01->fetch()) { ?>
                                <?php if ($i % 4 == 1) { ?><div class="row text-center"><?php } ?>
                                    <div class="col-md-3">
                                        <div class="card card-trans mt-3">
                                            <img src="./product_img/<?php echo $pList01_Rows['img_file']; ?>" class="card-img-top" alt="<?php echo $pList01_Rows['p_name']; ?>" title="<?php echo $pList01_Rows['p_name']; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title text-ellipsis"><?php echo $pList01_Rows['p_name']; ?></h5>
                                                <p class="card-text">NT<?php echo $pList01_Rows['p_price']; ?></p>
                                                <a href="#" class="btn btn-primary">更多資訊</a>
                                                <a href="#" class="btn btn-success">放購物車</a>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ($i % 4 == 0 || $i == $pList01->rowCount()) { ?>
                                    </div><?php } ?>
                            <?php $i++;
                            } ?>
                            <div class="row mt-3">
                                <?php
                                if (isset($_GET['totalRows_rs'])) {
                                    $totalRows_rs = $_GET['totalRows_rs'];
                                } else {
                                    $all_rs = $link->query($queryFirst);
                                    $totalRows_rs = $all_rs->rowCount();
                                }
                                $totalRows_rs = ceil($totalRows_rs / $maxRows_rs) - 1;
                                $prev_rs = "&laquo";
                                $next_rs = "&raquo";
                                $separator = "|";
                                $max_links = 20;
                                $pages_rs = buildNavigation($pageNum_rs, $totalRows_rs, $prev_rs, $next_rs, $separator, $max_links, true, 3, "rs");
                                ?>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <?php echo $pages_rs[0] . $pages_rs[1] . $pages_rs[2]; ?>
                                    </ul>
                                </nav>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-danger" role="alert">
                                抱歉。找不到符合條件的產品
                            </div>
                        <?php } ?>

                    </div>
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