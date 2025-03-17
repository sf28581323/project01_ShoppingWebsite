<?php
header('Access-Control-Allow-Origin: *'); // 允許跨域請求
header('Content-Type: application/json;charset=utf-8'); // 返回 JSON 字串

require_once('./Connections/conn_db.php');
(!isset($_SESSION)) ? session_start() : ""; // 確保會話已啟動

if (isset($_SESSION['emailid']) && $_SESSION['emailid'] != "") {
    $emailid = $_SESSION['emailid'];
    $addressid = $_POST['addressid'];

    // 先將現有默認收件人設置為非默認
    $query = sprintf("UPDATE addbook SET setdefault='0' WHERE emailid='%d' AND setdefault='1';", $emailid);
    $result = $link->query($query);

    // 將選擇的收件人設置為默認
    $query = sprintf("UPDATE addbook SET setdefault='1' WHERE addressid='%d';", $addressid);
    $result = $link->query($query);

    if ($result) {
        $retcode = array("c" => true, "m" => "收件人已經變更。");
    } else {
        $retcode = array("c" => false, "m" => "錯誤！資料無法寫入後台資料庫，請聯絡管理人員。");
    }
    echo json_encode($retcode, JSON_UNESCAPED_UNICODE); 
} 
return;
?>