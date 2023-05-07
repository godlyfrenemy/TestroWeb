<?php
	require_once("header.php");
?>


<form id="register-form" action="auth.php" method="post">
	<h1>Авторизація</h1>
	<?php
	if(isset($_GET["wrong"]) && $_GET["wrong"])
		echo "<i><p style=\"color: red\">Невірний логін або пароль</p></i>";
	?>
	<hr>

	<label for="login"><b>Логін</b></label>
	<input type="text" minlength="4" maxlength="35" placeholder="Введіть ваш логін" name="login" id="login" required>

	<label for="psw"><b>Пароль</b></label>
	<input type="password" minlength="4" maxlength="20" placeholder="Введіть ваш пароль" name="psw" id="psw" required>

	<button type="submit" name="submit">Увійти</button>

	<div>
		<center><p>Ще не зареєстровані? <a href="sign-up-page.php">Зареєстуватися</a></p></center>
	</div>
</form> 


<?php
	require_once("footer.html");
?>