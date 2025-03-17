<?php
$dsn = "mysql:host=localhost;dbname=expstore;charset=utf8;";
$user = "sales";
$password = "123456";

try {
    $link = new PDO($dsn, $user, $password);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $link->query("SET NAMES utf8");
    date_default_timezone_set("Asia/Taipei");
} catch (PDOException $e) {
    die("連線錯誤: " . $e->getMessage());
}

// 取得所有分類
$sql = "SELECT classid, cname, uplink FROM pyclass";
$result = $link->query($sql);

// 轉換為關聯陣列
$categories = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $categories[$row['classid']] = $row;
}

// 遞迴函式尋找所有子分類
function findSubCategories($parentId, $categories, &$result) {
    foreach ($categories as $category) {
        if ($category['uplink'] == $parentId) {
            $result[] = $category; // 加入結果陣列
            findSubCategories($category['classid'], $categories, $result); // 遞迴搜尋
        }
    }
}

// 目標 classid
$targetClassId = 1;
$subCategories = array();
findSubCategories($targetClassId, $categories, $subCategories);

// 輸出結果
foreach ($subCategories as $category) {
    echo "ClassID: " . $category['classid'] . " - " . $category['cname'] . "<br>";
}

// 關閉資料庫連線
$link = null;
?>
