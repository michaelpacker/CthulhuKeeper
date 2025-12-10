<?php
	session_start();
	$page_title='Home';
	require "includes/header.inc.php";
?>

<?php 
// See if there is a session. 
// If not, pop login form

// Check session variables

/*
	$sql ="SELECT * FROM users";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../signup.php?error=sqlError");
		exit();
	}
	else {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$resultCheck = mysqli_stmt_num_rows($stmt);
	}

*/
include 'includes/dbh.inc.php';
	if (isset($_SESSION['user-id'])) { 
		
	}
	else {
		echo "<p>Please login</p>";	
	}
?>




<?php
	require "includes/footer.inc.php";
?>