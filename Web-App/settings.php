<?php
$host = "feenix-mariadb.swin.edu.au";
$user = "s105149160"; // your user name
$pwd = "080801"; // your password (date of birth ddmmyy unless changed)
$sql_db = "s105149160_db"; // your database

$conn = mysqli_connect(
	$host,
	$user,
	$pwd,
	$sql_db
);
