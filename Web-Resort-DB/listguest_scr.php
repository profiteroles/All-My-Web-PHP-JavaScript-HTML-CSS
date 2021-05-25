
<?php

require("connect.php");
$sql = "SELECT id, fullname, address, stay_date, comment 
		FROM person";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	//open table
	echo '<table class="table table-striped" id="outTable">';
	echo     "<tr>
				<th>Guest ID</th>
				<th>Full Name</th>
				<th>Address</th>
				<th>Stay Date</th>
				<th>Comment</th>
				<th>Delete</th>
			</tr>";
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$id = $row['id'];
		$name = $row["fullname"];
		$address = $row["address"];
		$staydate = $row["stay_date"];
		$comment = $row["comment"];
	echo "<tr>
			<td onclick=popfields($id)>$id</td>
			<td>$name</td>
			<td>$address</td>
			<td>$staydate </td>
			<td>$comment</td>
			<td><a href='delguest_scr.php?id=$id'>Del</a></td>
		</tr>";

	}
	echo "</table>";
} else {
	echo "0 results";
}
$conn->close();
?>
