<?php require_once './inc/header.php'; ?>
<div class="wrapper2">

    <div class="results-container">
        <?php 

        if (isset($_GET['query'])) {
            $searchQuery = mysqli_real_escape_string($conn, $_GET['query']);

            // SQL Query to search in title, genre, and description
            $sql = "SELECT * FROM movies 
                    WHERE title LIKE ? OR genre LIKE ? OR description LIKE ? 
                    ORDER BY id ASC";

            // Prepare and execute the query
            $stmt = $conn->prepare($sql);
            $searchTerm = '%' . $searchQuery . '%';
            $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if results are found
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="movie">
                        <img src="./uploads/<?php echo htmlspecialchars($row['poster_path'], ENT_QUOTES); ?>" alt="Movie Poster">
                        <div class="movie-details">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><strong>Genre:</strong> <?php echo htmlspecialchars($row['genre']); ?></p>
                            <p><?php echo htmlspecialchars(substr($row['description'], 0, 100)); ?>...</p>
                            <a href="./view.php?permalink=<?php echo $row['id']; ?>">Read more</a>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <p>No movies found matching your search query.</p>
            <?php }
            $stmt->close();
        } else { ?>
            <p>Enter a search term to find movies.</p>
        <?php } ?>
    </div>
</body>
</html>

	

</div>	
<?php require_once './inc/footer.php'; ?>