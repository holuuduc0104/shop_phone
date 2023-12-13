<?php
include("inc/header.php");
include("inc/sidebar.php");

$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../classes/cart.php");
include_once($filepath . "/../helpers/format.php");

?>
<?php
$ct = new cart();
if (isset($_GET['shiftid'])) {
   $id = $_GET['shiftid'];
   $shifted = $ct->shifted($id);
   if($shifted){
    echo "<script>window.location='inbox.php'</script>";
}
}

if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $del_shifted = $ct->del_shifted($id);
    if($del_shifted){
        echo "<script>window.location='inbox.php'</script>";
    }
 }


?>
<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                Order Management
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped catlist mb-0">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%;">No.</th>
                                <th scope="col" style="width: 20%;">Order Time</th>
                                <th scope="col" style="width: 15%;">Order Code</th>
                                <th scope="col" style="width: 15%;">Customer Name</th>
                                <th scope="col" style="width: 10%;">View Details</th>
                                <th scope="col" class="text-center">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $fm = new Format();
                            $ct = new cart();
                            $get_inbox_cart = $ct->get_inbox_cart();
                            if ($get_inbox_cart) {
                                $i = 0;
                                while ($result = $get_inbox_cart->fetch_assoc()) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td scope="row"><?php echo $i; ?></td>
                                        <td><?php echo $fm->formatDate($result['date_created']); ?></td>
                                        <td><?php echo $result['order_code']; ?></td>
                                        <td><?php echo $result['name']; ?></td>
                                        <td><a href="customer.php?customerid=<?php echo $result['customer_id']; ?>&order_code=<?php echo $result['order_code']; ?>" class="fw-bolder">View Order</a></td>
                                        
                                        <td class="text-center">
                                            <?php
                                            if ($result['status'] == 0) {
                                            ?>
                                                <a href="?shiftid=<?php echo $result['order_code']; ?>" class="fw-bolder">Confirm</a>
                                            <?php
                                            } elseif ($result['status'] == 1) {
                                            ?>
                                               Shipping...
                                            <?php
                                            }else{
                                            ?>
                                                <a href="?delid=<?php echo $result['order_code']; ?>" class="fw-bolder">Remove</a>
                                            <?php
                                            }}
                                            ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>
<!--------------------------------------------->
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