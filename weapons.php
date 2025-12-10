<?php
	session_start();
	$page_title='Weapons';
	require "includes/header.inc.php";
?>
<h2>1920s Weapons</h2>
<!-- <a href="https://coolors.co/d3d4d9-4b88a2-bb0a21-252627-fff9fb">https://coolors.co/d3d4d9-4b88a2-bb0a21-252627-fff9fb</a> -->
<p>Numbers in parenthesis - e.g. <strong>1(3)</strong> - mean that the weapon may fire multiple times each round, up to the number in parenthesis, but each shot will require a penalty die. There is no penalty for firing a single shot.</p>
<p>Numbers joined by "or" - e.g. <strong>1 or 2</strong> - mean that the weapon may fire multiple times each round. If all shots are aimed at the same target, no penalty is applied. Otherwise, multiple targets will incur a penalty die. There is no penalty for firing a single shot.</p>
<p>$1 in 1920 would be about $13 today.</p>
<?php
	// https://youtu.be/0YLJ0uO6n8I?list=PL0eyrZgxdwhwBToawjm9faF1ixePexft-&t=315
	$era = '1920s';
	$sql = "SELECT * FROM weapons WHERE weapon_type = 'Hand to Hand' AND era LIKE '%$era%';"; // Double colons intentional
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);


	if ($resultCheck > 0) {
		
		echo "<section class='weaponList'><h3>Hand to Hand</h3>";
		echo "<table><thead><tr>";
		echo "<th>Weapon Name</th><th>Skill</th><th>Uses/Round</th><th>Damage</th><th>Cost</th><th>Malfunction</th>";
		echo "</tr></thead>";
		echo "<tbody>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>"
				."<td>".$row['weapon_name']."</td>"
				."<td>".$row['weapon_skill']."</td>"
				."<td>".$row['uses_round']."</td>"
				."<td>".$row['weapon_damage']."</td>"
				."<td>$".$row['cost_1920'].".00</td>"
				."<td>".$row['malfunction']."</td>"
				."</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</section>";
	}
	$sql = "SELECT * FROM weapons WHERE weapon_type = 'Handgun' AND era LIKE '%$era%';"; // Double colons intentional
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);


	if ($resultCheck > 0) {
		
		echo "<section class='weaponList'><h3>Handguns (Firearms: Handguns)</h3>";
		echo "<table><thead><tr>";
		echo "<th>Weapon Name</th><th>Uses/Round</th><th>Base Range</th><th>Damage</th><th>Capacity</th><th>Malfunction</th>";
		echo "</tr></thead>";
		echo "<tbody>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>"
				."<td>".$row['weapon_name']."</td>"
				."<td>".$row['uses_round']."</td>"
				."<td>".$row['weapon_min_range']." yards</td>"
				."<td>".$row['weapon_damage']."</td>"
				."<td>".$row['bullets_magazine']."</td>"
				."<td>".$row['malfunction']."</td>"
				."</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</section>";
	}
	$sql = "SELECT * FROM weapons WHERE weapon_type = 'Machine gun' AND era LIKE '%$era%';"; // Double colons intentional
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);


	if ($resultCheck > 0) {
		
		echo "<section class='weaponList'><h3>Machine Guns (Firearms: Machine Gun)</h3>";
		echo "<table><thead><tr>";
		echo "<th>Weapon Name</th><th>Uses/Round</th><th>Base Range</th><th>Damage</th><th>Capacity</th><th>Malfunction</th>";
		echo "</tr></thead>";
		echo "<tbody>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>"
				."<td>".$row['weapon_name']."</td>"
				."<td>".$row['uses_round']."</td>"
				."<td>".$row['weapon_min_range']." yards</td>"
				."<td>".$row['weapon_damage']."</td>"
				."<td>".$row['bullets_magazine']."</td>"
				."<td>".$row['malfunction']."</td>"
				."</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</section>";
	}
	$sql = "SELECT * FROM weapons WHERE weapon_type = 'Rifle' AND era LIKE '%$era%';"; // Double colons intentional
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);


	if ($resultCheck > 0) {
		
		echo "<section class='weaponList'><h3>Rifles (Firearms: Rifles)</h3>";
		echo "<table><thead><tr>";
		echo "<th>Weapon Name</th><th>Uses/Round</th><th>Base Range</th><th>Damage</th><th>Capacity</th><th>Malfunction</th>";
		echo "</tr></thead>";
		echo "<tbody>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>"
				."<td>".$row['weapon_name']."</td>"
				."<td>".$row['uses_round']."</td>"
				."<td>".$row['weapon_min_range']." yards</td>"
				."<td>".$row['weapon_damage']."</td>"
				."<td>".$row['bullets_magazine']."</td>"
				."<td>".$row['malfunction']."</td>"
				."</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</section>";
	}
	$sql = "SELECT * FROM weapons WHERE weapon_type = 'Shotgun' AND era LIKE '%$era%';"; // Double colons intentional
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);


	if ($resultCheck > 0) {
		
		echo "<section class='weaponList'><h3>Shotguns  (Firearms: Shotguns)</h3>";
		echo "<table><thead><tr>";
		echo "<th>Weapon Name</th><th>Uses/Round</th><th>Range</th><th>Damage</th><th>Cost</th><th>Malfunction</th>";
		echo "</tr></thead>";
		echo "<tbody>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>"
				."<td>".$row['weapon_name']."</td>"
				."<td>".$row['uses_round']."</td>"
				."<td>".$row['weapon_min_range']."/".$row['weapon_med_range']."/".$row['weapon_max_range']."</td>"
				."<td>".$row['weapon_damage']."</td>"
				."<td>".$row['cost_1920']."</td>"
				."<td>".$row['malfunction']."</td>"
				."</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</section>";
	}
	$sql = "SELECT * FROM weapons WHERE weapon_type = 'Sub-machine gun' AND era LIKE '%$era%';"; // Double colons intentional
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);


	if ($resultCheck > 0) {
		
		echo "<section class='weaponList'><h3>Sub-Machine Guns  (Firearms: SMG)</h3>";
		echo "<table><thead><tr>";
		echo "<th>Weapon Name</th><th>Uses/Round</th><th>Base Range</th><th>Damage</th><th>Capacity</th><th>Malfunction</th>";
		echo "</tr></thead>";
		echo "<tbody>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>"
				."<td>".$row['weapon_name']."</td>"
				."<td>".$row['uses_round']."</td>"
				."<td>".$row['weapon_min_range']." yards</td>"
				."<td>".$row['weapon_damage']."</td>"
				."<td>".$row['bullets_magazine']."</td>"
				."<td>".$row['malfunction']."</td>"
				."</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</section>";
	}
?>


<?php
	require "includes/footer.inc.php";
?>