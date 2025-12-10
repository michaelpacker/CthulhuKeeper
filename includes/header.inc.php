<?php
	session_start();
	include 'includes/dbh.inc.php';
	if (isset($_SESSION['user-id'])) { 
		$user_id 	= $_SESSION['user-id'];
		$user_fname = $_SESSION['user-first-name'];
		$user_role 	= $_SESSION['user-role'];
	}
	else {
		if ($page_title !== 'Enter') {
			// header("Location: gatewayEnter.php");
			// exit();
		}
	} 
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Cthulhu Keeper <?php echo $page_title; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Roboto|Stylish&display=swap" rel="stylesheet"> 
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    <script src="www/js/scripts.js"></script>
	
	<link rel="stylesheet" type="text/css" href="www/css/style.css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>
	<div class="pageWrap close">
	<header>
		<h1 class="close"><a href="#" class="menuToggle">Cthulhu Keeper</a></h1>
			<ul class="gatewayNav">
			<?php 
					if (isset($_SESSION['user-id'])) {
						echo "<li><a href='profile.php?id=".$user_id."'>".$user_fname."</a></li>";
						echo "<li>";
						echo "<form action='includes/logout.inc.php' method='POST' class='logoutForm'>"
							."<button class='logout' type='submit' name='logout-submit'>Log out</button>"
						."</form>";
						echo "</li>";
					} else {
						// echo "<li><a href='gatewayEntreat.php'>Register</a></li>";
						// echo "<li><a href='gatewayEnter.php'>Log In</a></li>";
					}
			?>
			</ul>
	</header>

		<nav class="navigation">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="combat.php">Combat Helper</a></li>
				<li><a href="equipment.php">Equipment</a></li>
				<li><a href="weapons.php">Weapons list</a></li>
				<?php 
					if (isset($_SESSION['user-id'])) {
						echo "<li><a href='investigatorAdd.php'>Add an investigator</a></li>";
					}
				?>
			</ul>
		</nav>
	<main>
		<div class="page">
