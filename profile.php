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
<div class="container-fluid mt-2 cart_bg">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white form_bg" style="font-weight:bolder;">
                    Your Profile
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped catlist">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 700px;">Product</th>
                                <th scope="col" style="width: 220px;">Price</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>Name</td>
                                <td>Đức</td>

                                <td class="text-center">
                                    <a href="">Edit</a>
                                </td>
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