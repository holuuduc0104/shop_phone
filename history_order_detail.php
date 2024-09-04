<?php
include("inc/header.php");
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    echo '<script>window.location="login.php";</script>';
}
?>
<?php
if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
    echo "<script>window.location='404.php'</script>";
}else{
    $id = $_GET['customerid'];
    $order_code = $_GET['order_code'];
}


?>



<div class="container-fluid mt-2 cart_bg" style="padding:70px;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                    Order History Detail
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped catlist mb-0">
                        <thead>
                            <tr style="height: 50px;">
                                <th scope="col" style="width: 50%;">Product</th>
                                <th scope="col" style="width: 15%;">Price</th>
                                <th scope="col" style="width: 10%;">Quantity</th>
                                <th scope="col" style="width: 15%;">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_order = $ctm->show_order($order_code);
                            if ($get_order) {
                                $sub_total = 0;
                                $total = 0;
                                while ($result_order = $get_order->fetch_assoc()) {
                                    $sub_total = $result_order['price']*$result_order['quantity'];
                                    $total += $sub_total;
                            ?>
                                    <tr style="height: 60px;">
                                    <td>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img src="admin/uploads/<?php echo $result_order['image'] ?>" style="width: 70px;">
                                                </div>
                                                <div class="col-md-10">
                                                    <p><?php echo $result_order['productName']; ?></p>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="py-2"><?php echo '$' . $fm->format_currency($result_order['price']); ?></td>
                                        <td class="py-2"><?php echo $result_order['quantity']; ?></td>
                                        <td class="py-2"><?php echo '$' . $fm->format_currency($sub_total); ?></td>                                        
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="4">
                                    <div class="row">
                                        <div class="col-md-1 text-end">
                                            Total:
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                        <?php echo '$' . $fm->format_currency($total); ?>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        </tbody>
                       
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>

<?php
include("inc/footer.php");
?>