<?php
session_start();

if(isset($_POST["auth-submit"])){
	$login = $_POST["auth-login"];
	$psw = md5($_POST["auth-password"]);
	
	$mysql = new mysqli("localhost", "root", "", "testro_db");

	$query = "SELECT * FROM `teacher_users` WHERE `teacher_login` = '$login' AND `teacher_password` = '$psw'";
	$result = $mysql->query($query);

	if($result->num_rows != 0) {
		$user = $result->fetch_assoc();
		$_SESSION['user_id'] = $user['teacher_id'];
		$mysql->close();
		echo "found";
	}
	else {
		echo "wtf";
	}
}

?>