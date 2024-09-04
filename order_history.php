<?php
include("inc/header.php");
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    echo '<script>window.location="login.php";</script>';
}
if (isset($_GET['received'])) {
    $id = $_GET['received'];
    $received = $ct->confirm_received($id);
    if($received){
        echo "<script>window.location='order_history.php'</script>";
    }
 }
?>

<div class="container-fluid mt-2 cart_bg" style="padding:70px">
    <div class="row justify-content-center">

        <div class="col-md-11">
            <div class="card form_bg my-5">
                <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                    Order History
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped catlist">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%;">No.</th>
                                <th scope="col" style="width: 25%;">Order Time</th>
                                <th scope="col" style="width: 15%;">Order Code</th>
                                <th scope="col" style="width: 20%;">Status</th>
                                <th scope="col" style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_order_history = $ct->get_order_history(Session::get('customer_id'));
                            if ($get_order_history) {
                                $i = 0;
                                while ($result = $get_order_history->fetch_assoc()) {
                                    $i++;

                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $fm->formatDate($result['date_created']); ?></td>
                                        <td><?php echo $result['order_code']; ?></td>

                                        <?php
                                        if ($result['status'] == '0') {
                                        ?>
                                            <td>Processing</td>
                                        <?php
                                        } elseif ($result['status'] == '1') {
                                        ?>
                                            <td>
                                                Shipping | 
                                            <a href="?received=<?php echo $result['order_code']; ?>">Received</a>
                                            </td>
                                        <?php
                                        } elseif ($result['status'] == '2') {
                                        ?>
                                            <td>Complete</td>
                                        <?php

                                        }
                                        ?>
                                        <td><a href="history_order_detail.php?customerid=<?php echo $result['customer_id']; ?>&order_code=<?php echo $result['order_code'] ?>">View Details</a></td>
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