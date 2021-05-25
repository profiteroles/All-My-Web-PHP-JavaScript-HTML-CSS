
<?php

require("connect.php");
$sql = "SELECT Title, Studio, Status, Sound, Versions, RecRetPrice, Rating, Year, Genre,Aspect
FROM movies ORDER BY rand() limit 10";

try {
	$conn->query($sql) === TRUE;
	echo "<h4>There is Your TOP 10 Favorite Movies</h4><br>";
} catch (Exception $err) {
	echo "Error: \n |||$err||";
}

$query = $conn->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);

if ($results > 0) {
	//open table
	echo '<table class="table table-striped" id="outTable">';
	echo     "<tr>
	<th>Title</th>
	<th>Studio</th>
	<th>Status</th>
	<th>Sound</th>
	<th>Versions</th>
	<th>RecRetPrice</th>
	<th>Rating</th>
	<th>Year</th>
	<th>Genre</th>
	<th>Aspect</th>
</tr>";
foreach($results as $row) { 

	$title = $row["Title"];
	$studio = $row["Studio"];
	$status = $row["Status"];
	$sound = $row["Sound"];
	$version = $row["Versions"];
	$recRetPrice = $row["RecRetPrice"];
	$rating = $row["Rating"];
	$year = $row["Year"];
	$genre = $row["Genre"];
	$aspect = $row["Aspect"];

	echo "<tr>
		<td>$title</td>
		<td>$studio</td>
		<td>$sound</td>
		<td>$status</td>
		<td>$version </td>
		<td>$recRetPrice</td>
		<td>$rating</td>
		<td>$year</td>
		<td>$genre </td>
		<td>$aspect</td>
	</tr>";
}
echo "</table>";
} else {
	echo "0 results";
}
?>
