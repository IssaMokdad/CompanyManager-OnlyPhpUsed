<?php
session_start();
if (!$_SESSION['username']) {
    $_SESSION['warning'] = "You have to log in first!";
    unset($_SESSION['warning']);
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
    <title>Stores Board</title>
</head>
<body>
<div><a class="reference" href="home.php">Back to home</a></div>
<br><br>
<div class="employeeservice">
<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="name"><b>Store name</b></label>
  <input type="text" placeholder="Enter the store name" name="name" required>
  <label for="name"><b>Type</b></label>
  <input type="text" placeholder="Enter store type" name="type" required>
  <input class="board" type="text" name="section" value="addstore" required>
  <label for="managerid"><b>Manager ID</b></label>
  <select placeholder="Enter the employee id" name="id" required>
  <option value="" selected>If left empty, no manager is added</option>
  <?php echo $_SESSION['selectmanagerids'] ?>
</select>
  <button type="submit">Add store</button>
  </form>
</div>



<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="ID"><b>ID</b></label>
  <input class="board" type="text" name="section" value="deletestore" required>
  <select placeholder="Enter the employee id" name="id" required>
  <option value="" selected>Choose a store to delete</option>
  <?php echo $_SESSION['selectstoreids'] ?>
</select>
  <button type="submit">Delete store</button>
  </form>
  <form action="index.php" method="post" class="form-width">
  <label for="ID"><b>ID</b></label>
  <input class="board" type="text" name="section" value="searchstore" required>
  <select placeholder="Enter the employee id" name="id" required>
  <option value="" selected>Choose a store to view</option>
  <?php echo $_SESSION['selectstoreids'] ?>
</select>
  <button type="submit">Search store</button>

  </form>
  <br>
  <form action="index.php" method="post" class="form-width">

<input class="board" type="text" name="section" value="liststore" required>
<button type="submit">List all stores</button>
</form>

</div>



</div>

</body>
</html>
