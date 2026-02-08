<?php
require "App/config/Database.php";

$db = new Database();
$conn = $db->connect();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql)) {
        $message = "User registered successfully.";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>

<style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0f172a, #1e293b);
        font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .signup-card {
        background: #ffffff;
        width: 420px;
        padding: 40px;
        border-radius: 18px;
        box-shadow: 0 35px 70px rgba(0,0,0,0.3);
    }

    .signup-card h1 {
        margin: 0 0 25px;
        text-align: center;
        font-size: 28px;
        color: #0f172a;
    }

    .message {
        margin-bottom: 18px;
        text-align: center;
        font-size: 14px;
        color: #334155;
    }

    .signup-card input {
        width: 100%;
        padding: 15px;
        margin-bottom: 16px;
        border-radius: 12px;
        border: 1px solid #cbd5f5;
        font-size: 15px;
    }

    .signup-card input:focus {
        outline: none;
        border-color: #0f172a;
    }

    .signup-card button {
        width: 100%;
        padding: 15px;
        border-radius: 12px;
        border: none;
        font-size: 16px;
        background: #0f172a;
        color: white;
        cursor: pointer;
        margin-top: 5px;
    }

    .signup-card button:hover {
        opacity: 0.9;
    }
</style>
</head>
<body>

<div class="signup-card">
    <h1>Create Account</h1>

    <?php if (!empty($message)): ?>
        <div class="message">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <input name="username" placeholder="Username" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </form>
</div>

</body>
</html>
