<?php
include 'db.php';
$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $check = $conn->prepare("SELECT * FROM users WHERE email=?");
  $check->bind_param("s", $email);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    $msg = "⚠️ Email already exists!";
  } else {
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
      $msg = "✅ Account created successfully!";
    } else {
      $msg = "❌ Error creating account!";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup | TechNova</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Sign Up</h2>
    <form method="POST" action="">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Create Account</button>
      <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
    <p style="color:#90e0ef; margin-top:10px;"><?php echo $msg; ?></p>
  </div>
</body>
</html>
