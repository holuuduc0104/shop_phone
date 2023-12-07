
<?php
include("inc/header.php");
?>
<?php
$login_check = Session::get('customer_login');
if (!$login_check) {
  header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Order</h2>
</body>
</html>