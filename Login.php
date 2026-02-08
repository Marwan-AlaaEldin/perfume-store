<?php
require_once "App/config/Database.php";
session_start();

$db = new Database();
$conn = $db::connect();

$message = ""; // message holder (UI fix, not logic change)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username ='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $message = "Login successful. Welcome " . $_SESSION['username'];
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #111827, #1f2937);
        font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .login-card {
        background: #ffffff;
        width: 380px;
        padding: 35px;
        border-radius: 16px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.25);
    }

    .login-card h1 {
        margin: 0 0 25px;
        text-align: center;
        font-size: 26px;
        color: #111827;
    }

    .message {
        margin-bottom: 18px;
        text-align: center;
        font-size: 14px;
        color: #374151;
    }

    .login-card input {
        width: 100%;
        padding: 14px;
        margin-bottom: 16px;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        font-size: 15px;
    }

    .login-card input:focus {
        outline: none;
        border-color: #111827;
    }

    .login-card button {
        width: 100%;
        padding: 14px;
        border-radius: 10px;
        border: none;
        font-size: 16px;
        background: #111827;
        color: white;
        cursor: pointer;
    }

    .login-card button:hover {
        opacity: 0.9;
    }
</style>
</head>
<body>

<div class="login-card">
    <h1>Login</h1>

    <?php if (!empty($message)): ?>
        <div class="message">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <input name="username" placeholder="Username" required>
        <input name="password" type="password" placeholder="Password" required>
        <button type="submit">Sign In</button>
    </form>
</div>

</body>
</html>
