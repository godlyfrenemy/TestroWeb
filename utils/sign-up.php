<?php

function userWithLoginExists($mysql, $login) {
	$query = "SELECT * FROM `teacher_users` WHERE `teacher_login` = '" . $login . "';";
	$result = $mysql->query($query);
	return $result->num_rows != 0;
}

function insertNewUserAndGetId($mysql, $login, $password, $fullname){
	$query = "INSERT INTO `teacher_data` (`teacher_full_name`) VALUES('" . $fullname . "');";
	$mysql->query($query);
	$query = "INSERT INTO `teacher_users` (`teacher_login`, `teacher_password`, `teacher_data_id`) VALUES('" . $login . "', '" . $password . "', '" . $mysql->insert_id . "');";
	$mysql->query($query);
	return $mysql->insert_id;
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