<?php
//Importing Database Script
require_once('dbConnect.php');

$db = new DB_connection();
$con = $db->getConnection();

//Creating sql query
$sql = "SELECT * FROM Aircrafts";

//getting result
$r = mysqli_query($con,$sql);

//creating a blank array
$result = array();

//looping through all the records fetched
while($row = mysqli_fetch_array($r)){

	//Pushing username and ID in the blank array created
	array_push($result,array(
			"AircraftID"=>$row['AircraftID'],
			"AircraftName"=>$row['AircraftName'],
			"Enable"=>$row['Enable'],
			"Health"=>$row['Health'],
			"Lives"=>$row['Lives'],
			"Speed"=>$row['Speed'],
			"Coins"=>$row['Coins'],
			"Cys"=>$row['Cys'],
			"SpecialID"=>$row['SpecialID']
	));
}

//Displaying the array in json format
echo json_encode(array('result'=>$result));

mysqli_close($con);

?>