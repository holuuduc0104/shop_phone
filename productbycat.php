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

?>

<div class="main">

    <section class="content mb-5 mt-3">
        <div class="container">
            <div class="d-flex flex-wrap mb-5 ms-5">
                <?php
                $get_brand_by_cate = $product->get_brandlogo_by_cat($catid);
                if ($get_brand_by_cate) {
                    while ($result_brand = $get_brand_by_cate->fetch_assoc()) {
                ?>
                        <a href="productbybrand.php?catid=<?php echo $catid; ?>&brandid=<?php echo $result_brand['brandID']; ?>" class="brandlogo">
                            <img src="admin/uploads/<?php echo $result_brand['brandLogo']; ?>" class="img-fluid" style="height:25px;">
                        </a>
                <?php
                    }
                }
                ?>
            </div>
            <div class="products mb-3">
                <div class="product_list py-3">
                    <div class="row">
                        <?php
                        $get_product_by_cate = $product->getall_product_by_cat($catid);
                        if ($get_product_by_cate) {
                            while ($result = $get_product_by_cate->fetch_assoc()) {
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