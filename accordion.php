<?php
$SQLstring = "SELECT * FROM pyclass WHERE level=1 ORDER BY sort";
$pyclass01 = $link->query($SQLstring);
if (!$pyclass01) {
    die("Query failed: " . $link->error);
}

$i = 1;
?>
<div class="accordion" id="accordionExample">
    <?php while ($pyclass01_Rows = $pyclass01->fetch()) {
        if (!$pyclass01_Rows) {
            continue;
        }
        $i = $pyclass01_Rows['classid']; ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne<?php echo $i; ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $i; ?>">
                    <i class="fas <?php echo $pyclass01_Rows['fonticon']; ?> fa-lg fa-fw"></i><?php echo $pyclass01_Rows['cname']; ?>
                </button>
            </h2>
            <?php
            if(isset($_GET['p_id'])){
                $SQLstring = sprintf("SELECT uplink, level FROM pyclass,product WHERE pyclass.classid=product.classid AND p_id=%d", $_GET['p_id']);
                $classid_rs = $link->query($SQLstring);
                $data = $classid_rs->fetch();
                $ladder = $data['uplink'];
                if ($data['level'] == 3) {
                    // 如果是第三層，要往上找兩層
                    $SQLstring = "SELECT uplink FROM pyclass WHERE classid=" . $data['uplink'];
                    $parent_rs = $link->query($SQLstring);
                    $parent_data = $parent_rs->fetch();
                    $ladder = $parent_data['uplink'];
                } else {
                    $ladder = $data['uplink'];
                }
            } elseif (isset($_GET['level']) && $_GET['level']==1){
                $ladder = $_GET['classid'];
            } elseif (isset($_GET['classid'])) {
                // 先檢查是否為第三層
                $SQLstring = "SELECT uplink, level FROM pyclass WHERE classid=" . $_GET['classid'];
                $classid_rs = $link->query($SQLstring);
                $data = $classid_rs->fetch();

                if ($data['level'] == 3) {
                    // 如果是第三層，要往上找兩層
                    $SQLstring = "SELECT uplink FROM pyclass WHERE classid=" . $data['uplink'];
                    $parent_rs = $link->query($SQLstring);
                    $parent_data = $parent_rs->fetch();
                    $ladder = $parent_data['uplink'];
                } elseif ($data['level'] == 2) {
                    // 如果是第二層，直接使用其 uplink
                    $ladder = $data['uplink'];
                } else {
                    $ladder = $_GET['classid'];
                }
            } else {
                $ladder = 1;
            }

            // 獲取第二層類別
            $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $pyclass01_Rows['classid']);
            $pyclass02 = $link->query($SQLstring);
            ?>
            <div id="collapseOne<?php echo $i; ?>" class="accordion-collapse collapse <?php echo ($i == $ladder) ? 'show' : ''; ?>" aria-labelledby="headingOne<?php echo $i; ?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table class="table">
                        <tbody>
                            <?php while ($pyclass02_Rows = $pyclass02->fetch()) {
                                if (!$pyclass02_Rows) {
                                    continue;
                                }
                                // Move the third level query here where we have access to $pyclass02_Rows
                                $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=3 AND uplink=%d ORDER BY sort", $pyclass02_Rows['classid']);
                                $pyclass03 = $link->query($SQLstring);
                                if ($pyclass03 && $pyclass03->rowCount() > 0) { ?>
                                    <tr>
                                        <td class="dropdown">
                                            <a href="#" class="dropdown-toggle" id="dropdownMenu<?php echo $pyclass02_Rows['classid']; ?>" data-bs-display="static" aria-expanded="false">
                                                <em class="fas <?php echo $pyclass02_Rows['fonticon']; ?>"></em> <?php echo $pyclass02_Rows['cname']; ?>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu<?php echo $pyclass02_Rows['classid']; ?>">
                                                <?php while ($pyclass03_Rows = $pyclass03->fetch()) {
                                                    if (!$pyclass03_Rows) {
                                                        continue;
                                                    } ?>
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
document.addEventListener('DOMContentLoaded', function() {
    // 確保只選取 accordionExample 中的項目
    const accordionContainer = document.getElementById('accordionExample');
    
    // 檢查 accordionExample 是否存在
    if (!accordionContainer) return;
    
    // 從 localStorage 讀取上次展開的項目
    const lastOpenedItem = localStorage.getItem('lastOpenedAccordion');
    const accordionItems = accordionContainer.querySelectorAll('.accordion-collapse');
    
    // 先移除所有的 'show' class
    accordionItems.forEach(item => {
        if (item.classList.contains('show')) {
            item.classList.remove('show');
        }
    });

    // 如果有儲存的展開項目，則展開它
    if (lastOpenedItem) {
        const accordionItem = accordionContainer.querySelector(lastOpenedItem);
        if (accordionItem) {
            accordionItem.classList.add('show');
        }
    }

    // 監聽 accordion 的展開/收合事件
    accordionItems.forEach(item => {
        item.addEventListener('shown.bs.collapse', function() {
            localStorage.setItem('lastOpenedAccordion', '#' + this.id);
            // 確保其他項目都是收合的
            accordionItems.forEach(otherItem => {
                if (otherItem !== this && otherItem.classList.contains('show')) {
                    otherItem.classList.remove('show');
                }
            });
        });
    });
});
</script>