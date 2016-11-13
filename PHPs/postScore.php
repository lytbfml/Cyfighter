<?php
require_once 'dbConnect.php';

$json = file_get_contents ( 'php://input' );
$obj = json_decode ( $json );
$username = $obj->{'username'};
$username2 = $obj->{'username2'};
$Score = $obj->{'Score'};
$Coop = $obj->{'Coop'};
$Difficulty = $obj->{'Difficulty'};
$EmblemName = $obj->{'EmblemName'};

$db = new DB_connection ();
$con = $db->getConnection ();

$query = "SELECT * FROM HighScores WHERE username='$username' AND username2 = '$username2'";
$result = mysqli_query ( $con, $query );
if (mysqli_num_rows ( $result ) > 0) {
	$query2 = "Update HighScores Set Score = '$Score' Where username = '$username' AND username2 = '$username2'";
	$result2 = mysqli_query ( $con, $query2 );
	$json1 ['Success'] = 'Yes';
} else {
	$query2 = "INSERT INTO HighScores(username, username2, Score, Coop, Difficulty, EmblemName) VALUES('$username', '$username2', '$Score','$Coop','$Difficulty','$EmblemName')";
	$result2 = mysqli_query ( $con, $query2 );
	$json1 ['Success'] = 'Yes2';
}

mysqli_close ( $con );
echo json_encode ( $json1 );
?>