<?php
header('Content-Type: application/json; charset=utf-8');

// 添加延遲以模擬較大檔案的上傳時間
sleep(0.5); // 延遲1秒

$fileName = $_FILES['file1']['name']; // The file name
$fileTmpLoc = $_FILES['file1']['tmp_name']; // File in the PHP tmp folder
$fileType = $_FILES['file1']['type']; // The type of file it is
$fileSize = $_FILES['file1']['size']; // File size in bytes
$fileErrorMsg = $_FILES['file1']['error']; // 0 for false, 1 for true

if (!$fileTmpLoc) { // if file not chosen
    $retcode = array('success' => 'false', 'msg' => '', 'error' => '上傳暫存檔無法建立！', 'fileName' => '');
    echo json_encode($retcode, JSON_UNESCAPED_UNICODE);
    exit();
}

// 模擬檔案上傳的延遲
usleep(500000); // 再延遲0.5秒

if (move_uploaded_file($fileTmpLoc, "uploads/$fileName")) {
    // file to uploads folder
    $retcode = array('success' => 'true', 'msg' => '完成檔案上傳', 'error' => '', 'fileName' => $fileName);
} else {
    $retcode = array('success' => 'false', 'msg' => '', 'error' => '無法完成檔案上傳', 'fileName' => '');
}

echo json_encode($retcode);
exit();
?>