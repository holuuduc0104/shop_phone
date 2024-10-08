    <?php
    include("inc/header.php");
    include("inc/slider.php");

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


          <?php
          $get_cat_name = $cat->show_category_fe();
          if ($get_cat_name) {
            while ($result_cat = $get_cat_name->fetch_assoc()) {
          ?>
              <div class="mb-3">
                <div class="border-bottom text-start border-3 ms-4">
                  <a href="productbycat.php?catid=<?php echo $result_cat['catID']; ?>" class="text-dark">
                    <h3><strong><?php echo strtoupper($result_cat['catName']) ?></strong></h3>
                  </a>
                </div>
                <div class="product_list py-3">
                  <div class="row">
                    <?php
                    $get_product_by_cat = $product->get_product_by_cat($result_cat['catID']);
                    if ($get_product_by_cat) {
                      while ($result = $get_product_by_cat->fetch_assoc()) {
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
          <?php
            }
          }
          ?>

          <!-- <div class="products mb-3">
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
            </div>-->
        </div>
      </section>
    </div>
    <?php
    include("inc/footer.php");
    ?>