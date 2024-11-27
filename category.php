<?php require_once './inc/header.php'; ?>
	<div class="wrapper2">
		<br>
		<br>
		<br>
		<div class="propulermov">	
    <div class="propulermovText">	
        <h1><?php if(isset($_GET['type'])) {echo $_GET['type'];} else {echo "";} ?> Movies</h1>
    </div>
    <div class="propulermovimg">	
        <?php 
        if (isset($_GET['type'])) {
            // Safely retrieve and sanitize the genre type
            $type = $_GET['type'];

            // Prepare and execute the query
            $stmt = $conn->prepare("SELECT * FROM movies WHERE genre = ? LIMIT 10");
            $stmt->bind_param("s", $type);
            $stmt->execute();
            $movieresult = $stmt->get_result();

            // Check if movies are found
            if ($movieresult->num_rows > 0) {
                while ($row = $movieresult->fetch_assoc()) { 
        ?>
                <a href="./view.php?permalink=<?php echo $row['id']; ?>">
                    <img src="./uploads/<?php echo htmlspecialchars($row['poster_path'], ENT_QUOTES); ?>" alt="Movie Poster">
                </a>
        <?php
                }
            } else { ?>
                <div class="error-message">
                    <h2>0 Movies Available</h2>
                    <p>No movies are available for the selected genre.</p>
                </div>
            <?php }
            $stmt->close();
        } else { ?>
            <div class="error-message">
                <h2>Invalid Access</h2>
                <p>No movie type was specified. Please use a valid link to access movie details.</p>
            </div>
        <?php } ?>
    </div>
</div>



	

</div>	
<?php require_once './inc/footer.php'; ?>