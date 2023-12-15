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

    <section class="content my-5">
        <div class="container">
            <?php
            $get_cate_name = $cat->getcatebyid_fe($catid);
            if ($get_cate_name) {
                while ($result_cat = $get_cate_name->fetch_assoc()) {
            ?>
                    <div class="text-center">
                        <span class="badge bg-danger fs-2 mb-5" style="width: 300px; height: 50px;"><?php echo $result_cat['catName']; ?></span>
                    </div>
            <?php
                }
            }
            ?>

            <?php
            $get_brand_by_cate = $product->get_brand_by_cat($catid);
            if ($get_brand_by_cate) {
                while ($result_brand = $get_brand_by_cate->fetch_assoc()) {
            ?>
                    <div class="products mb-3">
                        <div class="product_title border-bottom text-start border-3 ms-4">
                            <h3><a href="productbybrand.php?catid=<?php echo $catid; ?>&brandid=<?php echo $result_brand['brandID']; ?>" class="link_to_brand"><strong><?php echo $result_brand['brandName']; ?></strong></a></h3>
                        </div>
                        <div class="product_list py-3">
                            <div class="row">
                                <?php
                                $get_product_by_brand = $product->get_product_by_brand($result_brand['brandID'], $catid);
                                if ($get_product_by_brand) {
                                    while ($result = $get_product_by_brand->fetch_assoc()) {
                                ?>
                                        <div class="col-md-3 mb-3 pro_list product">
                                            <a href="details.php?proid=<?php echo $result['productID']; ?>"><img src="admin/uploads/<?php echo $result['image']; ?>" class="img-fluid "></a>
                                            <h4><a href="details.php?proid=<?php echo $result['productID']; ?>" class="text-dark"><?php echo $result['productName'] ?></a></h4>
                                            <h3 class="text-danger"><?php echo '$' . $fm->format_currency($result['price']); ?></h3>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

    </section>
</div>
<?php
include("inc/footer.php");
?>