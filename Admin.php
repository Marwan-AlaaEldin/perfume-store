
<?php
require_once "App/config/Database.php";
session_start();

$db = new Database();
$conn = $db::connect();

$message = ""; // message holder (UI fix, not logic change)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username ='$username'";
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
        $message = "Admin not found.";
    }
}
?>
<div class="login-card">
    <h1>Admin Login</h1>

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
