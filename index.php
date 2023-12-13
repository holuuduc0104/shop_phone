    <?php
    include("inc/header.php");
    include("inc/slider.php");
    
    ?>
    
    <div class="main">

      <section class="content my-5">
        <div class="container">
          <div class="products mb-3">
            <div class="product_title border-bottom text-start border-3 ms-4">
              <h3><strong>FEATERED</strong></h3>
            </div>
            <div class="product_list py-3">
              <div class="row">
                <?php
                $product_featered = $product->getproduct_featered();
                if ($product_featered) {
                  while ($result = $product_featered->fetch_assoc()) {
                ?>
                    <div class="col-md-3 mb-3 pro_list">
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

          <div class="products mb-3">
            <div class="product_title border-bottom text-start border-3 ms-4">
              <h3><strong>NEW PRODUCTS</strong></h3>
            </div>
            <div class="product_list py-3">
              <div class="row">
                <?php
                $product_new = $product->getproduct_new();
                if ($product_new) {
                  while ($result_new = $product_new->fetch_assoc()) {
                ?>
                    <div class="col-md-3 mb-3 pro_list">
                      <a href="details.php?proid=<?php echo $result_new['productID']; ?>"><img src="admin/uploads/<?php echo $result_new['image']; ?>" class="img-fluid "></a>

                      <h4><a href="details.php?proid=<?php echo $result_new['productID']; ?>" class="text-dark"><?php echo $result_new['productName']; ?></a></h4>
                      <h3 class="text-danger"><?php echo '$' . $fm->format_currency($result_new['price']); ?></h3>
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