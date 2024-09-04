<!-- <?php
include("inc/header.php");
?>
<?php
// if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
//     echo "<script>window.location='404.php'</script>";
// } else {
//     $id = $_GET['proid'];
// }
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
//     $quantity = $_POST['quantity'];
//     $addtocart = $ct->add_to_cart($quantity, $id);
//     if ($addtocart == 'true') {
//         echo '<script>alert("Added Product To Cart Successfully!");
//             </script>';
//     } else if ($addtocart == 'added') {
//         echo '<script>alert("Product Already Added!");
//             </script>';
//     }
// }
// if (isset($_GET['key'])) {
//     $key = $_GET['key'];
//     $search = $product->searching($key);
// }
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $delfavo = $ct->del_favorite($delid);
}
?>
<div class="main">
    <section class="content my-5">
        <div class="container">
            <div class="products mb-3">
                <div class="border-bottom text-start border-3 ms-4">
                    <h3><strong>FEATERED</strong></h3>
                </div>
                <div class="product_list py-3">
                    <div class="row">
                        <?php
                        $product_featered = $product->getproduct_featered();
                        if ($product_featered) {
                            while ($result = $product_featered->fetch_assoc()) {
                        ?>
                                <div class="col-md-3 pro_list ">
                                    <div class="product pt-3 px-3">
                                        <a href="details.php?proid=<?php echo $result['productID']; ?>"><img src="admin/uploads/<?php echo $result['image']; ?>" class="img-fluid "></a>
                                        <h4><a href="details.php?proid=<?php echo $result['productID']; ?>" class="text-dark"><?php echo $result['productName'] ?></a></h4>
                                        <h3 class="text-danger"><?php echo '$' . $fm->format_currency($result['price']); ?></h3>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div> 
        </div>
    </section>
</div>
<?php
include("inc/footer.php");
?> -->