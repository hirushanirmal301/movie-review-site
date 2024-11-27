<?php require_once './inc/header.php'; ?>
	<div class="wrapper2">
			<div class="mainbaner">	
				<div class="maintext">	
					<h1>Bringing Movies to Life,</h1><br>	
					<h4>One Review at a Time.</h4>
					<button class="rev">Review Now</button>
					<p>Welcome to Lite reviews Your Source for Honest Movie Reviews! <br>
					Explore in-depth reviews, ratings, and recommendations for films of all genres. <br> Discover the latest hits, hidden gems, and join a community of movie lovers!</p>	
				</div>
				<div class="todayrec">
					<h2>Today Recoment Move</h2>

					<?php 

			        // Query to fetch movie details
			        $moviesql = "SELECT * FROM movies ORDER BY ID DESC LIMIT 6";
			        $movieresult = $conn->query($moviesql);

			        // Check if a movie is found
			        if ($movieresult->num_rows > 0) {
			            while ($row = $movieresult->fetch_assoc()) { 

					?>

					<a href="./view.php?permalink=<?php echo $row['id']; ?>"><img src="./uploads/<?php echo htmlspecialchars($row['poster_path'], ENT_QUOTES); ?>" alt=""></a>
				<?php
						}
					}
				?>
				</div>
			
			</div>

			<div class="propulermov">	
				<div class="propulermovText">	
					<h1>Popular Movies <br>	
					to Watch Now</h1>

				</div>
				<div class="propulermovimg">	

					<?php 

			        // Query to fetch movie details
			        $moviesql = "SELECT * FROM movies ORDER BY ID ASC LIMIT 10";
			        $movieresult = $conn->query($moviesql);

			        // Check if a movie is found
			        if ($movieresult->num_rows > 0) {
			            while ($row = $movieresult->fetch_assoc()) { 

					?>

					<a href="./view.php?permalink=<?php echo $row['id']; ?>"><img src="./uploads/<?php echo htmlspecialchars($row['poster_path'], ENT_QUOTES); ?>" alt=""></a>

					<?php
						}
					}
				?>
				</div>

			</div>

	

</div>	
<?php require_once './inc/footer.php'; ?>