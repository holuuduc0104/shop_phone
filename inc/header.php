<?php
include("lib/session.php");
Session::init();
?>
<?php
include_once("lib/database.php");
include_once("helpers/format.php");
spl_autoload_register(function ($className) {
  include_once("classes/" . $className . ".php");
});
$db = new Database();
$fm = new Format();
$ct = new cart();
$us = new user();
$cat = new category();
$brand = new brand();
$product = new product();
$ctm = new customer();
?>
<?php
if (isset($_GET['customer_id'])) {
  Session::destroy();
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/css.css">
  <title>iShop</title>
</head>

<body>
  <section class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-3 py-3">
          <a href="index.php"><img src="images/logo.png" class="img-fluid" alt="Logo"></a>
        </div>
        <div class="col-md-4 py-4">
        <form action="search.php" method="GET">
          <div class="input-group mb-3">
            <input type="text" name="key" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
            <input type="submit" name="search" value="Search" class="border border-0">
            <!-- <a href="search.php?key=">
            <span class="input-group-text" style="height:40px" id="basic-addon2">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            </a> -->
          </div>
          </form>
        </div>
        <div class="col-md-3 pt-4">
          <div class="row">
            <div class="col">
              <div class="row">
                <div class="col-3">
                  <div class="fs-3 text-danger">
                    <i class="bi bi-telephone"></i>
                  </div>
                </div>
                <div class="col-9">
                  Contact<br>
                  <strong class="text-danger">0816765067</strong>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="row">
                <div class="col-3">
                  <?php
                  $login_check = Session::get('customer_login');
                  if ($login_check) {
                  ?>
                    <div>
                      <ul class="navbar-nav me-auto" style="width:50px; position: relative;">
                        <li class="nav-item dropdown">
                          <a class="fs-3 text-danger" href="profile.php">
                            <i class="bi bi-person-circle"></i>
                          </a>
                          <ul class="dropdown-menu bg-danger" style="width:20px;position: absolute;z-index:5">
                            <li><a class="dropdown-item text-white menu" href="profile.php">Profile</a></li>
                            <?php
                            $customer_id = Session::get('customer_id');
                            $check_order = $ct->check_order($customer_id);
                            if ($check_order) {
                              echo '<li><a class="dropdown-item text-white menu" href="order_history.php">Ordered</a></li>';
                            }
                            ?>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  <?php
                  } else {
                  ?>
                    <div class="fs-3 text-danger">
                      <i class="bi bi-person-circle"></i>
                    </div>
                  <?php
                  }
                  ?>
                </div>
                <div class="col-9">
                  <?php
                  $login_check = Session::get('customer_login');
                  if ($login_check == false) {
                    echo 'Hello!<br>
                    <strong><a href="login.php" class="text-danger">Login</a></strong>';
                  } else {
                  ?>
                    <?php echo Session::get('customer_name') ?><br>
                  <?php
                    echo '<strong><a href="?customer_id=' . Session::get('customer_id') . '" class="text-danger">Logout</a></strong>';
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 py-4">
          <div class="row">
            <div class="col">
              <a href="favorite.php" class="position-relative">
                <span class="fs-2"><i class="bi bi-heart-fill text-danger"></i></span>
              </a>
            </div>
            <div class="col">
              <a href="cart.php" class="position-relative">
                <span class="fs-3 text-danger"><i class="bi bi-cart4"></i></span>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  <?php
                  $check_cart = $ct->check_cart();
                  $login_check = Session::get('customer_login');
                  if ($login_check == false) {
                    echo '0';
                  } else {
                    if ($check_cart) {
                      $sum = Session::get("sum");
                      $qty = Session::get("qty");
                      echo $qty;
                    } else {
                      echo '0';
                    }
                  }
                  ?>
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="menu bg-danger">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <nav class="navbar navbar-expand-lg bg-danger">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0" style="display: flex; justify-content: space-around; width: 100%">
                  <?php
                  $getall_category = $cat->show_category_fe();
                  if ($getall_category) {
                    while ($result_allcat = $getall_category->fetch_assoc()) {
                  ?>
                      <li class="nav-item dropdown menu" style="width:100%;">
                        <a class="nav-link dropdown-toggle text-white" href="productbycat.php?catid=<?php echo $result_allcat['catID']; ?>">
                          <?php echo $result_allcat['catName']; ?>
                        </a>
                        <ul class="dropdown-menu bg-danger">
                          <?php
                          $get_brand_by_cate = $product->get_brand_by_cat($result_allcat['catID']);
                          if ($get_brand_by_cate) {
                            while ($result_brand = $get_brand_by_cate->fetch_assoc()) {
                          ?>
                              <li><a class="dropdown-item text-white menu" href="productbybrand.php?catid=<?php echo $result_allcat['catID']; ?>&brandid=<?php echo $result_brand['brandID']; ?>"><?php echo $result_brand['brandName']; ?></a></li>
                          <?php
                            }
                          }
                          ?>
                        </ul>
                      </li>
                  <?php
                    }
                  }
                  ?>
                  <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#">
                      Sản phẩm
                    </a>
                    <div class="dropdown-content">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </li> -->
                </ul>
              </div>
            </div>
          </nav>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2 text-white py-3">Tin tức</div>
      </div>
    </div>
  </section>