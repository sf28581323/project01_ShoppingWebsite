<?php
// $dsn = "mysql:host=localhost;dbname=lincan;charset=utf8";
// $user = "sales";
// $password = "123456";
// $link = new PDO($dsn, $user, $password);
// $link->exec("SET NAMES utf8mb4"); // 設定資料庫連線編碼
// $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // 錯誤處理

$dsn = "mysql:host=localhost;dbname=expstore;charset=utf8;";
$user = "sales";
$password = "123456";
try {
    $link = new PDO($dsn, $user, $password);
    $link->query("SET NAMES utf8");
    date_default_timezone_set("Asia/Taipei");
} catch (PDOException $e) {
    die("連線錯誤: " . $e->getMessage());
}
?>