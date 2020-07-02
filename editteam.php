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
<div><a class="reference" href="listall.php">Back to Teams List</a></div>
<br><br>





<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="ID"><b>ID</b></label>
  <input type="number" disabled value="<?php echo $_SESSION['id']?>" required>
  <input class="board" name='id' type="number" value="<?php echo $_SESSION['id']?>" required>
  <label for="name"><b>Team name</b></label>
  <input value="<?php echo $_SESSION['name']?>" type="text" placeholder="Enter the team name" name="name" required>
  <label for="name"><b>Type</b></label>
  <input value="<?php echo $_SESSION['type']?>" type="text" placeholder="Enter the team type" name="type" required>
  <input class="board" type="text" name="section" value="updateteam" required>
  <button type="submit">Update team</button>
  </form>
</div>


</body>
</html>