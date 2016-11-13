<?php

$input = file_get_contents ( 'php://input' );
$obj = json_decode ( $input );
//Getting the requested id
$username = $obj->{'username'};

//Importing database
require_once('dbConnect.php');
$db = new DB_connection();
$con = $db->getConnection();

//Creating sql query with where clause to get an specific employee
$sql = "SELECT * FROM USERS WHERE username = '$username'";

//getting result
$r = mysqli_query($con,$sql);

//pushing result to an array
$result = array();
$row = mysqli_fetch_array($r);
array_push($result,array(
		"ID"=>$row['ID'],
		"usertype"=>$row['usertype'],
		"username"=>$row['username']
));

//displaying in json format
echo json_encode(array('result'=>$result));

mysqli_close($con);

?>