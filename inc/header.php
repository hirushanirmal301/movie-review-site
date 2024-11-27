<?php
	include_once './inc/db.php';
	include_once './authenticate/errors.php';
	include_once './authenticate/inc/function.php';


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://localhost/htmlTemp/css/main.css">
	<link rel="stylesheet" href="http://localhost/htmlTemp/css/footer.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/animations.min.css"/>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<?php 

	if ($directoryURI == 'view.php') { ?>
      <link rel="stylesheet" href="http://localhost/htmlTemp/css/view.css">
    <?php } ?>

	<title>WatchBox</title>
</head>
<body>
	<div class="wrapper">
		<div class="navbar">
			<div class="navmenu">
				<ul>
					<li><a href="./">Home</a></li>
					<li><a href="./category.php?type=Horror">Horror</a></li>
					<li><a href="./category.php?type=Action">Action</a></li>
					<li><a href="./about.php">About Us</a></li>
				</ul>
				
			</div>
			<div class="logo">
				<h1>WatchBox</h1>
			</div>

			<div class="loginicon">
				<?php 

					if (loggedIn()){

						if(is_Admin() == True) { ?>

							<a href="./admin">
								<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path></svg>
							</a>

						<?php }
						else
						{ ?>
							<a href="./login?logout=true"><span style="color: white !important;"><?php echo $_SESSION['username']; ?></span></a>
						<?php }

					}
					else
					{ ?>

						<a href="./login">
							<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path></svg>
						</a>
					<?php
					}

					

				?>
				
			</div>
		</div>
		<!-- navbar end -->
		<center>
		<div class="searcharea">	
			<form action="./search.php" method="GET">
		            <input type="text" name="query" placeholder="Enter movie title, genre, or description" required>
		            <button type="submit">Search</button>
		    </form>
		</div>
		</center>

		
	</div>