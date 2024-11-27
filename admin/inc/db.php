<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";   
$username = "root";          
$password = "";              
$dbname = "website"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function is_Admin($user_name)
{
    global $conn;
    $user_name = $conn->real_escape_string($user_name);


    $adminquery = "SELECT is_admin FROM users WHERE username='$user_name' LIMIT 1";
    $adminresult = $conn->query($adminquery);

    if ($adminresult && $row = $adminresult->fetch_assoc()) {
        return $row['is_admin'] == 1;
    }

    return false;
}


function movies_table(){

    global $dbname;
    global $conn;

    $conn->select_db($dbname);

    $moviesTable = "CREATE TABLE IF NOT EXISTS movies (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255) NOT NULL, description TEXT, release_year YEAR, genre VARCHAR(100), poster_path VARCHAR(255), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

    if ($conn->query($moviesTable) === TRUE) {

        // echo "Movies Table created successfully. <br>";

    }else {

        die("Error creating movies table: ". $conn->error);

    }


    $reviewsTable = "CREATE TABLE IF NOT EXISTS reviews ( id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(100) NOT NULL, review_text TEXT NOT NULL, rating INT CHECK (rating BETWEEN 1 AND 5), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, movie_id INT NOT NULL, FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE)";

    if ($conn->query($reviewsTable) === TRUE) {

        // echo "Reviews Table created successfully. <br>";
    }
    else
    {
        die("Error creating reviews table:". $conn->error);
    }





}

movies_table();




?>