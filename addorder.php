<?php
header('Access-Control-Allow-Origin: *'); // 允許跨域請求
header('Content-Type: application/json;charset=utf-8'); // 返回 JSON 字串

require_once('./Connections/conn_db.php');
(!isset($_SESSION)) ? session_start() : ""; // 確保會話已啟動

if (isset($_SESSION['emailid']) && $_SESSION['emailid'] != "") {
    $emailid = $_SESSION['emailid'];
    $addressid = $_POST['addressid'];
    $ip = $_SERVER['REMOTE_ADDR'];

    // 自行產生時間+訂單號
    $orderid = date('Ymdhis') . rand(10000, 99999);

    // 插入新訂單
    $query = sprintf("INSERT INTO uorder (orderid, emailid, addressid, howpay, paystatus, status) VALUES ('%s', '%d', '%d', '3', '35', '7')", $orderid, $emailid, $addressid);
    $result = $link->query($query);

    if ($result) {
        // 更新購物車
        $query = sprintf("UPDATE cart SET orderid='%s', emailid='%d', status='8' WHERE ip='%s' AND orderid IS NULL", $orderid, $emailid, $ip);
        $result = $link->query($query);
        $retcode = array("c" => "1", "m" => "謝謝您，系統已經完成結帳，請在會員專區查詢訂單處理狀態。");
    } else {
        $retcode = array("c" => "0", "m" => "抱歉！資料無法寫入後台資料庫，請聯絡管理人員。");
    }
    echo json_encode($retcode, JSON_UNESCAPED_UNICODE);
}
return;
?>
