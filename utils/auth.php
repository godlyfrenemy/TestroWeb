<?php
	function userWithLoginExists($login) {
		include("db-connection.php");
		$result = $mysql->query("CALL GetTeacherUserByLogin('" . $login . "');");
		return $result->num_rows != 0;
	}

	function getUserIdIfExists($login, $password){
		include("db-connection.php");
		$result = $mysql->query("CALL GetTeacherUserByLoginAndPass('" . $login . "', '" . $password . "');");
		return $result->num_rows != 0 ? $result->fetch_assoc()['teacher_id'] : -1;
	}

	session_start();

	if(isset($_POST["auth-submit"])){
		$login = $_POST["auth-login"];
		$password = md5($_POST["auth-password"]);

		if(userWithLoginExists($login)) {
			$userId = getUserIdIfExists($login, $password);

			if($userId != -1) {
				$_SESSION['user_id'] = $userId;
				header("location: ../cabinet-login.php");
			}	
			else 
				header("location: ../cabinet-login.php?isWrongPassword=true");
		}
		else 
			header("location: ../cabinet-login.php?isWrongLogin=true");
		
		exit();

	}

?>