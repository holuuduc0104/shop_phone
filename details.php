<?php
include("inc/header.php");
?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
    echo "<script>window.location='404.php'</script>";
} else {
    $id = $_GET['proid'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $addtocart = $ct->add_to_cart($quantity, $id);
    if ($addtocart == 'true') {
        echo '<script>alert("Added Product To Cart Successfully!");
            </script>';
    } else if ($addtocart == 'added') {
        echo '<script>alert("Product Already Added!");
            </script>';
    }
}
?>
<div class="container detail mt-5">
    <?php
    $get_product_details = $product->get_details($id);
    if ($get_product_details) {
        while ($result_details = $get_product_details->fetch_assoc()) {


    ?>
            <div class="row">
                <div class="col-md-6">
                    <img src="admin/uploads/<?php echo $result_details['image']; ?>">
                </div>
                <div class="col-md-6">
                    <h2 id="namedetail"><?php echo $result_details['productName']; ?></h2>
                    <p class="price"><?php echo 'USD $' . $fm->format_currency($result_details['price']); ?></p>
                    <p><b>Condition:</b> New</p>
                    <p><b>Category:</b> <?php echo $result_details['catName']; ?></p>
                    <p><b>Brand:</b> <?php echo $result_details['brandName']; ?></p>
                    <label for="">Quantity: &nbsp; &nbsp; &nbsp;</label>
                    <div class="add-cart">
                        <form action="" method="post">
                            <input type="number" value="1" id="quantity" name="quantity" min="1"><br>
                            <input type="submit" name="submit" class="btn btn-default cart mt-5" value="Add to cart">
                        </form>
                    </div>

                    <!-- <input type="number" value="1" id="quantity"><br>
            <button type="button" class="btn btn-default cart mt-5">Add to cart</button>
            <button type="button" class="btn btn-default buynow mt-5">Buy Now</button> -->
                </div>
            </div>
            <div class="container mt-5">
                <div class="product_title border-bottom border-3 text-start">
                    <h3><strong>Detail</strong></h3>
                </div>
                <div class="row">
                    <!-- <div class="col-md-3 img-detail" style="margin-left: -150px">
                    <img src="images/detail-left.webp" alt="left" class="">
                </div> -->
                    <div class="col-md-6 my-5">
                        <p><?php echo $result_details['product_desc']; ?></p>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5 my-5">
                        <p><?php echo $result_details['product_info']; ?></p>
                    </div>
                </div>

            </div>

    <?php
        }
    }
    ?>
    <!-- <div class="similar_products mb-3">
        <div class="product_title border-bottom border-3 text-start">
            <h3><strong>Similar Products</strong></h3>
        </div>
        <div class="product_list py-3">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <img src="images/product.webp" class="img-fluid ">
                    <h4>Product Name</h4>
                    <h3>1000$</h3>
                </div>
                <div class="col-md-3 mb-3">
                    <img src="images/product.webp" class="img-fluid">
                    <h4>Product Name</h4>
                    <h3>1000$</h3>
                </div>
                <div class="col-md-3 mb-3">
                    <img src="images/product.webp" class="img-fluid">
                    <h4>Product Name</h4>
                    <h3>1000$</h3>
                </div>
                <div class="col-md-3 mb-3">
                    <img src="images/product.webp" class="img-fluid">
                    <h4>Product Name</h4>
                    <h3>1000$</h3>
                </div>
                <div class="col-md-3 mb-3">
                    <img src="images/product.webp" class="img-fluid">
                    <h4>Product Name</h4>
                    <h3>1000$</h3>
                </div>
                <div class="col-md-3 mb-3">
                    <img src="images/product.webp" class="img-fluid">
                    <h4>Product Name</h4>
                    <h3>1000$</h3>
                </div>
                <div class="col-md-3 mb-3">
                    <img src="images/product.webp" class="img-fluid">
                    <h4>Product Name</h4>
                    <h3>1000$</h3>
                </div>
                <div class="col-md-3 mb-3">
                    <img src="images/product.webp" class="img-fluid ">
                    <h4>Product Name</h4>
                    <h3>1000$</h3>
                </div>

            </div>
        </div>
    </div> -->
</div>
<?php
include("inc/footer.php");
?>