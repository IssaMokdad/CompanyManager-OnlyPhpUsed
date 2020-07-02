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
    <title>Rooms Board</title>
</head>
<body>
<div><a class="reference" href="home.php">Back to home</a></div>
<br><br>
<div class="employeeservice">
<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="roomnumber"><b>Room Number</b></label>
  <input type="number" placeholder="Enter the room number" name="roomnumber" required>
  <input class="board" type="text" name="section" value="addroom" required>
  <button type="submit">Add room</button>
  </form>
  <form action="index.php" method="post" class="form-width">
  <label for="roomnumber"><b>Room Number</b></label>
  <select placeholder="Enter the room number" name="roomnumber" required>
  <?php echo $_SESSION['roomnumbers']?></select>
  <label for="storeid"><b>Team Id</b></label>
  <select placeholder="Enter the team id" name="teamid" required>
  <?php echo $_SESSION['selectteamids'] ?>
</select>
  <input class="board" type="text" name="section" value="addroomteam" required>
  <button type="submit">Add room to team</button>
  </form>
</div>

<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="ID"><b>Room Number</b></label>
  <select placeholder="Enter the room number" name="roomnumber" required>
  <?php echo $_SESSION['roomnumbers']?></select>
  <label for="storeid"><b>Store ID</b></label>
  <select placeholder="Enter the employee id" name="storeid" required>
  <option value="" selected>Add room to store</option>
  <?php echo $_SESSION['selectstoreids'] ?>
</select>
  <input class="board" type="text" name="section" value="updateroom" required>
  <button type="submit">Update store rooms</button>
  </form>
  <form action="index.php" method="post" class="form-width">
  <label for="ID"><b>Room Number:</b></label>
  <select placeholder="Enter the room number" name="roomnumber" required>
  <?php echo $_SESSION['roomnumbers']?></select>
  <br><br><br>
  <label for="teamid"><b>Team ID:</b></label>
  <select placeholder="Enter the team id" name="teamid" required>
  <?php echo $_SESSION['selectteamids'] ?>
</select>
  <input class="board" type="text" name="section" value="deleteteamroom" required>
  <br><br><br>
  <button type="submit">Delete team rooms</button>
  </form>
</div>

<div class="container">
<form action="index.php" method="post" class="form-width">
  <label for="ID"><b>ID</b></label>
  <input class="board" type="text" name="section" value="deleteroom" required>
  <select placeholder="Enter the room number" name="roomnumber" required>
  <?php echo $_SESSION['roomnumbers']?></select>
  <button type="submit">Delete room</button>
  </form>
  <br><br>
  <form action="index.php" method="post" class="form-width">

<input class="board" type="text" name="section" value="listroom" required>
<button type="submit">List all rooms</button>
</form>
</div>



</div>

</body>
</html>
