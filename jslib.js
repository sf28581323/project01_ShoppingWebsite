function btn_confirmLink(message,url){
    if(message == "" || url == ""){
        return false;
    }
    if(confirm(message)){
        window.location=url;
    }
    return false;
}
function addcart(p_id) {
    var qty = $("#qty").val();
    if (qty <= 0) {
        alert("產品數量不得為0或為負數，請再修改數量！");
        return (false);
    }
    if (qty == undefined) {
        qty = 1;
    } else if (qty >= 50) {
        alert("由於採購限制，產品數量將限制在50以下！");
        return (false);
    }
    $.ajax({
        url: './addcart.php',
        type: 'get',
        dataType: 'json',
        data: {
            p_id: p_id,
            qty: qty,
        },
        success: function (data) {
            if (data.c == "1") {
                alert(data.m);
                window.location.reload();
            } else {
                alert(data.m);
            }
        },
        error: function (xhr, status, error) {
            console.log("狀態碼: ", xhr.status);
            console.log("回應內容: ", xhr.responseText);
            alert("系統錯誤，請檢查伺服器日誌！");
        }
    });
}