<?php
// login.php — Frontend-only version for DragonStudiosEntertainment

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST["email"] ?? "");
  $password = trim($_POST["password"] ?? "");

  if ($email === "" || $password === "") {
    $error = "Please fill in all fields.";
  } else {
    // Example placeholder check (replace later with DB)
    if ($email === "admin@dragon.com" && $password === "dragon123") {
      $success = "Welcome back, Dragon Lord!";
    } else {
      $error = "Invalid email or password.";
    }
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login – Dragon Studios Entertainment</title>
  <style>
    body {font-family: system-ui; background:#0a0a0a; color:#eee; display:flex; flex-direction:column; align-items:center; justify-content:center; height:100vh;}
    form {background:#111; padding:2rem; border-radius:1rem; box-shadow:0 0 20px rgba(0,0,0,0.5); width:320px;}
    h1 {color:#e23; text-align:center;}
    label {display:block; margin-top:1rem;}
    input {width:100%; padding:0.5rem; border:none; border-radius:0.3rem; margin-top:0.3rem;}
    button {margin-top:1.5rem; width:100%; padding:0.7rem; background:#e23; color:#fff; border:none; border-radius:0.3rem; font-weight:bold; cursor:pointer;}
    button:hover {background:#f44;}
    .msg {margin-top:1rem; text-align:center;}
  </style>
</head>
<body>
  <form method="post" action="">
    <h1>Login</h1>
    <?php if (!empty($error)): ?>
      <p class="msg" style="color:#f66;"><?= htmlspecialchars($error) ?></p>
    <?php elseif (!empty($success)): ?>
      <p class="msg" style="color:#6f6;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>
    <label>Email:
      <input type="email" name="email" required>
    </label>
    <label>Password:
      <input type="password" name="password" required>
    </label>
    <button type="submit">Sign In</button>
  </form>
</body>
</html>
