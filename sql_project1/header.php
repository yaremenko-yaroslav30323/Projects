<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>🌐 YaDia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .welcome-msg {
            color: #ffffff;
            font-weight: 500;
            margin-left: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a class="navbar-brand" href="index.php">🌐 YaDia</a>
            <?php if (isset($_SESSION['username'])): ?>
                <span class="welcome-msg">👋 Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
            <?php endif; ?>
        </div>
        <div class="d-flex">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="nav-link text-white me-3" href="posts.php">📝 Posts</a>
                <a class="nav-link text-white me-3" href="products.php">🛍️ Products</a>
                <a class="nav-link text-white me-3" href="contact.php">📩 Contact</a>
                <a class="nav-link text-white" href="logout.php">🚪 Logout</a>
            <?php else: ?>
                <a class="nav-link text-white me-3" href="login.php">🔐 Login</a>
                <a class="nav-link text-white" href="register.php">📝 Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">