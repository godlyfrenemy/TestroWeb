<?php
session_start();

if(isset($_POST["sign-up-submit"])){
	$login = $_POST["sign-up-login"];
	$psw = md5($_POST["sign-up-password"]);

	$mysql = new mysqli("localhost", "root", "", "u981289406_testro_main");

	$q = "SELECT * FROM `teacher_users` WHERE `teacher_login` = '$login'";
	$result = $mysql->query($q);

	if($result->num_rows == 0){
		$q = "INSERT INTO `teacher_users` (`teacher_login`, `teacher_password`) VALUES('$login', '$psw')";
		$mysql->query($q);

		$_SESSION['user_id'] = $mysql->insert_id;
		echo "inserted" . $mysql->insert_id;
		echo $_SESSION['user_id'];

		$mysql->close();
	}
	else
	{
		echo "login is taken";
	}
}

?>