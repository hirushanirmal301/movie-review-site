<?php 
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login');
    exit();
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);	
    header('location: ../login');
    exit();
}

include_once './inc/db.php';

if (isset($_SESSION['username'])) {
    if (!is_Admin($_SESSION['username'])) {
        $_SESSION['msg'] = "Unauthorized access";
        header('Location: ../home');
        exit();
    }
}

include_once './inc/postmovie.php';
include_once '../authenticate/errors.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Admin Panel</title>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a class="active" href="./">Dashboard</a></li>
                <li><a href="./post">Post</a></li>
                <li><a href="?logout=true">Logout</a></li>
            </ul>
        </aside>