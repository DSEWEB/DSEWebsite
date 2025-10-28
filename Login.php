<?php
// api/login.php — Secure login endpoint for DragonStudiosEntertainment

// Load environment variables (Vercel sets these in the dashboard)
$dsn  = getenv("DB_DSN");
$user = getenv("DB_USER");
$pass = getenv("DB_PASS");

header("Content-Type: application/json");

// Read POST body
$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data["email"], $data["password"])) {
  http_response_code(400);
  echo json_encode(["error" => "Missing email or password"]);
  exit;
}

$email = strtolower(trim($data["email"]));
$password = $data["password"];

try {
  $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);

  $stmt = $pdo->prepare("SELECT id, username, pass_hash FROM users WHERE email = ?");
  $stmt->execute([$email]);
  $userRow = $stmt->fetch();

  if (!$userRow || !password_verify($password, $userRow["pass_hash"])) {
    http_response_code(401);
    echo json_encode(["error" => "Invalid credentials"]);
    exit;
  }

  // In a serverless environment, don’t use PHP sessions — issue a JWT or token
  // For now, return a simple response
  echo json_encode([
    "success"  => true,
    "user_id"  => $userRow["id"],
    "username" => $userRow["username"],
    "message"  => "Login successful"
  ]);

} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode(["error" => "Server error: " . $e->getMessage()]);
}
