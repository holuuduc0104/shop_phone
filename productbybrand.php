<?php
include("inc/header.php");
?>
<br><br>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script>window.location='404.php'</script>";
} else {
    $catid = $_GET['catid'];
}

if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
    echo "<script>window.location='404.php'</script>";
} else {
    $brandid = $_GET['brandid'];
}
?>

<div class="main">

    <section class="content my-5">
        <div class="container">

            <div class="products mb-3">
                <div class="product_list py-3">
                    <div class="row">
                        <?php
                        $getall_product_by_brand = $product->getall_product_by_brand($brandid, $catid);
                        if ($getall_product_by_brand) {
                            while ($result = $getall_product_by_brand->fetch_assoc()) {
                        ?>
                                <div class="col-md-3 pro_list">
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
    </section>
</div>
<?php
include("inc/footer.php");
?>