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
// if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
//     $quantity = $_POST['quantity'];
//     $addtocart = $ct->add_to_cart($quantity,$id);
//     if ($addtocart == 'true') {
//         echo '<script>alert("Added Product To Cart Successfully!");
//             </script>';
//     }else if($addtocart == 'added'){
//         echo '<script>alert("Product Already Added!");
//             </script>';
//     }

// }
?>
<div class="container-fluid mt-2 cart_bg" style="height: 570px; padding-top:70px;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card form_bg">
                <div class="card-header text-white form_bg" style="font-weight:bolder;">
                    Your Profile
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped catlist">
                        
                        <tbody>
                            <?php
                            $id = Session::get('customer_id');
                            $get_customers = $ctm->show_customers($id);
                            if ($get_customers) {
                                while ($result = $get_customers->fetch_assoc()) {


                            ?>
                                    <tr style="height: 70px;" >
                                        <td class="py-4" style="width: 500px;">Name</td>
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
            <div class="text-center">
            <a href="editprofile.php"><button type="button" class="btn btn-danger my-3" style="width: 150px; height: 50px;">Update Profile</button></a>

            </div>
        </div>
    </div>
</div>
<?php
include('inc/footer.php');
?>