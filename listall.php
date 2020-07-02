<?php 
session_start();
if (!$_SESSION['username']) {
    $_SESSION['warning']="You have to log in first!";
    header('Location: login.php');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="home.css" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees List</title>
</head>
<body>
<div><a class="reference" href="<?php echo $_SESSION['url']?>">Back to Board</a></div>
<br><br>
<?php
echo $_SESSION['list'];
?>
</body>
</html>