<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json;charset=utf-8'); // return json string
require_once('./Connections/conn_db.php');
if(isset($_POST['cartid']) && isset($_POST['qty'])){
    $cartid = $_POST['cartid'];
    $qty = $_POST['qty'];
    $query = sprintf("UPDATE cart SET qty='%d' WHERE cart.cartid=%d",$qty,$cartid);
    $result = $link->query($query);
    if($result){
        $retcode = array("c" => true, "m" => "謝謝您！產品數量已經更新。");
    }else{
        $retcode = array("c" => "0", "m" => "抱歉，資料庫無法存入後台資料庫，請連絡管理人員。");
    }
    echo json_encode($retcode);
}
return;
?>