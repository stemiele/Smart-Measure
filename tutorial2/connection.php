<?php
	require_once 'config.php';
	
	class DB_Connection{
		private $connect;
		function __construct()
		{
			$this->connect = mysqli_connect(hostname,username,password,db_name) or die("DB Connection error");
		}
		public function get_connection()
		{
			return $this->connect;
		}
	}
	
	
?>