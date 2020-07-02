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
    <title>Edit Employee</title>
</head>
<body>
<div><a class="reference" href="listall.php">Back to Employees List</a></div>
<br><br>



<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="ID"><b>ID</b></label>
  <input value="<?php echo $_SESSION['id']?>" type="number" placeholder="Enter the employee ID" name="employeeid" disabled required>
  <input value="<?php echo $_SESSION['id']?>" class="board" type="number" name="id" >
  <label for="name"><b>First name</b></label>
  <input value="<?php echo $_SESSION['name']?>" type="text" placeholder="Enter the first name" name="name" required>
  <input class="board" type="text" name="section" value="updateemployee" required>
  <label for="lastname"><b>Last name</b></label>
  <input value="<?php echo $_SESSION['lastname']?>" type="text" placeholder="Enter the last name" name="lastname" required>
  <label for="managerid"><b>Manager ID</b></label>
  <select placeholder="Enter the manager id" name="managerid" required>
  <option value=''>Delete manager</option>";
  <option selected value='<?php echo $_SESSION['managerid']?>'><?php echo $_SESSION['managerid']?></option>";
  <?php echo $_SESSION['selectemployeeids'] ?>
</select>
<br><br>
  <label for="email"><b>Email</b></label>
  <input value="<?php echo $_SESSION['email']?>" type="email" placeholder="If left empty, email won't change" name="email">
  <button type="submit">Update employee</button>
  </form>
</div>




</body>
</html>
