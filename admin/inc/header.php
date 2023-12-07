<?php
include("../lib/session.php");
Session::checkSession();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  </head>
  <body>
    <body>
        <section class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 py-3">
                        <img src="images/logo.png" class="img-fluid" alt="Logo">
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
                                        
                                        <?php echo Session::get('adminName') ?><br>
                                        <?php
                                            if(isset($_GET['action']) && $_GET['action'] == 'logout'){
                                                Session::destroy();
                                            }
                                        ?>
                                        <a href="?action=logout"><strong class="text-danger">Đăng xuất</strong></a>
                                        <!-- Xin chào!<br>
                                        <strong class="text-danger">Đăng nhập</strong> -->
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
                                <a href="#" class="position-relative">
                                    <span class="fs-3"><i class="bi bi-cart4"></i></span>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      0
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>