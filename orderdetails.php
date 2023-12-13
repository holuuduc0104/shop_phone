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
$ct = new cart();
if (isset($_GET['confirmid'])) {
    $id = $_GET['confirmid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $shifted_confirm = $ct->shifted_confirm($id, $time, $price);
}
?>
<div class="container-fluid mt-2 cart_bg" style="padding-top:50px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card form_bg">
                <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                    Your Details Ordered.
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped catlist">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 47%;">Product</th>
                                <th scope="col" style="width: 10%;">Price</th>
                                <th scope="col" style="width: 10%;">Quantity</th>
                                <th scope="col" style="width: 17%;">Date</th>
                                <th scope="col" style="width: 10%;">Status</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $customer_id = Session::get('customer_id');
                            $get_cart_ordered = $ct->get_cart_ordered($customer_id);
                            if ($get_cart_ordered) {
                                while ($result = $get_cart_ordered->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="admin/uploads/<?php echo $result['image'] ?>" style="width: 100px;">
                                                </div>
                                                <div class="col-md-9">
                                                    <p><?php echo $result['productName']; ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo '$' . $fm->format_currency($result['price']); ?></td>
                                        <td><?php echo $result['quantity']; ?></td>
                                        <td>
                                            <?php echo $fm->formatDate($result['date_order']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($result['status'] == '0') {
                                                echo 'Pending';
                                            } elseif ($result['status'] == '1') {
                                                echo 'Shifted';
                                            } else {
                                                echo 'Recieved';
                                            }
                                            ?>
                                        </td>
                                        <?php
                                        if ($result['status'] == '0') {
                                        ?>
                                            <td class="text-center"><?php echo 'N/A'; ?></td>
                                        <?php
                                        } elseif ($result['status'] == '2') {
                                        ?>
                                            <td class="text-center">
                                                Recieved
                                            </td>
                                        <?php
                                        } elseif ($result['status'] == '1') {
                                        ?>
                                            <td class="text-center">
                                                <a href="?confirmid=<?php echo $customer_id; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date_order']; ?>" class="fw-bolder">Confirm</a>
                                            </td>

                                        <?php
                                        }
                                        ?>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

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