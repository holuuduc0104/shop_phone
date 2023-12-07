<?php
include("inc/header.php");
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
if(!isset($_GET['id'])){
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>
<div class="container-fluid mt-2 cart_bg">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white form_bg" style="font-weight:bolder;">
                    Your Cart
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped catlist">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 700px;">Product</th>
                                <th scope="col" style="width: 220px;">Price</th>
                                <th scope="col" style="width: 220px;">Quantity</th>
                                <th scope="col" style="width: 220px;">Total Price</th>
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
                                                    <img src="admin/uploads/<?php echo $result['image'] ?>" style="width: 100px;">
                                                </div>
                                                <div class="col-md-10">
                                                    <p><?php echo $result['productName']; ?></p>
                                                </div>
                                            </div>

                                        </td>
                                        <td><?php echo '$' . $result['price']; ?></td>
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
                                            echo '$' . $total;
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
                                }elseif(!Session::get('customer_login')){
                                    echo '<span class="text-danger fs-3">Your Cart is Empty!</span>';
                                }
                                
                                else{
                                    echo '<span class="text-danger fs-3">Your Cart is Empty!</span>';
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-danger my-3" style="width: 150px; height: 50px;">Checkout</button>

            </div>
        </div>
    </div>
</div>

<?php
include("inc/footer.php");
?>