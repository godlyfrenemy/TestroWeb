<?php
session_start();

if(isset($_POST["submit"])){
	$login = $_POST["login"];
	$psw = $_POST["psw"];
	$psw_repeat = $_POST["psw-repeat"];

	if($psw != $psw_repeat){
		header("Location: sign-up-page.php?nomatch=true");
		exit();
	}

	$psw = md5($psw);
	
	$mysql = new mysqli("localhost", "root", "root", "odz");

	$q = "SELECT `id` FROM `users` WHERE `login` = '$login'";
	$result = $mysql->query($q);
	if($result->num_rows != 0){
		header("Location: sign-up-page.php?logintaken=true");
		exit();
	}

	$q = "INSERT INTO `users` (`login`, `pass`) VALUES('$login', '$psw')";
	$mysql->query($q);

	$_SESSION['login'] = $login;
	$_SESSION['rank'] = NULL;

	$mysql->close();

	header("Location: index.php");
}

?>