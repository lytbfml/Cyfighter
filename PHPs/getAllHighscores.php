<?php
//Importing Database Script
require_once('dbConnect.php');

$db = new DB_connection();
$con = $db->getConnection();

//Creating sql query
$sql = "SELECT * FROM HighScores";

//getting result
$r = mysqli_query($con,$sql);

//creating a blank array
$result = array();

//looping through all the records fetched
while($row = mysqli_fetch_array($r)){
	
	//Pushing username and ID in the blank array created
	array_push($result,array(
			"username"=>$row['username'],
			"username2"=>$row['username2'],
			"Score"=>$row['Score'],
			"Coop"=>$row['Coop'],
			"Difficulty"=>$row['Difficulty'],
			"EmblemName"=>$row['EmblemName']
	));
}

//Displaying the array in json format
echo json_encode(array('result'=>$result));

mysqli_close($con);

?>