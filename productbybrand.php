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
            <?php
            $get_brand_name = $brand->getbrandbyid_fe($brandid);
            if ($get_brand_name) {
                while ($result_brand = $get_brand_name->fetch_assoc()) {
            ?>
                    <div class="text-center">
                        <span class="badge bg-info fs-2 mb-5" style="width: 300px; height: 50px;"><?php echo $result_brand['brandName']; ?></span>
                    </div>
            <?php
                }
            }
            ?>

            <div class="products mb-3">
                <div class="product_list py-3">
                    <div class="row">
                        <?php
                        $getall_product_by_brand = $product->getall_product_by_brand($brandid, $catid);
                        if ($getall_product_by_brand) {
                            while ($result = $getall_product_by_brand->fetch_assoc()) {
                        ?>
                                <div class="col-md-3 mb-3 pro_list">
                                    <a href="details.php?proid=<?php echo $result['productID']; ?>"><img src="admin/uploads/<?php echo $result['image']; ?>" class="img-fluid "></a>
                                    <h4><a href="details.php?proid=<?php echo $result['productID']; ?>" class="text-dark"><?php echo $result['productName'] ?></a></h4>
                                    <h3 class="text-danger"><?php echo '$' . $result['price']; ?></h3>
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