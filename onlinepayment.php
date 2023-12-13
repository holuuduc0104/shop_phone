<?php
include("inc/header.php");
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('location: login.php');
} else {
    echo '';
}
?>

<div class="container-fluid mt-2 cart_bg" style="height: 500px; padding-top:100px;">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card form_bg">
                <div class="card-header text-white form_bg text-center" style="font-weight:bolder;">
                    Payment Method
                </div>

                <div class="card-body p-0">

                    <table class="table catlist ">

                        <tbody>
                            <!-- <div class="d-flex justify-content-around text-center">
                              <input type="hidden" name="total_price" value="<?php ; ?>">
                                <form action="momo.php" method="POST">
                                        <button type="button" class="btn btn-danger my-3" style="width: 170px; height: 50px;" name="">MOMO</button>
                                </form>
                               
                            </div> -->
                            <tr>
                                <td>
                            <div class="text-end me-3">
                                        <a href="offlinepayment.php"><button type="button" class="btn btn-danger my-3" style="width: 170px; height: 50px;">Offline Payment</button></a>

                                    </div>
                            </td>
                            <td>
                                    <div class="text-start ms-3">
                                        <a href="onlinepayment.php"><button type="button" class="btn btn-danger my-3" style="width: 170px; height: 50px;">Online Payment</button></a>
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
include('inc/footer.php');
?>