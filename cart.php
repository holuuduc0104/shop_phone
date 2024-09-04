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
if (isset($_GET['cartid'])) {
    $cartid = $_GET['cartid'];
    $delcart = $ct->del_product_cart($cartid);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $cartID = $_POST['cartID'];
    $quantity = $_POST['quantity'];
    $update_quantity_cart = $ct->update_quantity_cart($quantity, $cartID);
    if ($quantity == 0) {
        $delcart = $ct->del_product_cart($cartID);
    }
}
if (!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>
<div class="container-fluid mt-2 cart_bg" style="padding-top:50px;">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card form_bg">
                <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                    Your Cart
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped catlist">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 45%;">Product</th>
                                <th scope="col" style="width: 10%;">Price</th>
                                <th scope="col" style="width: 15%;">Quantity</th>
                                <th scope="col" style="width: 15%;">Total Price</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_product_cart = $ct->get_product_cart();
                            if ($get_product_cart) {
                                $subtotal = 0;
                                $qty = 0;
                                while ($result = $get_product_cart->fetch_assoc()) {

                            ?>
                                    <tr>
                                        <td>
                                            <div class="row">

                                                <div class="col-md-2">
                                                    <a href="details.php?proid=<?php echo $result['productID']; ?>">
                                                        <img src="admin/uploads/<?php echo $result['image'] ?>" style="width: 100px;">
                                                    </a>
                                                </div>
                                                <div class="col-md-10">
                                                    <a href="details.php?proid=<?php echo $result['productID']; ?>">
                                                    <p class="text-dark"><?php echo $result['productName']; ?></p>
                                                    </a>
                                                </div>
                                            </div>

                                        </td>
                                        <td><?php echo '$' . $fm->format_currency($result['price']); ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="cartID" value="<?php echo $result['cartID']; ?>">

                                                <input type="number" name="quantity" min="0" value="<?php echo $result['quantity']; ?>" style="width:70px;">
                                                <input type="submit" name="submit" class="btn btn-danger" value="Update" style="height:33px; margin-top: -6px">
                                            </form>
                                        </td>
                                        <td>
                                            <?php
                                            $total = $result['price'] * $result['quantity'];
                                            echo '$' . $fm->format_currency($total);
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="?cartid=<?php echo $result['cartID']; ?>" class="text-danger" style="font-weight:bold;">Delete</a>
                                        </td>
                                    </tr>
                            <?php
                                    $subtotal += $total;
                                    $qty += 1;
                                }
                            }
                            ?>
                            <tr>
                                <?php
                                $check_cart = $ct->check_cart();
                                if ($check_cart) {

                                ?>
                                    <td colspan="5">
                                        <div class="row">
                                            <div class="col-md-7">

                                            </div>

                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        Sub Total:
                                                    </div>
                                                    <div class="col-md-7">
                                                        <?php
                                                        echo '$' . $subtotal;
                                                        Session::set('sum', $subtotal);
                                                        Session::set('qty', $qty);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                <?php
                                } else {
                                    echo '<script>alert("Your Cart is Empty!");
                                            window.location="index.php";
                                            </script>';
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="text-center">
                <a href="payment.php"><button type="button" class="btn btn-danger my-3" style="width: 150px; height: 50px;">Checkout</button></a>

            </div>
        </div>
    </div>
</div>

<?php
include("inc/footer.php");
?>