<?php
require 'functions.php';
if(isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row["password"])) {
      header("Location: index.php");
      exit();
    }
  }
  $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Sign In</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    nav {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    nav .back {
      text-decoration: none;
      font-size: 1.7rem;
    }
    form {
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      border: 1px solid rgba(150, 150, 150, 1);
      border-radius: 3px;
      gap: 20px;
    }
    form input {
      padding-left: 10px;
      width: 240px;
      height: 40px;
    }
    form button {
      width: 250px;
      height: 40px;
    }
    form p {
      font-size: .7rem;
      color: rgba(150, 150, 150, 1);
    }
    form nav a {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <form action="" method="post">
    <nav>
      <h1>Sign In</h1>
      <a class="back" href="home.php">&times;</a>
    </nav>
    <input type="text" name="username" id="username" placeholder="Username">
    <input type="password" name="password" id="password" placeholder="Password">
    <button type="submit" name="submit">Sign In</button>
    <p>Belum memiliki akun? <a href="signUp.php">Sign Up</a></p>
  </form>
</body>
</html>