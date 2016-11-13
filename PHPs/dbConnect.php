<?php
require_once 'config.php';
class DB_connection {
	private $con;
	function __construct()
	{
		$this->con = mysqli_connect ( hostname, username, password, db_name ) or die ( "DB connection error" );
	}
	public function getConnection() {
		return $this->con;
	}
}
?>