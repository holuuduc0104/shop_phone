<?php
include("inc/header.php");
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
}
?>

<div class="container-fluid mt-1 success-bg" style="height: 500px; padding-top:100px;">

    <div class="col-md- text-white fs-1 mx-auto text-center">
        <p>Order Successful.</p>
    </div>
    <?php
    $customer_id = Session::get('customer_id');

    $get_amount = $ct->getAmounPrice($customer_id);
    if ($get_amount) {
        $amount = 0;
        while ($result = $get_amount->fetch_assoc()) {
            $price = $result['price'];
            $amount += $price;
        }
    }
    ?>
    <div class="col-md- text-white fs-3 mx-auto text-center">
        <p>Total amount payable is: <strong class="text-primary"><?php echo '$'.$fm->format_currency($amount); ?></strong></p>
        <p>See order details at <a href="orderdetails.php">here</a></p>
    </div>


</div>
<?php
include('inc/footer.php');
?>