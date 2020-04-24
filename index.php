<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>S.A.B.A.S (Standard Api Based Authentication System)</title>
</head>
<body>
	

	<section>


		<?php 
			if (isset($_SESSION['userId'])) {
				echo'
				<form action="includes/logout.inc.php" method="post">
					<button type="submit" name="logout-submit">Log out</button>
				</form>';
			} else {
				echo'
				<form action="includes/login.inc.php" method="post">
					<input type="text" name="mailuid" placeholder="Username / Email">
					<input type="password" name="pwd" placeholder="Password">
					<button type="submit" name="login-submit">Login</button>
				</form>

				<a href="signup.php">Sign up</a>';
			}

		 ?>
		
		
		
		


		<?php 
			if (isset($_SESSION['userId'])) {
				echo'<p>You are Logged in</p>';
			} else {
				echo'<p>You are Logged out</p>';
			}

		 ?>
	</section>


</body>
</html>