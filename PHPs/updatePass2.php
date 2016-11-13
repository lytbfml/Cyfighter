<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
	require 'connection.php';
	createStudent();
}


function createstudent()
{
	global $connect;
	
	$firstname = $_POST["firstname"];	
	$lastname = $_POST["lastname"];
	$age = $_POST["age"];
	
	$query = " Insert into student(firstname,lastname,age) values ('$firstname','$lastname','$age');";
	
	mysqli_query($connect, $query) or die (mysqli_error($connect));
	mysqli_close($connect);
	
}
//

if($_SERVER["REQUEST_METHOD"]=="POST"){
	include 'connection.php';
	showStudent();
}

function showStudent()
{
	global $connect;

	$query = " Select * FROM STUDENT; ";

	$result = mysqli_query($connect, $query);
	$number_of_rows = mysqli_num_rows($result);

	$temp_array  = array();

	if($number_of_rows > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$temp_array[] = $row;
		}
	}

	header('Content-Type: application/json');
	echo json_encode(array("students"=>$temp_array));
	mysqli_close($connect);

}