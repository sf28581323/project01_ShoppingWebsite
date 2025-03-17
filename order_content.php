<?php
$maxRows_rs = 5;
$pageNum_rs = 0;
if (isset($_GET['pageNum_order_rs'])) {
    $pageNum_rs = $_GET['pageNum_order_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;
$queryFirst = sprintf("SELECT uorder.orderid,uorder.create_date as orderTime, uorder.remark,ms1.msname as howpay, ms2.msname as status, addbook.* FROM uorder,addbook,multiselect as ms1,multiselect as ms2 WHERE ms2.msid=uorder.status AND ms1.msid=uorder.howpay AND uorder.emailid='%d' AND uorder.addressid=addbook.addressid ORDER BY uorder.create_date DESC", $_SESSION['emailid']);
$query = sprintf("%s LIMIT %d, %d", $queryFirst, $startRow_rs, $maxRows_rs);
$order_rs = $link->query($query);
$i = 21;
?>
<h3>訂單查詢</h3>
<?php if ($order_rs->rowCount() != 0) { ?>
    <div class="accordion" id="accordion_order">
        <?php while ($data01 = $order_rs->fetch()) { ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne<?php echo $i; ?>">
                    <a class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $i; ?>" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
                        <div class="table-responsive-md" style="width: 100%;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td width="10%">訂單編號</td>
                                        <td width="20%">下單日期時間</td>
                                        <td width="15%">付款方式</td>
                                        <td width="15%">訂單狀態 </td>
                                        <td width="10%">收件人</td>
                                        <td width="20%">地址</td>
                                        <td width="10%">備註</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $data01['orderid']; ?></td>
                                        <td><?php echo $data01['orderTime']; ?></td>
                                        <td><?php echo $data01['howpay']; ?></td>
                                        <td><?php echo $data01['status']; ?></td>
                                        <td><?php echo $data01['cname']; ?></td>
                                        <td><?php echo $data01['address']; ?></td>
                                        <td><?php echo $data01['remark']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </a>
                </h2>
                <div id="collapseOne<?php echo $i; ?>" class="accordion-collapse collapse <?php echo ($i == 21) ? 'show' : ''; ?>" aria-labelledby="headingOne<?php echo $i; ?>" data-bs-parent="#accordion_order">
                    <div class="accordion-body">
                        <?php
                        $SQLstring = sprintf("SELECT *,ms1.msname as status FROM cart,product,product_img,multiselect as ms1 WHERE cart.orderid='%s' AND ms1.msid=cart.status AND cart.p_id=product_img.p_id AND product.p_id=product_img.p_id AND cart.p_id=product.p_id AND product_img.sort=1 ORDER BY cart.create_date DESC", $data01['orderid']);
                        $cart_rs = $link->query($SQLstring);
                        $pTotal = 0;
                        ?>
                        <div class="table-responsive-md" style="width: 100%;">
                            <table class="table table-hover mt-3">
                                <thead>
                                    <tr class="text-bg-primary" style="color: #fff;">
                                        <th width="10%">產品編號</th>
                                        <th width="10%">圖片</th>
                                        <th width="30%">名稱</th>
                                        <th width="10%">價格</th>
                                        <th width="10%">數量</th>
                                        <th width="15%">小計</th>
                                        <th width="15%">狀態</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($cart_data = $cart_rs->fetch()) { ?>
                                        <tr>
                                            <td><?php echo $cart_data['p_id']; ?></td>
                                            <td><img src="./product_img/<?php echo $cart_data['img_file']; ?>" alt="<?php echo $cart_data['p_name']; ?>" class="img-fluid"></td>
                                            <td><?php echo $cart_data['p_name']; ?></td>
                                            <td>
                                                <h4 class="color_e600a0 pt-1">$<?php echo $cart_data['p_price']; ?></h4>
                                            </td>
                                            <td><?php echo $cart_data['qty']; ?></td>
                                            <td>
                                                <h4 class="color_e600a0 pt-1">$<?php echo $cart_data['p_price'] * $cart_data['qty']; ?></h4>
                                            </td>
                                            <td><?php echo $cart_data['status']; ?></td>
                                        </tr>
                                    <?php $pTotal += $cart_data['p_price'] * $cart_data['qty'];
                                    } ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <td colspan="7">累計：$<?php echo $pTotal; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">運費：100</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="color_red">總計：$<?php echo $pTotal + 100; ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        <?php $i++;
        } ?>
    </div>
    <?php
    if (isset($_GET['totalRows_rs'])) {
        $totalRows_rs = $_GET['totalRows_rs'];
    } else {
        $all_rs = $link->query($queryFirst);
        $totalRows_rs = $all_rs->rowCount();
    }
    $totalRows_rs = ceil($totalRows_rs / $maxRows_rs) - 1;
    $prev_rs = "&laquo";
    $next_rs = "&raquo";
    $separator = "|";
    $max_links = 20;
    $pages_rs = buildNavigation($pageNum_rs, $totalRows_rs, $prev_rs, $next_rs, $separator, $max_links, true, 3, "order_rs");
    ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php echo $pages_rs[0] . $pages_rs[1] . $pages_rs[2]; ?>
        </ul>
    </nav>
<?php } else { ?>
    <div class="alert alert-info" role="alert">
        抱歉！目前還沒有任何訂單。
    </div>
<?php } ?>