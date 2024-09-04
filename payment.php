<?php
include("inc/header.php");
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insertOrder = $ct->insertOrder($customer_id);
    $delCart = $ct->del_all_product_cart($customer_id);
    if ($delCart == 'true') {
        echo '<script>window.location="Success.php";;
                </script>';
    } else {
        echo '<script>alert("Order Failed!");
                </script>';
    }
}

?>
<div class="container-fluid mt-2 cart_bg" style="padding-top:50px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card form_bg">
                <div class="card-header text-white form_bg text-center fs-3" style="font-weight:bolder;">
                    Offline Payment
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped catlist">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 700px;">Product</th>
                                <th scope="col" style="width: 220px;">Price</th>
                                <th scope="col" style="width: 220px;">Quantity</th>
                                <th scope="col" style="width: 220px;">Total Price</th>
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
                                        <td><?php echo '$' . $fm->format_currency($result['price']); ?></td>
                                        <td><?php echo $result['quantity']; ?></td>
                                        <td>
                                            <?php
                                            $total = $result['price'] * $result['quantity'];
                                            echo '$' . $fm->format_currency($total);
                                            ?>
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
                                                    <div class="col-md-5 text-danger fw-bolder">
                                                        Sub Total:
                                                    </div>
                                                    <div class="col-md-7 text-danger fw-bolder">
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
                                } elseif (!Session::get('customer_login')) {
                                    echo '<span class="text-danger fs-3">Your Cart is Empty!</span>';
                                } else {
                                    echo '<span class="text-danger fs-3">Your Cart is Empty!</span>';
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card form_bg">
                
                <div class="card-body p-0">
                    <table class="table table-striped catlist">

                        <tbody>
                            <?php
                            $id = Session::get('customer_id');
                            $get_customers = $ctm->show_customers($id);
                            if ($get_customers) {
                                while ($result = $get_customers->fetch_assoc()) {


                            ?>
                                    <tr style="height: 70px;">
                                        <td class="py-4 ps-4" style="width: 700px;">Name</td>
                                        <td class="py-4">:</td>
                                        <td class="py-4"><?php echo $result['name']; ?></td>
                                    </tr>

                                    <tr>
                                        <td class="py-4 ps-4">Email</td>
                                        <td class="py-4">:</td>
                                        <td class="py-4"><?php echo $result['email']; ?></td>
                                    </tr>

                                    <tr>
                                        <td class="py-4 ps-4">Phone</td>
                                        <td class="py-4">:</td>
                                        <td class="py-4"><?php echo $result['phone']; ?></td>
                                    </tr>

                                    <tr>
                                        <td class="py-4 ps-4">Address</td>
                                        <td class="py-4">:</td>
                                        <td class="py-4"><?php echo $result['address']; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">

                    <a href="editprofile.php" class="text-white fw-bolder fs-4 lh-lg border-bottom edit_pf">Update Profile</a>

                </div>
            </div>

        </div>
    </div>
    <br>

    <div class="text-center">
        <tr>
            <div class="d-flex justify-content-evenly">
                <a href="?orderid=order"><button type="button" class="btn btn-danger my-3" style="width: 170px; height: 50px;">Order</button></a>

            </div>




        </tr>
    </div>
</div>


<?php
include('inc/footer.php');
?>