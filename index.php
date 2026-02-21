<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Home</title>

<style>
    body {
        margin: 0;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        background: #f5f7fb;
        color: #111827;
    }

    /* NAVBAR */
    .navbar {
        height: 70px;
        background: #111827;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 40px;
    }

    .navbar .logo {
        color: white;
        font-size: 20px;
        font-weight: 600;
    }

    .nav-links a {
        color: white;
        text-decoration: none;
        margin-left: 25px;
        font-size: 15px;
    }

    .nav-links a:hover {
        opacity: 0.85;
    }

    /* HERO */
    .hero {
        text-align: center;
        padding: 120px 20px;
    }

    .hero h1 {
        font-size: 42px;
        margin-bottom: 15px;
    }

    .hero p {
        font-size: 18px;
        color: #6b7280;
        margin-bottom: 40px;
    }

    .hero-buttons a {
        display: inline-block;
        padding: 14px 26px;
        margin: 0 10px;
        border-radius: 12px;
        font-size: 16px;
        text-decoration: none;
        color: white;
        background: #111827;
    }

    .hero-buttons a.secondary {
        background: #374151;
    }
</style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">Perfume store</div>
    <div class="nav-links">
        <a href="signup.php">Sign Up</a>
        <a href="login.php">Log In</a>
        <a href="Admin.php">Admin</a>
        <a href="demo.php">Order / Customer Lookup</a>
    </div>
</div>

<!-- HERO SECTION -->
<div class="hero">
    <h1>Welcome</h1>
    <p>Search orders, manage customers, and access your account.</p>

    <div class="hero-buttons">
        <a href="signup.php">Create Account</a>
     
    </div>
</div>

</body>
</html>
