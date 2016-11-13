<?php
//Importing Database Script
require_once('dbConnect.php');

$db = new DB_connection();
$con = $db->getConnection();

//Creating sql query
$sql = "SELECT * FROM USERS";

//getting result
$r = mysqli_query($con,$sql);

//creating a blank array
$result = array();

//looping through all the records fetched
while($row = mysqli_fetch_array($r)){

	//Pushing username and ID in the blank array created
	array_push($result,array(
			"ID"=>$row['ID'],
			"usertype"=>$row['usertype'],
			"username"=>$row['username'],
			"password"=>$row['password'] 
	));
}

//Displaying the array in json format
echo json_encode(array('result'=>$result));

mysqli_close($con);

?>