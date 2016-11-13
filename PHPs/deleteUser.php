<?php
//Getting Id
$username = $_GET['username'];

//Importing database
require_once('dbConnect.php');

//Creating sql query
$sql = "DELETE FROM USERS WHERE username=$username;";

//Deleting record in database
if(mysqli_query($con,$sql)){
	echo 'User Deleted Successfully';
}else{
	echo 'Could Not Delete user Try Again';
}

//closing connection
mysqli_close($con);


?>