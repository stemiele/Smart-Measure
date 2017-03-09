<?php
	require_once 'connection.php';
	header ('Content-Type: application/json ');
	class User {
		private $db;
		private $connection;
		
		function __construct() 
		{
				$this->db= new DB_Connection();
				$this->connection= $this->db->get_connection();
		}
		
		public function does_user_exist($email,$password)
		{
			$query = "Select * from users where email='$email' and password='$password'";
			$result = mysqli_query($this->connection,$query);
			if(mysqli_num_rows($result)>0)
			{
				$json['success'] = ' Welcome '.$email;
				echo json_encode($json);
				mysqli_close($this->connection);
			}
			else
			{
				$query="Insert into users(email,password) values ('$email','$password')";
				$is_inserted = mysqli_query($this->connection,$query);
				if ($is_inserted == 1)
				{
					$json['success']='Account created,welcome '.$email;
				}
				else
				{
					json['error']= 'Wrong password' ;
				}
				
				echo json_encode($json);
				mysqli_close($this->connection);
			}
		}
	}
	
	$user = new User();
	if(isset($_POST['email'],$_POST['password']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		if(!empty($email) && !empty($password))
		{
			$encrypted_password = md5($password);
			$user -> does_user_exist($email,$encrypted_password);
		}
		else
		{
			echo json_encode("You must fill both fields! ");
		}
	}

?>