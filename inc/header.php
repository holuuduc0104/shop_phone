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
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/css.css">
  <title>Hello, world!</title>
</head>

<body>

  <section class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-3 py-3">
          <a href="index.php"><img src="images/logo.png" class="img-fluid" alt="Logo"></a>
        </div>
        <div class="col-md-4 py-4">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm..." aria-label="Tìm kiếm sản phẩm..." aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
          </div>
        </div>
        <div class="col-md-3 py-4">
          <div class="row">
            <div class="col">
              <div class="row">
                <div class="col-3">
                  <div class="fs-3 text-danger">
                    <i class="bi bi-telephone"></i>
                  </div>
                </div>
                <div class="col-9">
                  Tư vấn hỗ trợ<br>
                  <strong class="text-danger">0123456789</strong>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="row">
                <div class="col-3">
                  <div class="fs-3 text-danger">
                    <i class="bi bi-person-circle"></i>
                  </div>
                </div>
                <div class="col-9">
                  <?php //echo Session::get('adminName') 
                  ?>
                  <!-- <br> -->
                  <?php
                  // if(isset($_GET['action']) && $_GET['action'] == 'logout'){
                  //     Session::destroy();
                  // }
                  ?>
                  <!-- <a href="?action=logout"><strong class="text-danger">Đăng xuất</strong></a> -->
                  <?php
                  if(isset($_GET['customer_id'])){
                    Session::destroy();
                  }
                  ?>
                  <?php
                  $login_check = Session::get('customer_login');

                  if ($login_check == false) {
                    echo 'Xin chào!<br>
                    <strong><a href="login.php" class="text-danger">Login</a></strong>';
                  } else {
                    echo 'Xin chào!<br>
                    <strong><a href="?customer_id=' . Session::get('customer_id') . '" class="text-danger">Logout</a></strong>';
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
              <a href="#" class="position-relative">
                <span class="fs-3"><i class="bi bi-heart"></i></span>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  0
                </span>
              </a>
            </div>
            <div class="col">
              <a href="cart.php" class="position-relative">
                <span class="fs-3"><i class="bi bi-cart4"></i></span>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  <?php
                  $check_cart = $ct->check_cart();
                  if ($check_cart) {
                    $sum = Session::get("sum");
                    $qty = Session::get("qty");
                    echo $qty;
                  } else {
                    echo '0';
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
        <!-- <div class="col-md-3 text-white py-3"></div> -->
        <div class="col-md-9">
          <nav class="navbar navbar-expand-lg bg-danger">
            <div class="container-fluid">

              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="display: flex; justify-content: space-around; width: 100%;">
                  <?php
                  $getall_category = $cat->show_category_fe();
                  if ($getall_category) {
                    while ($result_allcat = $getall_category->fetch_assoc()) {
                  ?>
                      <li class="nav-item">
                        <a class="nav-link text-white" href="productbycat.php?catid=<?php echo $result_allcat['catID']; ?>"><?php echo $result_allcat['catName']; ?></a>
                      </li>
                  <?php
                    }
                  }
                  ?>
                  <?php
                  $login_check = Session::get('customer_login');
                  if ($login_check == false) {
                    echo '';
                  } else {
                    echo '<li class="nav-item">
                    <a class="nav-link text-white" href="profile.php">Profile</a>
                  </li>';
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

        <div class="col-md-2 text-white py-3">Danh mục sản phẩm</div>
      </div>
    </div>
  </section>