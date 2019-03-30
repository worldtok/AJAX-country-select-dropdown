<?php
$connection = mysqli_connect('localhost', 'root', '');
if(!$connection){
	die("Database Connection Failed" . mysqli_error($connection));
}

$selectdb = mysqli_select_db($connection, 'phpajax');
if(!$selectdb){
	die("Database Selection Failed" . mysqli_error($connection));
}
$state_id = (int) $_GET['state_id'];

$sql = "SELECT * FROM cities WHERE state_id=$state_id";
$result = mysqli_query($connection, $sql);
	echo "<option disabled selected>Please Select City</option>";
while($row = mysqli_fetch_assoc($result)){
	echo "<option value='" . $row['id'] . "'>" . $row['name'] ."</option>";
}
 
?>