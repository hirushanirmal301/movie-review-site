<?php 
session_start();
include_once 'errors.php';
include_once './inc/function.php';

$conn = mysqli_connect('localhost', 'root', '', 'website');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);   
    header('location: ./login');
    exit();
}

$errors = array();
$_SESSION['success'] = "";

if (isset($_POST['login'])) {
    $inputUsername = mysqli_real_escape_string($conn, $_POST['luser']);
    $inputPassword = mysqli_real_escape_string($conn, $_POST['lpassword']);
    $password = md5($inputPassword);

    $query = "SELECT * FROM users WHERE username='$inputUsername' AND password='$password'";
    $result = $conn->query($query);

    if ($row = $result->fetch_assoc()) {
        if ($row['status'] == 1) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['success'] = "You are now logged in";

            setcookie("username", $row['username'], time() + 60 * 5);
            if($row['is_admin'] == 1){
                 header('Location: http://localhost/htmlTemp/admin');
                 
                 exit();

            }
            header('Location: http://localhost/htmlTemp/');
            exit();

        }
         else {
            header('Location: http://localhost/htmlTemp/login?action=err_active');
            exit();
        }
    } else {
        header('Location: http://localhost/htmlTemp/login?action=err_acc');
        exit();
    }
}

// Check if already logged in
if (loggedIn()) {
    header('Location: http://localhost/htmlTemp/admin');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/htmlTemp/css/register.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <h1>WatchBox</h1>
        </div>
    </div>
    <div class="maintext">
            <h1>Log in, Let's Begin</h1><br>
            <p>Welcome back! Your personalize experience start here.</p>  

    </div> 

    <div class="main">
    <div class="wrapper">
        <form action="" method="post">
            <!-- <h1>Login</h1> -->
            <div class="input_box">
                <input type="text" name="luser" placeholder="Username">
            </div>
            <div class="input_box">
                <input type="password" name="lpassword" placeholder="Password">
            </div>
            <button type="submit" name="login" class="btn">Login</button><br>
            <a href="./register" class="reg">Don't have an Account?</a>
        </form>
    </div>

</div>

    
</body>
</html>