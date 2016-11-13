<?php
require_once ('dbConnect.php');
$input = file_get_contents ( 'php://input' );
$obj = json_decode ( $input );
$username = $obj->{'username'};
$password_OLD = $obj->{'password_O'};
$password_NEW = $obj->{'password_N'};

if (! empty ( $username ) && ! empty ( $password_OLD ) && ! empty ( $password_NEW )) {
	
	$db = new DB_connection ();
	$con = $db->getConnection ();
	
	$query = "SELECT * FROM USERS WHERE username='$username'";
	$result = mysqli_query ( $con, $query );
	if (mysqli_num_rows ( $result ) > 0) {
		$query2 = "SELECT * FROM USERS WHERE username='$username' and password = '$password_OLD'";
		$result2 = mysqli_query ( $con, $query2 );
		if (mysqli_num_rows ( $result2 ) > 0) {
			$val = 1;//Success
		} else {
			$val = 0;//Wrong pass
		}
	} else {
		$val = -1;//No user
	}
	
	if ($val == 1) {
		$sql = "UPDATE USERS SET password = '$password_NEW' WHERE username = '$username'";
		// Updating database table
		$re = mysqli_query ( $con, $sql );
		if ($re){
			$json ['Success'] = 'Update success';
		}
		else{
			$json ['Error'] = 'Cannot update password! Try again!';
		}
	} else if ($val == 0) {
		$json ['Error'] = 'Wrong password';
	} else {
		$json ['Error'] = 'User ' . $username . ' does not exist!';
	}
	// closing connection
	mysqli_close ( $con2 );
	echo json_encode ( $json );
} else {
	echo json_encode ( "Please fill all fields!" );
}

?>