<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard | TechNova</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container" style="width: 400px;">
    <h2>Welcome, <?php echo $_SESSION['username']; ?> 👋</h2>
    <p>You are now logged in to TechNova’s system.</p>
    <form action="logout.php" method="POST">
      <button type="submit" style="background:#e63946;">Logout</button>
    </form>
  </div>
</body>
</html>
