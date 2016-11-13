<?php
require_once 'dbConnect.php';

$json = file_get_contents ( 'php://input' );
$obj = json_decode ( $json );
$username = $obj->{'username'};
$password = $obj->{'password'};
class User {
	private $db;
	private $con;
	private $val; 
	function __construct() {
		$this->db = new DB_Connection ();
		$this->con = $this->db->getConnection ();
	}
	public function lg($username, $password) {
		$query = "SELECT * FROM USERS WHERE username='$username'";
		$result = mysqli_query ( $this->con, $query );
		if (mysqli_num_rows ( $result ) > 0) {
			$query2 = "SELECT * FROM USERS WHERE username='$username' and password = '$password'";
			$result2 = mysqli_query ( $this->con, $query2 );
			if (mysqli_num_rows ( $result2 ) > 0) {
				$json ['Success'] = 'Welcome back ' . $username;
				$this->val = 1;//Success
			} else {
				$json ['Error'] = 'Wrong password!';
				$this->val = 0;//Wrong pass
			}
		} else {
			$json ['Error'] = 'User ' . $username . ' does not exist!';
			$this->val = -1;//No user
		}
		mysqli_close ( $this->con );
		echo json_encode ( $json );
	}
}

$user = new User ();

if (! empty ( $username ) && ! empty ( $password )) {
	//$encrypted_password = md5 ( $password );
	$user->lg ( $username, $password );
} else {
	echo json_encode ( "Please fill both fields!" );
}

?>