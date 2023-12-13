<?php
include("inc/header.php");
include("inc/sidebar.php");
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../classes/customer.php");
include_once($filepath . "/../helpers/format.php");

?>
<?php
$ctm = new customer();
$fm = new Format();
if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
    echo "<script>window.location='inbox.php'</script>";
}else{
    $id = $_GET['customerid'];
    $order_code = $_GET['order_code'];

}

?>

<div class="container cart_bg">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card form_bg">
                <div class="card-header text-white form_bg fs-3 text-center" style="font-weight:bolder;">
                    Order Information
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped catlist mb-0">
                        
                        <tbody>
                            <?php
                        $get_customers = $ctm->show_customers($id);
                        if ($get_customers) {
                            while ($result = $get_customers->fetch_assoc()) {


                            ?>
                                    <tr style="height: 70px;" >
                                        <td class="py-4" style="width: 45%;">Name</td>
                                        <td class="py-4">:</td>
                                        <td class="py-4"><?php echo $result['name']; ?></td>
                                    </tr>

                                    <tr>
                                        <td class="py-4">Email</td>
                                        <td class="py-4">:</td>
                                        <td class="py-4"><?php echo $result['email']; ?></td>
                                        
                                    </tr>

                                    <tr>
                                        <td class="py-4">Phone</td>
                                        <td class="py-4">:</td>
                                        <td class="py-4"><?php echo $result['phone']; ?></td>
                                   
                                    </tr>

                                    <tr>
                                        <td class="py-4">Address</td>
                                        <td class="py-4">:</td>
                                        <td class="py-4"><?php echo $result['address']; ?></td>
                                        
                                    </tr>

                                    <!-- <tr>
                                        <td>Password</td>
                                        <td>:</td>
                                        <td>Đức</td>
                                    </tr> -->
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



<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <!-- <div class="card-header text-white form_bg fs-5" style="font-weight:bolder;">
                Order Management
                </div> -->
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
                                                    <img src="uploads/<?php echo $result_order['image'] ?>" style="width: 70px;">
                                                </div>
                                                <div class="col-md-10">
                                                    <p><?php echo $result_order['productName']; ?></p>
                                                </div>
                                            </div>

                                        </td>
                                        <!-- <td><?php echo $result_order['productName']; ?></td> -->
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
<!-- ----------------------------------------- -->
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#sidebarCollapse").on('click', function() {
            $("#sidebar").toggleClass('active');
        });
    });
</script>
</body>

</html>