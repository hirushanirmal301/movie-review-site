
<?php

    include_once './inc/db.php';
    include_once 'errors.php';
    include_once './inc/function.php';



    $email    = "";
    $username    = "";

    function isUnique($email){
        $query = "select * from users where email='$email'";
        global $conn;
       
        $result = $conn->query($query);
       
        if($result->num_rows > 0){
            return false;
        }
        else return true;
       
    }

    function isUniqueUser($username){
        $query = "select * from users where username='$username'";
        global $conn;
       
        $result = $conn->query($query);
       
        if($result->num_rows > 0){
            return false;
        }
        else return true;
       
    }


    if (isset($_POST['submit'])) {

        if (strlen($_POST['username']) <3) {
            sleep(2);
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://localhost/htmlTemp/register?action=err_user">';
            exit();

        }

        elseif (!isUniqueUser($_POST['username'])) {
            sleep(2);
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://localhost/htmlTemp/register?action=err_uniquser">';
            exit();
        }

        elseif (!isUnique($_POST['email'])) {
            sleep(2);
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://localhost/htmlTemp/register?action=err_email">';
            exit();
        }

        elseif(strlen($_POST['password']) <5) {
            sleep(2);
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://localhost/htmlTemp/register?action=err_passlen">';
            exit();
        }
        

        elseif ($_POST['password'] != $_POST['rpassword']) {
            sleep(2);
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://localhost/htmlTemp/register?action=err_pass">';
            exit();
        }

        else{

            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $email =  mysqli_real_escape_string($conn, $_POST['email']);
            $password_1 =  mysqli_real_escape_string($conn,  $_POST['password']);

            $token = bin2hex(openssl_random_pseudo_bytes(32));
            $password = md5($password_1);


            $query = "insert into users (username,email,password,token) values('$username','$email','$password','$token')";

            $conn->query($query);
            sleep(2);
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://localhost/htmlTemp/login?action=done">';
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
            <h1>Agora</h1>
        </div>
    </div>

    <div class="maintext">
            <h1>Sign Up to Connect,</h1><br>
            <p>Sign up today to connect with a vigrant community</p>  

    </div>  

    <div class="main">
    <div class="wrapper">
        <form action="" method="post">
            <!-- <h1>Register</h1> -->
            <div class="input_box">
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="input_box">
                <input type="text" name="email" placeholder="Email">
            </div>
            <div class="input_box">
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="input_box">
                <input type="password" name="rpassword" placeholder="Retype password">
            </div>
            <button type="submit" name="submit" class="btn">Register</button><br>
            <a href="./login" class="reg">Do you have an Account?</a>
        </form>
    </div>

</div>

    
</body>
</html>