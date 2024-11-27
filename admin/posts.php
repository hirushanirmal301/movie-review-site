<?php require_once "./inc/header.php"; ?>
<?php 
if (isset($_GET['remove_movie_id'])) {
    $remove_movie_id = intval($_GET['remove_movie_id']);
    $delete_sql = "DELETE FROM movies WHERE id=$remove_movie_id";
    if ($conn->query($delete_sql) === TRUE) {
        header('Location: http://localhost/htmlTemp/admin/post?action=movie_remove_success');
        exit();
    }
    else
    {
        header('Location: http://localhost/htmlTemp/admin/post?action=movie_remove_err');
        exit();
    }
}

?>
        <main class="main-content">
            <header class="header">
                <h1>Welcome to the Admin Dashboard</h1>
            </header>
            <section class="content" style=" display: flex; flex-direction: row; justify-content: space-between; gap: 2;">
            	<div class="form-container">
            		<h3>Create Movie</h3>
	            	<form action="" id="moview_form" method="POST" enctype="multipart/form-data">
	                	
	                	<div>
	                		<label for="movie_title">Movie Title:&nbsp;</label><br>
	                		<input type="text" placeholder="Movie Title" name="movie_title" id="movie_title" required>
	                	</div>
	                	<div>
	                		<label for="movie_description">Movie Description:&nbsp;</label><br>
	                		<textarea placeholder="Movie Description" name="movie_description" id="movie_description" required></textarea>
	                	</div>
	                	<div>
	                		<label for="release_year">Release Year:&nbsp;</label><br>
	                		<input type="number" placeholder="Release Year" name="release_year" id="release_year" required>
	                	</div>
	                	<div>
	                		<label for="genre">Genre:&nbsp;</label><br>
	                		<select id="genre" name="genre" required>
	                			<option>Select a Genre</option>
	                			<option value="Action">Action</option>
	                			<option value="Drama">Drama</option>
	                			<option value="Comedy">Comedy</option>
	                			<option value="Horror">Horror</option>
	                			<option value="Sci-Fi">Sci-Fi</option>
	                			<option value="Romance">Romance</option>
	                		</select>
	                	</div>
	                	<div>
					        <label for="movie_avatar">Movie Poster:</label>
					        <input type="file" name="movie_avatar" accept="image/*" required>
					    </div>
	                	<div>
	                		<br>
	                		<button type="submit" name="create_movie" class="btn btn-primary">Create Movie</button>
	                	</div>
	                </form>
            	</div>
            	<link rel="stylesheet" href="./css/table.css">
            	<div class="form-table">
            		<table>
					  <tr>
					    <th>ID</th>
					    <th>Movie Title</th>
					    <th>Genre</th>
					    <th>Release Year</th>
					    <th>Action</th>
					  </tr>
					  
					  <?php 

					  	$moviesql = "SELECT * FROM movies";
					  	$movieresult = $conn->query($moviesql);

					  	if ($movieresult->num_rows > 0) {
					  		while ($row = $movieresult->fetch_assoc()) { ?>
					  			<tr>
								    <td><?php echo $row['id']; ?></td>
								    <td><?php echo $row['title']; ?></td>
								    <td><?php echo $row['release_year']; ?></td>
								    <td><?php echo $row['genre']; ?></td>
								    <td><button onclick='confirmDelete(<?php echo $row['id']; ?>)' class="remove-button" style="margin-top: 5px !important; margin-bottom: 5px !important;">Remove</button></td>
								  </tr>

					  		 <?php }
					  	}

					  ?>

					</table>
            	</div>
            </section>
        </main>

<script>
	
	function confirmDelete(id) {
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = './post?remove_movie_id=' + id;
			}
		});
	}

</script>

<?php require_once "./inc/footer.php"; ?>