<?php
session_start();
if (!$_SESSION['username']) {
  $_SESSION['warning']="You have to log in first!";
  header('Location: login.php');}
 else {
    echo "<h1>Hello " . $_SESSION['username'] . "!</h1>";}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="home.css" type="text/css">
</head>

<body>

    <form id="logout" action="index.php" method="post">
        <input id="section" type="text" name="section" value="logout" required>
        <button type="submit">Logout</button>
    </form>
<div class="boardlist">
<div class="card">
<form action="index.php" method="post">
<input class="board" type="text" name="section" value="employeesboard" required>
<button id="no-background" type="submit"><img width="300" height="300" src="images/img_avatar.png" alt="Employees Board"></button>
</form>
  <div class="container">
    <h4><b>Employees Board</b></h4> 
  </div>
</div>
<div class="card">
<form action="index.php" method="post">
<input class="board" type="text" name="section" value="storesboard" required>
<button id="no-background" type="submit"><img width="300" height="300" src="images/stores.jpg" alt="Stores Board"></button>
</form>
<div class="container">
    <h4><b>Stores Board</b></h4> 
  </div>
</div>
<div class="card">
<form action="index.php" method="post">
<input class="board" type="text" name="section" value="roomsboard" required>
<button id="no-background" type="submit"><img width="300" height="300" src="images/rooms.png" alt="Rooms Board"></button>
</form>
  <div class="container">
    <h4><b>Rooms Board</b></h4> 
    </div>
  
</div>
<div class="card">
<form action="index.php" method="post">
<input class="board" type="text" name="section" value="teamsboard" required>
<button id="no-background" type="submit"><img width="300" height="300" src="images/teams.jpg" alt="Teams Board"></button>
</form>
  <div class="container">
    <h4><b>Teams Board</b></h4> 
  </div>
</div>
</div>
</body>
</html>
