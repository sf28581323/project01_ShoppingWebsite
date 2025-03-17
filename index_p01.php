<?php require_once('./Connections/conn_db.php') ?>
<?php (!isset($_SESSION)) ? session_start() : ""; ?>
<?php require_once("./php_lib.php") ?>
<!doctype html>
<html lang="zh-TW">

<head>
    <?php require_once("./headfile.php") ?>
</head>

<body>
    <section id="header">
        <?php require_once("./navbar.php") ?>
    </section>
    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <?php require_once("./accordion.php") ?>
                    <?php require_once("./hot.php") ?>
                </div>
                <div class="col-md-10">
                    <?php require_once("./search.php") ?>
                    <?php require_once("./carousel.php") ?>
                    <div class="mt-4">
                        <!-- 限時特價區 -->
                        <div class="section-container limited-time">
                            <div class="section-header d-flex justify-content-between align-items-center">
                                <!-- 限時特價標題 -->
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock text-danger me-2"></i>
                                    <h2 class="text-danger mb-0">限時特價</h2>
                                </div>

                                <!-- 倒計時 -->
                                <div class="countdown-timer">
                                    <span class="countdown-label text-danger">距離結束</span>
                                    <span id="timer">
                                        <span class="time-box" id="hours">00</span>:
                                        <span class="time-box" id="minutes">00</span>:
                                        <span class="time-box" id="seconds">00</span>
                                    </span>
                                </div>
                            </div>
                            <script>
                                function startCountdown(endTime) {
                                    // 抓取倒計時的各部分
                                    const hoursBox = document.getElementById('hours');
                                    const minutesBox = document.getElementById('minutes');
                                    const secondsBox = document.getElementById('seconds');

                                    function updateTimer() {
                                        const now = new Date().getTime();
                                        const distance = endTime - now;

                                        if (distance > 0) {
                                            // 計算時、分、秒
                                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                            // 更新到 HTML 元素
                                            hoursBox.textContent = hours.toString().padStart(2, '0'); // 保證是兩位數
                                            minutesBox.textContent = minutes.toString().padStart(2, '0');
                                            secondsBox.textContent = seconds.toString().padStart(2, '0');
                                        } else {
                                            // 倒計時結束，顯示「已結束」訊息
                                            hoursBox.textContent = "00";
                                            minutesBox.textContent = "00";
                                            secondsBox.textContent = "00";
                                            clearInterval(intervalId);
                                        }
                                    }

                                    const intervalId = setInterval(updateTimer, 1000);
                                    updateTimer(); // 初始化即刻更新一次
                                }

                                // 設定活動結束時間（例如 2025 年 2 月 5 日 18:00:00）
                                const activityEndTime = new Date("2025-02-03T18:00:00").getTime();
                                startCountdown(activityEndTime);
                            </script>
                            <div id="limitedTimeCarousel" class="carousel slide">
                                <div class="carousel-inner">
                                    <?php
                                    $SQLstring = "SELECT * FROM on_sale, product, product_img, pyclass WHERE on_sale.p_id = product_img.p_id AND on_sale.p_id = product.p_id AND product.classid=pyclass.classid AND product_img.sort = 1 ORDER BY o_sort";
                                    $hot = $link->query($SQLstring);
                                    $count = 0;

                                    while ($data = $hot->fetch()) {
                                        if ($count % 4 == 0) {
                                            // 每四個商品開始新的輪播頁
                                            echo $count == 0 ? '<div class="carousel-item active"><div class="row g-4">' : '<div class="carousel-item"><div class="row g-4">';
                                        }
                                    ?>
                                        <div class="col-md-3">
                                            <div class="card card-trans"><a href="goods.php?p_id=<?php echo $data['p_id']; ?>&level=<?php echo $data['level']; ?>">
                                                    <img src="./product_img/<?php echo $data['img_file']; ?>" class="card-img-top" alt="<?php echo $data['p_name']; ?>"></a>
                                                <div class="card-body">
                                                    <h5 class="card-title text-ellipsis"><?php echo $data['p_name']; ?></h5>
                                                    <p class="card-text text-danger">NT<?php echo $data['p_price']; ?></p>
                                                    <a href="#" class="btn btn-primary">更多資訊</a>
                                                    <a href="#" class="btn btn-success">放購物車</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $count++;
                                        if ($count % 4 == 0) {
                                            // 結束當前輪播頁
                                            echo '</div></div>';
                                        }
                                    }
                                    if ($count % 4 != 0) {
                                        // 補充未結束的輪播頁
                                        echo '</div></div>';
                                    }
                                    ?>
                                </div>

                                <!-- 輪播控制按鈕 -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#limitedTimeCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#limitedTimeCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                        </div>
                        <!-- 熱門商品區 -->
                        <div class="section-container popular">
                            <div class="section-header">
                                <i class="fas fa-fire text-warning"></i>
                                <h2 class="text-warning mb-0">熱門商品</h2>
                            </div>

                            <div id="popularItemsCarousel" class="carousel slide"> <!-- 改成新的ID -->
                                <div class="carousel-inner">
                                    <?php
                                    $SQLstring = "SELECT * FROM hot, product, product_img, pyclass WHERE hot.p_id = product_img.p_id AND hot.p_id = product.p_id AND product.classid=pyclass.classid AND product_img.sort = 1 ORDER BY h_sort";
                                    $hot = $link->query($SQLstring);
                                    $count = 0;

                                    while ($data = $hot->fetch()) {
                                        if ($count % 4 == 0) {
                                            // 每四個商品開始新的輪播頁
                                            echo $count == 0 ? '<div class="carousel-item active"><div class="row g-4">' : '<div class="carousel-item"><div class="row g-4">';
                                        }
                                    ?>
                                        <div class="col-md-3">
                                            <div class="card card-trans"><a href="goods.php?p_id=<?php echo $data['p_id']; ?>&level=<?php echo $data['level']; ?>">
                                                    <img src="./product_img/<?php echo $data['img_file']; ?>" class="card-img-top" alt="<?php echo $data['p_name']; ?>"></a>
                                                <div class="card-body">
                                                    <h5 class="card-title text-ellipsis"><?php echo $data['p_name']; ?></h5>
                                                    <p class="card-text text-success">NT<?php echo $data['p_price']; ?></p>
                                                    <a href="#" class="btn btn-primary">更多資訊</a>
                                                    <a href="#" class="btn btn-success">放購物車</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $count++;
                                        if ($count % 4 == 0) {
                                            // 結束當前輪播頁
                                            echo '</div></div>';
                                        }
                                    }
                                    if ($count % 4 != 0) {
                                        // 補充未結束的輪播頁
                                        echo '</div></div>';
                                    }
                                    ?>
                                </div>

                                <!-- 輪播控制按鈕 -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#popularItemsCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#popularItemsCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <!-- 最新上架區 -->
                        <div class="section-container new-arrival" id="new-arrival-section">
                            <div class="section-header">
                                <i class="fas fa-box-open text-info"></i>
                                <h2 class="text-info mb-0">最新上架</h2>
                            </div>
                            <?php require_once("./product_list.php") ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </section>
    <section id="scontent">
        <?php require_once("./scontent.php") ?>
    </section>
    <section id="footer">
        <?php require_once("./footer.php") ?>
    </section>
</body>
<?php require_once("./jsfile.php") ?>

</html>