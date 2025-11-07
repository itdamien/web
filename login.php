<?php
include 'db.php';
session_start();
$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['username'] = $user['username'];
      header("Location: dashboard.php");
      exit;
    } else {
      $msg = "❌ Invalid password!";
    }
  } else {
    $msg = "⚠️ User not found!";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | TechNova</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form method="POST" action="">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
      <p>Don’t have an account? <a href="signup.php">Sign Up</a></p>
    </form>
    <p style="color:#90e0ef; margin-top:10px;"><?php echo $msg; ?></p>
  </div>
</body>
</html>
