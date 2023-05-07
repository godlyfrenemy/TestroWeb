<?php

function userWithLoginExists($mysql, $login) {
	$query = "SELECT * FROM `teacher_users` WHERE `teacher_login` = '$login'";
	$result = $mysql->query($query);
	return $result->num_rows != 0;
}

function insertNewUserAndGetId($mysql, $login, $password){
	$query = "INSERT INTO `teacher_users` (`teacher_login`, `teacher_password`) VALUES('$login', '$password')";
	$mysql->query($query);
	return $mysql->insert_id;
}

session_start();

if(isset($_POST["sign-up-submit"])){
	$login = $_POST["sign-up-login"];
	$password = md5($_POST["sign-up-password"]);

	$mysql = new mysqli("localhost", "root", "", "u981289406_testro_main");

	if(userWithLoginExists($mysql, $login))
		header("location: ../cabinet-login.php?userExists=true");
	else{
		$_SESSION['user_id'] = insertNewUserAndGetId($mysql, $login, $password);
		header("location: ../cabinet.php");
	} 	
	
	$mysql->close();
	exit();
}

?>