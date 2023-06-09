<?php

function userWithLoginExists($mysql, $login) {
	$query = "CALL GetTeacherUserByLogin('" . $login . "');";
	$result = $mysql->query($query);
	return $result->num_rows != 0;
}

function insertNewUserAndGetId($mysql, $login, $password, $fullname){
	mysqli_next_result($mysql);
	$query = "CALL AddNewUser('" . $fullname . "', '" . $login . "', '" . $password . "');";
	return $mysql->query($query)->fetch_assoc()['id'];
}

session_start();

if(isset($_POST["sign-up-submit"])){
	$login = $_POST["sign-up-login"];
	$password = md5($_POST["sign-up-password"]);
	$teacherFullName = $_POST["sign-up-fullname"];

	$mysql = new mysqli("localhost", "root", "", "testro_db");

	if(userWithLoginExists($mysql, $login))
		header("location: ../cabinet-login.php?userExists=true");
	else{
		$_SESSION['user_id'] = insertNewUserAndGetId($mysql, $login, $password, $teacherFullName);
		header("location: ../cabinet.php");
	} 	
	
	$mysql->close();
	exit();
}

?>