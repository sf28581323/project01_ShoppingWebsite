<?php
$SQLstring = "SELECT * FROM pyclass where level=1 ORDER BY sort";
$pyclass01 = $link->query($SQLstring);
$i = 1;
?>
<div class="accordion" id="accordionExample">
    <?php while ($pyclass01_Rows = $pyclass01->fetch()) {
        $i = $pyclass01_Rows['classid']; ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne<?php echo $i; ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i; ?>" aria-expanded="false" aria-controls="collapseOne<?php echo $i; ?>">
                    <i class="fas <?php echo $pyclass01_Rows['fonticon']; ?> fa-lg fa-fw"></i><?php echo $pyclass01_Rows['cname']; ?>
                </button>
            </h2>
            <?php
            if (isset($_GET['classid'])) {
                $SQLstring = "SELECT uplink FROM pyclass WHERE level=2 AND classid=" . $_GET['classid'];
                $classid_rs = $link->query($SQLstring);
                $data = $classid_rs->fetch();
                $ladder = $data['uplink'];
            } else {
                $ladder = 1;
            }
            $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $pyclass01_Rows['classid']);
            $pyclass02 = $link->query($SQLstring);
            ?>
            <!-- <div id="collapseOne<?php echo $i; ?>" class="accordion-collapse collapse <?php echo ($i == $ladder) ? 'show' : ''; ?>" aria-labelledby="headingOne<?php echo $i; ?>" data-bs-parent="#accordionExample"> -->
            <div id="collapseOne<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo $i; ?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table class="table">
                        <tbody>
                            <?php while ($pyclass02_Rows = $pyclass02->fetch()) { ?>
                                <?php
                                // Check if level3 exists for this level2 item
                                $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=3 AND uplink=%d", $pyclass02_Rows['classid']);
                                $pyclass03 = $link->query($SQLstring);
                                if ($pyclass03->rowCount() > 0) { ?>
                                    <!-- Level 2 item with dropdown menu -->
                                    <tr>
                                        <td class="dropdown">
                                            <a href="#" class="dropdown-toggle" id="dropdownMenu<?php echo $pyclass02_Rows['classid']; ?>" data-bs-display="static" aria-expanded="false">
                                                <em class="fas <?php echo $pyclass02_Rows['fonticon']; ?>"></em> <?php echo $pyclass02_Rows['cname']; ?>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu<?php echo $pyclass02_Rows['classid']; ?>">
                                                <?php while ($pyclass03_Rows = $pyclass03->fetch()) { ?>
                                                    <li>
                                                        <a class="dropdown-item" href="./drugstore.php?classid=<?php echo $pyclass03_Rows['classid']; ?>&level=<?php echo $pyclass03_Rows['level']; ?>">
                                                            <em class="fas <?php echo $pyclass03_Rows['fonticon']; ?>"></em> <?php echo $pyclass03_Rows['cname']; ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <!-- Level 2 item without dropdown menu -->
                                    <tr>
                                        <td>
                                            <a href="./drugstore.php?classid=<?php echo $pyclass02_Rows['classid']; ?>&level=<?php echo $pyclass02_Rows['level']; ?>">
                                                <em class="fas <?php echo $pyclass02_Rows['fonticon']; ?>"></em> <?php echo $pyclass02_Rows['cname']; ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php $i++;
    } ?>
</div>
<script>
    document.querySelectorAll('.dropdown-toggle').forEach(function (dropdown) {
    dropdown.addEventListener('click', function (e) {
        e.preventDefault(); // 確保點擊僅觸發 Bootstrap 的下拉行為
    });
});
// 控制第二層和第三層交互
document.querySelectorAll('.dropdown-toggle').forEach(function (dropdown) {
        dropdown.addEventListener('click', function (e) {
            e.stopPropagation(); // 阻止事件冒泡
        });
    });

    document.querySelectorAll('.accordion-body .dropdown-menu').forEach(function (menu) {
        menu.addEventListener('click', function (e) {
            e.stopPropagation(); // 阻止事件冒泡
        });
    });

</script>