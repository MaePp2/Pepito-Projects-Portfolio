<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <link rel="stylesheet" type="text/css" href="../styles/nav.css" />
    </head>
    <body>
        <header class="header">
            <div class="left-section">
                <div class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </div>
                <?php session_start(); if (isset($_SESSION["logged_in"])): ?>
                <div class="nav-item">
                    <a class="nav-link" href="prospects.php">Prospects</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="calculator.php">Calculator</a>
                </div>
                <?php endif; ?>
            </div>
            <div class="middle-section">
                <div class="logo">Compatibility Test</div>
            </div>
            <div class="right-section">
                <?php if (!isset($_SESSION["logged_in"])): ?>
                <div class="nav-item">
                    <a class="nav-link" href="login.php">Log In</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="register.php">Sign Up</a>
                </div>
                <?php endif; ?>
                <?php if (isset($_SESSION["logged_in"])): ?>
                <div class="nav-item">
                    <a class="nav-link" href="logout.php">Log Out</a>
                </div>
                <?php endif; ?>
            </div>
        </header>
    </body>
</html>