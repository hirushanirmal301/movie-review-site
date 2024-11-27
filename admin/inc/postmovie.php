<?php 

require_once './inc/db.php';


if (isset($_POST['create_movie'])) {
    
    global $conn;

    $movie_title = mysqli_real_escape_string($conn, $_POST['movie_title']);
    $movie_description = mysqli_real_escape_string($conn, $_POST['movie_description']);
    $release_year = mysqli_real_escape_string($conn, $_POST['release_year']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);

    // File upload variables
    $target_dir = "../uploads/"; // Directory to save uploaded files
    $file_name = rand().'-'.basename($_FILES["movie_avatar"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = true;

    // Check if the file is a valid image
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["movie_avatar"]["tmp_name"]);
    if ($check === false) {
        $uploadOk = false;
        echo "File is not an image.";
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = false;
        echo "Sorry, file already exists.";
    }

    // Allow only specific image file types
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif", "webp"])) {
        $uploadOk = false;
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
    }

    // Check file size (limit: 2MB)
    if ($_FILES["movie_avatar"]["size"] > 2 * 1024 * 1024) {
        $uploadOk = false;
        echo "Sorry, your file is too large.";
    }

    // Proceed if file is valid
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["movie_avatar"]["tmp_name"], $target_file)) {
            // File successfully uploaded, save movie details in the database
            $stmt = $conn->prepare("INSERT INTO movies (title, description, release_year, genre, poster_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiss", $movie_title, $movie_description, $release_year, $genre, $file_name);

            if ($stmt->execute()) {
                header('Location: http://localhost/htmlTemp/admin/post?action=post_success');
                exit();
            } else {
                echo "Error: Could not save movie details.";
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, your file could not be uploaded.";
    }
}



?>