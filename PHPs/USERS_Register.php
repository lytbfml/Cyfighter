<?php
require_once ('dbConnect.php');
$input = file_get_contents ( 'php://input' );
$obj = json_decode ( $input );
$username = $obj->{'username'};
$password = $obj->{'password'};

if (! empty ( $username ) && ! empty ( $password )) {
	// Creating an sql query
	$query = "Insert into USERS(usertype, username, password) VALUES('3', '$username', '$password')";
	// Importing our db connection script
	$db = new DB_connection ();
	$con = $db->getConnection ();
	// Executing query to database
	if (mysqli_query ( $con, $sql )) {
		$output ['Success'] = 'Account created, welcome ' . $username;
	} else {
		$output ['Error'] = 'Account ' . $username . ' aready existed!';
	}
	echo json_encode ( $output );
	
	// Closing the database
	mysqli_close ( $con );
} else {
	echo json_encode ( "Please fill both fields!" );
}
?>