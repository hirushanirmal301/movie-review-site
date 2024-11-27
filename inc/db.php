<?php
session_start();
error_reporting(1);

$servername = "localhost";   
$username = "root";          
$password = "";              
$dbname = "website"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}  

$directoryURI =basename($_SERVER['SCRIPT_NAME']);

function is_Admin(){

    global $conn;

    $username = $_SESSION['username'];

    $usersql = "SELECT is_admin FROM users WHERE username='$username' AND is_admin=1 LIMIT 1";

    $userResult = $conn->query($usersql);


    if ($userResult->num_rows > 0) {
        
        return true;

    }
    else {

        return false;
    }

}

?>