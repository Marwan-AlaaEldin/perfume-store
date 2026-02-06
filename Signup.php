<?php
require "App\config\Database.php";

$db = new Database();
$conn = $db->connect();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql)) {
        echo "User registered successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="post">
    <input name="username" placeholder="Username" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Password" required>
    <button>Sign Up</button>
</form>
