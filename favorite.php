<?php
include("inc/header.php");
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
  echo '<script>window.location="login.php";</script>';
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $id = $_POST['proid'];
  $favid = $_POST['favid'];
  $quantity = $_POST['quantity'];
  $addtocart = $ct->add_to_cart($quantity, $id);
  if ($addtocart == 'true') {
    $delfav = $ct->del_favorite_byid($favid);
    echo '<script>alert("Added Product To Cart Successfully!");
            </script>';
  } else if ($addtocart == 'added') {
    echo '<script>alert("Product Already Added!");
          </script>';
  }
}
if (isset($_GET['favid'])) {
  $favid = $_GET['favid'];
  $delfav = $ct->del_favorite_byid($favid);
}
if (!isset($_GET['id'])) {
  echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>
<?php
$check_cart = $ct->check_empty_favorite();
if (!$check_cart) {
  echo '<script>alert("Your Favorite List is Empty!");
        window.location="index.php";
        </script>';
}
?>
<div class="container mt-5">
  <div class="products mb-3">
    <div class="border-bottom text-start border-3 ms-4">
      <h3><strong>FAVORITE LIST</strong></h3>
    </div>
    <div class="product_list py-3">
      <div class="row">
        <?php
        $product_favorite = $ct->get_product_favorite();
        if ($product_favorite) {
          while ($result = $product_favorite->fetch_assoc()) {
        ?>
            <div class="col-md-3 pro_list ">
              <div class="product pt-3 px-3">
                <a href="details.php?proid=<?php echo $result['productID']; ?>"><img src="admin/uploads/<?php echo $result['image']; ?>" class="img-fluid "></a>
                <h4><a href="details.php?proid=<?php echo $result['productID']; ?>" class="text-dark"><?php echo $result['productName'] ?></a></h4>
                <h3 class="text-danger"><?php echo '$' . $fm->format_currency($result['price']); ?></h3>
                <div class="row">
                  <div class="col-md-6 text-center">
                    <form action="" method="post">
                      <input type="hidden" value="1" id="quantity" name="quantity">
                      <input type="hidden" value="<?php echo $result['favoriteID']; ?>" id="favid" name="favid">
                      <input type="hidden" value="<?php echo $result['productID']; ?>" id="proid" name="proid">
                      <input type="submit" name="submit" class="btn btn-default cart2" value="Add to cart">
                    </form>
                  </div>
                  <div class="col-md-6 text-center mt-1">
                    <a href="?favid=<?php echo $result['favoriteID']; ?>" class="text-danger" style="font-weight:bold;">Delete</a>

                  </div>
                </div>
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

<?php
include("inc/footer.php");
?>