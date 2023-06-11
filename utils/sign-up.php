<?php

function userWithLoginExists($login) {
	include("db-connection.php");
	$result = $mysql->query("CALL GetTeacherUserByLogin('" . $login . "');");
	return $result->num_rows != 0;
}

function insertNewUserAndGetId($login, $password, $fullname){
	include("db-connection.php");
	$query = "CALL AddNewUser('" . $fullname . "', '" . $login . "', '" . $password . "');";
	return $mysql->query($query)->fetch_assoc()['id'];
}

session_start();

if(isset($_POST["sign-up-submit"])){
	$login = $_POST["sign-up-login"];
	$password = md5($_POST["sign-up-password"]);
	$teacherFullName = $_POST["sign-up-fullname"];

	if(userWithLoginExists($login))
		header("location: ../cabinet-login.php?userExists=true");
	else{
		$_SESSION['user_id'] = insertNewUserAndGetId($login, $password, $teacherFullName);
		header("location: ../cabinet.php");
	} 	
	
	exit();
}

?>