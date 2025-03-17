<?php
header('Access-Control-Allow-Origin: *'); // 允許跨域請求
header('Content-Type: application/json;charset=utf-8'); // 返回 JSON 字串

require_once('./Connections/conn_db.php');
(!isset($_SESSION)) ? session_start() : ""; // 確保會話已啟動

if (isset($_SESSION['emailid']) && $_SESSION['emailid'] != "") {
    $emailid = $_SESSION['emailid'];
    $cname = $_POST['cname'];
    $mobile = $_POST['mobile'];
    $myZip = $_POST['myZip'];
    $address = $_POST['address'];

    // 更新現有地址為非默認
    $query = sprintf("UPDATE addbook SET setdefault='0' WHERE emailid='%d' AND setdefault='1'", $emailid);
    $result = $link->query($query);

    // 插入新地址
    $query = sprintf("INSERT INTO addbook (setdefault, emailid, cname, mobile, myzip, address) VALUES ('1', '%d', '%s', '%s', '%s', '%s')",
        $emailid, $cname, $mobile, $myZip, $address);
    $result = $link->query($query);

    if ($result) {
        $retcode = array("c" => "1", "m" => "收件人資訊已新增");
    } else {
        $retcode = array("c" => "0", "m" => "資料庫錯誤，請聯繫管理員");
    }
} else {
    $retcode = array("c" => "0", "m" => "未登入，請先登入");
}

echo json_encode($retcode, JSON_UNESCAPED_UNICODE); 
?>