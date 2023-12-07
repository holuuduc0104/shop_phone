<?php
include("classes/customer.php");
include_once("lib/session.php");
Session::init();
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check) {
  header('Location:order.php');
}
?>
<?php
$ctm = new customer();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $loginCustomer = $ctm->login_customer($_POST);
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style_login.css">

  <title>Login Form</title>
</head>

<body>
  <div class="container-fluid">
    <form class="mx-auto form-login" action="" method="post" id="form-1">
      <h4 class="text-center">Admin Login</h4>
      <span>
        <?php
        if (isset($loginCustomer)) {
          echo $loginCustomer;
        }
        ?>
      </span>
      <div class="form-group mb-3 mt-5">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email">
        <span class="form-message"></span>
      </div>

      <div class="form-group mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password">
        <span class="form-message"></span>
        <!-- <div id="emailHelp" class="form-text mt-3">Forget password ?</div> -->
      </div>

      <input type="submit" name="submit" class="btn btn-primary mt-5" value="Login">
    </form>
  </div>

  <script src="js/validator.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Validator({
        form: '#form-1',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
          Validator.isRequired('#email', 'Enter Your Email.'),
          Validator.isEmail('#email'),
          Validator.isRequired('#password', 'Enter Your Password.'),
          Validator.minLength('#password', 6),
        ],
        onSubmit: function(data) {
          console.log(data);
        }
      });


    });
  </script>
</body>

</html>