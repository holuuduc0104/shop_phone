<?php
include("../classes/admin_login.php");
?>
<?php
$class = new adminLogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $adminUser = $_POST['adminUser'];
  $adminPass = md5($_POST['adminPass']);

  $login_check = $class->login_admin($adminUser, $adminPass);
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
    <form class="mx-auto" action="login.php" method="post" id="form-1">
      <h4 class="text-center">Admin Login</h4>
      <span>
        <?php
        if (isset($login_check)) {
          echo $login_check;
        }
        ?>
      </span>
      <div class="form-group mb-3 mt-5">
        <label for="adminUser" class="form-label">User Name</label>
        <input type="text" class="form-control" name="adminUser" id="adminUser">
        <span class="form-message"></span>
      </div>

      <div class="form-group mb-3">
        <label for="adminPass" class="form-label">Password</label>
        <input type="password" class="form-control" name="adminPass" id="adminPass">
        <span class="form-message"></span>
        <!-- <div id="emailHelp" class="form-text mt-3">Forget password ?</div> -->
      </div>

      <button type="submit" class="btn btn-primary mt-5">Login</button>
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
          Validator.isRequired('#adminUser', 'Enter Your Username.'),
          Validator.isRequired('#adminPass', 'Enter Your Password.'),
        ],
        onSubmit: function(data) {
          console.log(data);
        }
      });


    });
  </script>
</body>

</html>