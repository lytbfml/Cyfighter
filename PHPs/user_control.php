<?php
require_once 'dbConnect.php';
$json = file_get_contents('php://input');
$obj = json_decode($json);
$username = $obj->{'username'};
$password = $obj->{'password'};

class User {
	private $db;
	private $connection;
	function __construct() {
		$this->db = new DB_Connection ();
		$this->connection = $this->db->getConnection ();
	}
	public function does_user_exist($username, $password) {
		$query = "SELECT * FROM USERS WHERE username='$username' and password = '$password'";
		$result = mysqli_query ( $this->connection, $query );
		if (mysqli_num_rows($result)>0) {
			$json['Success'] = ' Welcome back '.$username;
				echo json_encode($json);
				mysqli_close($this -> connection);
		} else {
			$query = "Insert into USERS(usertype, username, password) VALUES('3', '$username', '$password')";
			$inserted = mysqli_query ( $this->connection, $query );
			if ($inserted == 1) {
				$json ['Success'] = ' Account created, welcome ' . $username;
			} else {
				$json ['error'] = ' Wrong password ';
			}
			
			echo json_encode ( $json );
			mysqli_close ( $this->connection );
		}
	}
}

$user = new User ();

	if (! empty ( $username ) && ! empty ( $password )) {
		$encrypted_password = md5 ( $password );
		$user->does_user_exist ($username, $password );
	} else {
		echo json_encode ( "You must fill both fields" );
	}

?>