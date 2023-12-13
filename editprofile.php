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
<?php
// if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
//     echo "<script>window.location='404.php'</script>";
// } else {
//     $id = $_GET['proid'];
// }
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $updateCustomer = $ctm->update_customer($_POST, $id);
    // if ($updateCustomer == 'true') {
    //     echo '<script>alert("Added Product To Cart Successfully!");
    //     window.location="profile.php";</script>';
    // }else if($addtocart == 'added'){
    //     echo '<script>alert("Product Already Added!");
    //         </script>';
    // }

}
?>
<div class="container-fluid mt-2 cart_bg" style="height: 620px; padding-top:70px;">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card form_bg">
                <div class="card-header text-white form_bg" style="font-weight:bolder;">
                    Edit Profile
                </div>
                <?php
                if (isset($updateCustomer)) {
                    echo '<td colspan="3">' . $updateCustomer . '</td>';
                }
                ?>
                <form action="" method="post">
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
                                            <td class="py-4" style="width: 500px;">Name</td>
                                            <td class="py-4">:</td>
                                            <td class="py-4"><input type="text" name="name" value="<?php echo $result['name']; ?>" style="width: 500px; height:40px;"></td>
                                        </tr>

                                        <tr>
                                            <td class="py-4">Email</td>
                                            <td class="py-4">:</td>
                                            <td class="py-4"><input type="text" name="email" value="<?php echo $result['email']; ?>" style="width: 500px; height:40px;"></td>
                                        </tr>

                                        <tr>
                                            <td class="py-4">Phone</td>
                                            <td class="py-4">:</td>
                                            <td class="py-4"><input type="text" name="phone" value="<?php echo $result['phone']; ?>" style="width: 500px; height:40px;"></td>
                                        </tr>

                                        <tr>
                                            <td class="py-4">Address</td>
                                            <td class="py-4">:</td>
                                            <td class="py-4"><input type="text" name="address" value="<?php echo $result['address']; ?>" style="width: 500px; height:40px;"></td>
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
            <div class="text-center">
                <input type="submit" class="btn btn-danger my-3" style="width: 150px; height: 50px;" value="Save" name="save">
            </div>
            </form>
        </div>
    </div>
</div>
<?php
include('inc/footer.php');
?>