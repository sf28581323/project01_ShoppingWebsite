<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php"><img src="./images/logo.webp" class="img-fluid rounded-circle" alt="B|3C購物網|Q"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        $SQLstring = "SELECT * FROM cart WHERE orderid is NULL AND ip='" . $_SERVER['REMOTE_ADDR'] . "'";
        $cart_rs = $link->query($SQLstring);
        ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- 添加空白區域，將導航項目往右推 -->
            <div class="me-auto" style="width: 30%;"></div>
            
            <!-- 導航項目，移除 mx-auto 使其不居中 -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                <?php if (isset($_SESSION['login'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="btn_confirmLink('是否確定登出？','logout.php')">會員登出</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">會員登入/註冊</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">會員中心</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">最新活動</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" aria-expanded="false">
                        企業專區
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">認識企業文化</a></li>
                        <li><a class="dropdown-item" href="#">全台門市資訊</a></li>
                        <li><a class="dropdown-item" href="#">供應商報價服務</a></li>
                        <li><a class="dropdown-item" href="#">加盟專區</a></li>
                        <li><a class="dropdown-item" href="#">投資人專區</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./orderlist.php">查訂單</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">折價券</a>
                </li>
            </ul>
            
            <!-- 右側元素：購物車和會員頭像，添加左邊距使其與導航項目有間隔 -->
            <div class="d-flex align-items-center ms-4">
                <a class="nav-link" href="./cart.php">
                    <i class="fas fa-shopping-cart" style="color: #74C0FC;">
                        <span class="badge text-bg-info"><?php echo ($cart_rs) ? $cart_rs->rowCount() : ''; ?></span>
                    </i>
                </a>
                
                <?php if (isset($_SESSION['login'])) { ?>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="./uploads/<?php echo (isset($_SESSION['imgname']) && $_SESSION['imgname'] !== '' ? $_SESSION['imgname'] : 'avatar.svg'); ?>" width="40" height="40" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="orderlist.php">訂單查詢</a></li>
                        <li><a class="dropdown-item" href="profile.php">編輯個人資料</a></li>
                        <li><a class="dropdown-item" href="#" onclick="btn_confirmLink('是否確定登出？','logout.php')">登出</a></li>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
<script>
    document.querySelectorAll('.nav-item.dropdown > .nav-link').forEach(function(dropdown) {
        dropdown.addEventListener('click', function(e) {
            e.preventDefault(); // 阻止點擊行為
        });
    });
</script>