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
    <title>Employees Board</title>
</head>
<body>
<div><a class="reference" href="home.php">Back to home</a></div>
<br><br>
<div class="employeeservice">
<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="name"><b>First name</b></label>
  <input type="text" placeholder="Enter the first name" name="name" required>
  <input class="board" type="text" name="section" value="addemployee" required>
  <label for="last name"><b>Last name</b></label>
  <input type="text" placeholder="Enter the last name" name="lastname" required>
  <label for="managerid"><b>Manager ID</b></label>
  <select placeholder="Enter the manager id" name="managerid" required>
  <option value='' selected>if left empty, no manager will be added</option>";
  <?php echo $_SESSION['selectemployeeids'] ?>
</select>
<br><br>
  <label for="email"><b>Email</b></label>
  <input type="email" placeholder="Enter the email" name="email" required>
  <button type="submit">Add employee</button>
  </form>
</div>


<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="ID"><b>ID</b></label>
  <input class="board" type="text" name="section" value="deleteemployee" required>
  <select placeholder="Enter the employee id" name="id" required>
  <option value="" selected>Choose an employee to delete</option>
  <?php echo $_SESSION['selectemployeeids'] ?>
</select>
  <button type="submit">Delete employee</button>
  </form>
  <form action="index.php" method="post" class="form-width">
  <label for="ID"><b>ID</b></label>
  <input class="board" type="text" name="section" value="searchemployee" required>
  <select placeholder="Enter the employee id" name="id" required>
  <option value="" selected>Choose an employee to view</option>
  <?php echo $_SESSION['selectemployeeids'] ?>
</select>
  <button type="submit">Search employee</button>

  </form>
  <br>
  <form action="index.php" method="post" class="form-width">

<input class="board" type="text" name="section" value="listemployee" required>
<button type="submit">List all employees</button>
</form>

</div>



</div>

</body>
</html>
