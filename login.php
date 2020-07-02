<?php
session_start();
if ($_SESSION['username']){
  header('Location: home.php');
}
if ($_SESSION['warning']) {
  echo "<h1>" . $_SESSION['warning'] . "</h1>";
  unset($_SESSION['warning']);
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="login.css" type="text/css">
</head>

<body>
<form action="index.php" method="post">

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
    <input id="section" type="text" name="section" value="login" required>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">Login</button>

  </div>

</form> 
</body>
</html>