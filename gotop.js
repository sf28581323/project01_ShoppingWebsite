$(function(){ 
    // 在頁面中動態添加一個隱藏的 "回到頂端" 按鈕 
    $("body").append("<img id='goTopButton' style='display: none; z-index: 5; cursor: pointer;' title='回到頂端'/>"); 
    
    var img = "./images/bntop01.png", // 按鈕圖片 
        location = 0.95, // 按鈕的垂直位置（0.5代表頁面高度的中間） 
        right = 0, // 按鈕距離右邊的距離 
        opacity = 0.5, // 按鈕初始透明度 
        speed = 800, // 滾動回到頂部的動畫速度（毫秒） 
        $button = $("#goTopButton"), // 按鈕的jQuery對象 
        $body = $(document), // 整個頁面的jQuery對象 
        $win = $(window), // 窗口的jQuery對象
        animationStyles = [
            // 旋轉彈跳效果
            function() {
                return {
                    transform: 'rotate(720deg) scale(1.5)',
                    transition: 'all 0.8s cubic-bezier(0.68, -0.55, 0.27, 1.55)'
                };
            },
            // 縮放淡出效果
            function() {
                return {
                    transform: 'scale(0) rotate(360deg)',
                    opacity: 0,
                    transition: 'all 1s ease-in-out'
                };
            }
        ],
        currentAnimationIndex = 0;

    // 設定按鈕圖片的來源 
    $button.attr("src", img); 

    // 定義一個函數來控制按鈕顯示和隱藏 
    window.goTopMove = function () { 
        // 獲取頁面滾動的高度 
        var scrollH = $body.scrollTop(), 
            // 獲取窗口的高度 
            winH = $win.height(), 
            // 設定按鈕的CSS屬性 
            css = {
                "top": winH * location + "px", 
                "position": "fixed", 
                "right": right, 
                "opacity": opacity
            }; 

        // 如果頁面已經滾動過20px，顯示按鈕 
        if (scrollH > 20){ 
            $button.css(css); 
            $button.fadeIn("slow"); 
        } else { 
            $button.fadeIn("slow"); 
            // $button.hide(); 隱藏按鈕
        } 
    }; 

    // 當滾動或調整窗口大小時，觸發 goTopMove 函數 
    $win.on({ 
        scroll: function () { goTopMove(); }, 
        resize: function () { goTopMove(); } 
    }); 

    // 設定按鈕的鼠標事件 
    $button.on({ 
        // 當鼠標移入按鈕時，將按鈕的透明度設置為 1 
        mouseover: function(){
            $button.css("opacity", 1);
        }, 
        // 當鼠標移出按鈕時，恢復按鈕的原始透明度 
        mouseout: function(){
            $button.css("opacity", opacity);
        }, 
        // 當按鈕被點擊時，觸發回到頂部的動畫並變換效果
        click: function(){ 
            // 循環使用不同的動畫樣式
            var animationStyle = animationStyles[currentAnimationIndex]();
            
            // 應用動畫效果
            $button.css(animationStyle); 

            // 滾動到頂部
            $("html, body").animate({scrollTop: 0}, speed, function() {
                // 動畫完成後重置按鈕
                $button.css({
                    transform: 'none', 
                    opacity: opacity,
                    transition: 'all 0.5s ease'
                });
            }); 

            // 切換到下一個動畫樣式
            currentAnimationIndex = (currentAnimationIndex + 1) % animationStyles.length;
        } 
    }); 
});