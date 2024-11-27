<?php 
	function loggedIn(){
		if (isset($_SESSION['username'])) {
			return true;
		}
		else return false;
	}
 ?>