<?php
session_start();
if (!$_SESSION['username']) {
    $_SESSION['warning'] = "You have to log in first!";
    header('Location: login.php');}
echo "<h1>" . $_SESSION['message'] . "</h1>";
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="home.css" type="text/css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Store</title>
</head>
<body>
<div><a class="reference" href="listall.php">Back to Stores List</a></div>
<br><br>





<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="ID"><b>ID</b></label>
  <input disabled value="<?php echo $_SESSION['id']?>" type="number" placeholder="Enter the store ID" name="storeid" required>
  <input value="<?php echo $_SESSION['id']?>" class="board" type="number" name="id" >
  <label for="name"><b>Store name</b></label>
  <input value="<?php echo $_SESSION['name']?>" type="text" placeholder="Enter the store name" name="name" required>
  <label for="name"><b>Type</b></label>
  <input value="<?php echo $_SESSION['type']?>" type="text" placeholder="Enter store type" name="type" required>
  <input class="board" type="text" name="section" value="updatestore" required>
  <label for="managerid"><b>Manager ID</b></label>
  <select placeholder="Enter the employee id" name="managerid" required>
  <option value="<?php echo $_SESSION['managerid']?>" selected><?php echo $_SESSION['managerid']?></option>
  <option value="" selected>If left empty, no manager is added</option>
  <?php echo $_SESSION['selectmanagerids'] ?>
</select>
  <button type="submit">Update store</button>
  </form>
</div>


</body>
</html>