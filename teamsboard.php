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
    <title>Teams Board</title>
</head>
<body>
<div><a class="reference" href="home.php">Back to home</a></div>
<br><br>
<div class="employeeservice">
<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="name"><b>Team name</b></label>
  <input type="text" placeholder="Enter the team name" name="name" required>
  <label for="name"><b>Type</b></label>
  <input type="text" placeholder="Enter team type" name="type" required>
  <input class="board" type="text" name="section" value="addteam" required>
  <button type="submit">Add team</button>
  </form>
  </form>
  <form action="index.php" method="post" class="form-width">
  <label for="ID"><b>ID</b></label>
  <select placeholder="Enter the team id" name="id" required>
  <?php echo $_SESSION['selectteamids'] ?>
</select>
  <input class="board" type="text" name="section" value="searchadmin" required>
  <button type="submit">Search admin</button>

  </form>
</div>

<div class="container">
  </form>
  <form action="index.php" method="post" class="form-width">
  <label for="teamid"><b>Team ID</b></label>
  <select placeholder="Enter the team id" name="id" required>
  <?php echo $_SESSION['selectteamids'] ?>
</select>
  <input class="board" type="text" name="section" value="getemployeesteam" required>
  <button type="submit">Get all team employees</button>
  </form>
</div>

<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="ID"><b>ID</b></label>
  <input class="board" type="text" name="section" value="deleteteam" required>
  <select placeholder="Enter the team id" name="id" required>
  <?php echo $_SESSION['selectteamids'] ?>
</select>
  <button type="submit">Delete team</button>
  </form>
  <form action="index.php" method="post" class="form-width">
  <label for="ID"><b>ID</b></label>
  <input class="board" type="text" name="section" value="searchteam" required>
  <select placeholder="Enter the team id" name="id" required>
  <?php echo $_SESSION['selectteamids'] ?>
</select>
  <button type="submit">Search team</button>

  </form>
  <br>
  <form action="index.php" method="post" class="form-width">

<input class="board" type="text" name="section" value="listteam" required>
<button type="submit">List all teams</button>
</form>

</div>

<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="ID"><b>Team ID</b></label>
  <select placeholder="Enter the team id" name="id" required>
  <?php echo $_SESSION['selectteamids'] ?>
</select>
  <input class="board" type="text" name="section" value="insertemployee" required>
  <label for="ID"><b>Employee ID</b></label>
  <select placeholder="Enter the employee id" name="employeeid" required>
  <option value="" selected>Choose an employee to insert</option>
  <?php echo $_SESSION['selectemployeeids'] ?>
</select>
  <button type="submit">Insert employee</button>
  </form>
  <form action="index.php" method="post" class="form-width">
  <label for="ID"><b>Team ID</b></label>
  <select placeholder="Enter the team id" name="id" required>
  <?php echo $_SESSION['selectteamids'] ?>
</select>
  <input class="board" type="text" name="section" value="insertadmin" required>
  <label for="ID"><b>Admin ID</b></label>
  <select placeholder="Enter the team id" name="adminid" required>
  <option value="" selected>Choose an admin to insert</option>
  <?php echo $_SESSION['selectemployeeteamsids'] ?>
</select>
  <button type="submit">Insert admin</button>
  </form>
</div>

</div>

</body>
</html>
