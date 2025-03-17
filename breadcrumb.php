<?php
$level1Open = "";
$level2Open = "";
$level3Open = "";
$level4Open = "";
if (isset($_GET['p_id']) && $_GET['level']==2 && $_GET['p_id']!="") {
    //使用p_id產品代碼取出資料
    //處理第一層
    $SQLstring = sprintf("SELECT * FROM product,pyclass,(SELECT classid as upclassid, level as uplevel, cname as upcname FROM pyclass WHERE level=1) as uplevel WHERE product.classid=pyclass.classid AND pyclass.uplink=uplevel.upclassid AND product.p_id=%d", $_GET['p_id']);
    $classid_rs = $link->query($SQLstring);
    $data = $classid_rs->fetch();
    $level1Cname = $data['upcname'];
    $level1Upclassid = $data['upclassid'];
    $level1 = $data['uplevel'];
    $level1Open = '<li class="breadcrumb-item"><a href="./drugstore.php?classid=' . $level1Upclassid . '&level=' . $level1 . '">' . $level1Cname . '</a></li>';
    //處理第二層
    $level2Cname = $data['cname'];
    $level2Classid = $data['classid'];
    $level2 = $data['level'];
    $level2Open = '<li class="breadcrumb-item"><a href="./drugstore.php?classid=' . $level2Classid . '&level=' . $level2 . '">' . $level2Cname . '</a></li>';
    //處理第三層(產品名稱)
    $level3Open = '<li class="breadcrumb-item active">'.$data['p_name'].'</li>';
} elseif (isset($_GET['p_id']) && $_GET['level']==3 && $_GET['p_id']!="") {
    //使用p_id產品代碼取出資料
    //處理第一層
    $SQLstring = sprintf("SELECT * FROM product,pyclass,(SELECT classid as upclassid, level as uplevel, cname as upcname FROM pyclass WHERE level=2) as uplevel,(SELECT classid as upupclassid, level as upuplevel, cname as upupcname FROM pyclass WHERE level=1) as upuplevel WHERE product.classid=pyclass.classid AND pyclass.uplink=uplevel.upclassid AND product.p_id=%d", $_GET['p_id']);
    $classid_rs = $link->query($SQLstring);
    $data = $classid_rs->fetch();
    $level1Cname = $data['upupcname'];
    $level1Upclassid = $data['upupclassid'];
    $level1 = $data['upuplevel'];
    $level1Open = '<li class="breadcrumb-item"><a href="./drugstore.php?classid=' . $level1Upclassid . '&level=' . $level1 . '">' . $level1Cname . '</a></li>';
    //處理第二層
    $level2Cname = $data['upcname'];
    $level2UpClassid = $data['upclassid'];
    $level2 = $data['uplevel'];
    $level2Open = '<li class="breadcrumb-item"><a href="./drugstore.php?classid=' . $level2UpClassid . '&level=' . $level2 . '">' . $level2Cname . '</a></li>';
    //處理第三層
    $level3Cname = $data['cname'];
    $level3Classid = $data['classid'];
    $level3 = $data['level'];
    $level3Open = '<li class="breadcrumb-item"><a href="./drugstore.php?classid=' . $level3Classid . '&level=' . $level . '">' . $level3Cname . '</a></li>';
    //處理第四層(產品名稱)
    $level4Open = '<li class="breadcrumb-item active">'.$data['p_name'].'</li>';
}elseif (isset($_GET['search_name'])){
    $level1Open = '<li class="breadcrumb-item active" aria-current="page">關鍵字查詢：' . $_GET['search_name'] . '</li>';
} elseif ($_GET['level']==1 && isset($_GET['classid'])) {
    //選擇第一層類別
    $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=%d AND classid=%d", $_GET['level'], $_GET['classid']);
    $classid_rs = $link->query($SQLstring);
    $data = $classid_rs->fetch();
    $level1Cname = $data['cname'];
    $level1Open = '<li class="breadcrumb-item active" aria-current="page">' . $level1Cname . '</li>';
} elseif ($_GET['level']==2 && isset($_GET['classid'])) {
    //選擇第二層類別
    $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=2 AND classid=%d", $_GET['classid']);
    $classid_rs = $link->query($SQLstring);
    $data = $classid_rs->fetch();
    $level2Cname = $data['cname'];
    $level2Uplink = $data['uplink'];
    $level2Open = '<li class="breadcrumb-item active" aria-current="page">' . $level2Cname . '</li>';
    //需加處理上一層
    $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=1 AND classid=%d", $level2Uplink);
    $classid_rs = $link->query($SQLstring);
    $data = $classid_rs->fetch();
    $level1Cname = $data['cname'];
    $level1 = $data['level'];
    $level1Open = '<li class="breadcrumb-item"><a href="./drugstore.php?classid=' . $level2Uplink . '&level=' . $level1 . '">' . $level1Cname . '</a></li>';
}elseif (isset($_GET['classid'])) {
    //選擇第二層類別
    $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=3 AND classid=%d", $_GET['classid']);
    $classid_rs = $link->query($SQLstring);
    $data = $classid_rs->fetch();
    $level3Cname = $data['cname'];
    $level3Uplink = $data['uplink'];
    $level3Open = '<li class="breadcrumb-item active" aria-current="page">' . $level3Cname . '</li>';
    //需加處理上一層
    $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=2 AND classid=%d", $level3Uplink);
    $classid_rs = $link->query($SQLstring);
    $data = $classid_rs->fetch();
    $level2Cname = $data['cname'];
    $level2Uplink = $data['uplink'];
    $level2 = $data['level'];
    $level2Open = '<li class="breadcrumb-item"><a href="./drugstore.php?classid=' . $level3Uplink . '&level=' . $level2 . '">' . $level2Cname . '</a></li>';
    //需加處理上上一層
    $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=1 AND classid=%d", $level2Uplink);
    $classid_rs = $link->query($SQLstring);
    $data = $classid_rs->fetch();
    $level1Cname = $data['cname'];
    $level1 = $data['level'];
    $level1Open = '<li class="breadcrumb-item"><a href="./drugstore.php?classid=' . $level2Uplink . '&level=' . $level1 . '">' . $level1Cname . '</a></li>';
}
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./index.php">首頁</a></li>
        <?php echo $level1Open . $level2Open . $level3Open . $level4Open; ?>
    </ol>
</nav>