<?php
$maxRows_rs = 12;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
    $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

// 搜尋關鍵字查詢
if(isset($_GET['search_name'])){
    $search_term = '%' . trim($_GET['search_name']) . '%';
    $queryFirst = "SELECT * FROM product,product_img,pyclass 
        WHERE p_open=1 AND product_img.sort=1 
        AND product.p_id=product_img.p_id 
        AND product.classid=pyclass.classid 
        AND product.p_name LIKE :search_term 
        ORDER BY product.p_id DESC";
        
    // 準備總筆數查詢
    $stmt = $link->prepare($queryFirst);
    $stmt->bindParam(':search_term', $search_term, PDO::PARAM_STR);
    $stmt->execute();
    $all_rs = $stmt;
    
    // 準備分頁查詢
    $queryLimit = $queryFirst . " LIMIT :start, :max";
    $stmt = $link->prepare($queryLimit);
    $stmt->bindParam(':search_term', $search_term, PDO::PARAM_STR);
    $stmt->bindParam(':start', $startRow_rs, PDO::PARAM_INT);
    $stmt->bindParam(':max', $maxRows_rs, PDO::PARAM_INT);
    $stmt->execute();
    $pList01 = $stmt;
}
// 第一層類別查詢
elseif(isset($_GET['level']) && $_GET['level']==1){
    $queryFirst = sprintf("SELECT DISTINCT product.* ,product_img.*, pyclass.* 
        FROM product,product_img,pyclass 
        WHERE p_open=1 AND product_img.sort=1 
        AND product.p_id=product_img.p_id 
        AND product.classid=pyclass.classid 
        AND (pyclass.uplink='%d' OR pyclass.uplink IN 
            (SELECT classid FROM pyclass WHERE uplink='%d'))
        ORDER BY product.p_id DESC", 
        $_GET['classid'], $_GET['classid']);
    
    // 取得總筆數
    $all_rs = $link->query($queryFirst);
    
    // 執行分頁查詢
    $query = sprintf("%s LIMIT %d, %d", $queryFirst, $startRow_rs, $maxRows_rs);
    $pList01 = $link->query($query);
}
// 第二層類別查詢
elseif(isset($_GET['level']) && $_GET['level']==2){
    $queryFirst = sprintf("SELECT DISTINCT product.* ,product_img.*, pyclass.* 
        FROM product,product_img,pyclass 
        WHERE p_open=1 AND product_img.sort=1 
        AND product.p_id=product_img.p_id 
        AND product.classid=pyclass.classid 
        AND (product.classid='%d' OR pyclass.uplink='%d')
        ORDER BY product.p_id DESC", 
        $_GET['classid'], $_GET['classid']);
    
    // 取得總筆數
    $all_rs = $link->query($queryFirst);
    
    // 執行分頁查詢
    $query = sprintf("%s LIMIT %d, %d", $queryFirst, $startRow_rs, $maxRows_rs);
    $pList01 = $link->query($query);
}
// 第三層類別查詢
elseif(isset($_GET['level']) && $_GET['level']==3){
    $queryFirst = sprintf("SELECT * FROM product,product_img,pyclass 
        WHERE p_open=1 AND product_img.sort=1 
        AND product.p_id=product_img.p_id 
        AND product.classid='%d' 
        AND product.classid=pyclass.classid 
        ORDER BY product.p_id DESC", 
        $_GET['classid']);
    
    // 取得總筆數
    $all_rs = $link->query($queryFirst);
    
    // 執行分頁查詢
    $query = sprintf("%s LIMIT %d, %d", $queryFirst, $startRow_rs, $maxRows_rs);
    $pList01 = $link->query($query);
}
// 預設查詢所有商品
else{
    $queryFirst = "SELECT * FROM product,product_img,pyclass 
        WHERE p_open=1 AND product_img.sort=1 
        AND product.p_id=product_img.p_id 
        AND product.classid=pyclass.classid 
        ORDER BY product.p_id DESC";
    
    // 取得總筆數
    $all_rs = $link->query($queryFirst);
    
    // 執行分頁查詢
    $query = sprintf("%s LIMIT %d, %d", $queryFirst, $startRow_rs, $maxRows_rs);
    $pList01 = $link->query($query);
}

$i = 1;
?>

<?php if ($pList01->rowCount() != 0) { ?>
    <?php while ($pList01_Rows = $pList01->fetch()) { ?>
        <?php if ($i % 4 == 1) { ?><div class="row text-center"><?php } ?>
            <div class="col-md-3">
                <div class="card card-trans mt-3">
                    <a href="goods.php?p_id=<?php echo $pList01_Rows['p_id']; ?>&level=<?php echo $pList01_Rows['level']; ?>">
                        <img src="./product_img/<?php echo $pList01_Rows['img_file']; ?>" 
                             class="    card-img-top" 
                             alt="<?php echo $pList01_Rows['p_name']; ?>" 
                             title="<?php echo $pList01_Rows['p_name']; ?>">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-ellipsis"><?php echo $pList01_Rows['p_name']; ?></h5>
                        <p class="card-text">NT<?php echo $pList01_Rows['p_price']; ?></p>
                        <a href="goods.php?p_id=<?php echo $pList01_Rows['p_id']; ?>&level=<?php echo $pList01_Rows['level']; ?>" 
                           class="btn btn-primary">更多資訊</a>
                        <a href="#" class="btn btn-success">放購物車</a>
                    </div>
                </div>
            </div>
        <?php if ($i % 4 == 0 || $i == $pList01->rowCount()) { ?></div><?php } ?>
    <?php $i++; } ?>
    <div class="row mt-3">
        <?php
        if (isset($_GET['totalRows_rs'])) {
            $totalRows_rs = $_GET['totalRows_rs'];
        } else {
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
        抱歉。目前沒有相關產品
    </div>
<?php } ?>