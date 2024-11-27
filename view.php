<?php require_once './inc/header.php'; ?>

	<div class="container">
    <?php 
    // Check if the permalink is set
    if (isset($_GET['permalink'])) {


        // Safely cast permalink to an integer
        $permalink = intval($_GET['permalink']);

        // Query to fetch movie details
        $moviesql = "SELECT * FROM movies WHERE id = $permalink LIMIT 1";
        $movieresult = $conn->query($moviesql);

        // Check if a movie is found
        if ($movieresult->num_rows > 0) {
            while ($row = $movieresult->fetch_assoc()) { ?>

                <div class="content">
                    <img 
                        alt="Poster of <?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?>" 
                        height="450" 
                        src="./uploads/<?php echo htmlspecialchars($row['poster_path'], ENT_QUOTES); ?>" 
                        width="300"
                    />
                    <div class="details">
                        <h1><?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?></h1>
                        <div class="description">
                            <?php echo htmlspecialchars($row['description'], ENT_QUOTES); ?>
                        </div>
                        <div class="info">
                            <div>Released: <?php echo htmlspecialchars($row['release_year'], ENT_QUOTES); ?></div>
                            <div>Genre: <?php echo htmlspecialchars($row['genre'], ENT_QUOTES); ?></div>
                            <div>Created At: <?php echo htmlspecialchars($row['created_at'], ENT_QUOTES); ?></div>
                        </div>
                    </div>
                </div>

            <?php }
        } else { ?>
            <div class="error-message">
                <h2>Movie not found!</h2>
                <p>It seems like the movie you're looking for doesn't exist.</p>
            </div>
        <?php }
    } else { ?>
        <div class="error-message">
            <h2>Invalid Access</h2>
            <p>No movie was specified. Please use a valid link to access movie details.</p>
        </div>
    <?php } ?>
</div>

   <div class="social">
    <button>
     <i class="fab fa-facebook-f">
     </i>
    </button>
    <button>
     <i class="fab fa-twitter">
     </i>
    </button>
    <button>
     <i class="fab fa-whatsapp">
     </i>
    </button>
    <button>
     <i class="fab fa-reddit">
     </i>
    </button>
   </div>
  </div>
<?php require_once './inc/footer.php'; ?>