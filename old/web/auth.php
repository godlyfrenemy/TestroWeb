<?php
session_start();

if(isset($_POST["submit"])){
	$login = $_POST["login"];
	$psw = $_POST["psw"];
	
	$psw = md5($psw);
	
	$mysql = new mysqli("localhost", "root", "root", "odz");

	$q = "SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$psw'";
	$result = $mysql->query($q);
	if($result->num_rows == 0){
		header("Location: login-page.php?wrong=true");
		exit();
	}

	$user = $result->fetch_assoc();
	$_SESSION['login'] = $user['login'];
	$_SESSION['rank'] = $user['rank'];

	$mysql->close();

	if($_SESSION['rank'] == 1)
		header("Location: admin-panel.php"); //admin panel
	else
		header("Location: index.php");
}

?>