<?php
	require_once("header.php");
?>

<script type="text/javascript">
	function check_pass(input)
	{
		let pattern = new RegExp("^(?=(.*[a-zA-Z]){1,})(?=(.*[0-9]){2,}).{8,}$"); //Regex: At least 8 characters with at least 2 numericals // Add event listener on input
		if(!pattern.test(document.getElementById("psw").value)) 
		{
			alert("Пароль має містити 8 символів та 2 цифри");
			return false;
		}
		return true;
	}
</script>


<form id="register-form" action="adduser.php" onsubmit="return check_pass()" method="post">
	<h1>Реєстрація</h1>
	<p>Будь ласка, заповніть цю форму, щоб створити новий акаунт</p>
	<?php
	if(isset($_GET["nomatch"]) && $_GET["nomatch"])
		echo "<i><p style=\"color: red\">Паролі не збігаються</p></i>";

	if(isset($_GET["logintaken"]) && $_GET["logintaken"])
		echo "<i><p style=\"color: red\">Користувач з таким логіном вже існує</p></i>";
	?>
	<hr>

	<label for="login"><b>Логін</b></label>
	<input type="text" minlength="4" maxlength="35" placeholder="Введіть ваш логін" name="login" id="login" required>

	<label for="psw"><b>Пароль</b></label>
	<input type="password" minlength="4" maxlength="20" placeholder="Введіть ваш пароль" name="psw" id="psw" required>

	<label for="psw-repeat"><b>Підтвердження пароля</b></label>
	<input type="password" minlength="4" maxlength="20" placeholder="Підтвердіть пароль" name="psw-repeat" id="psw-repeat" required>

	<button type="submit" name="submit">Зареєстуватися</button>

	<div>
		<center><p>Вже зареєстровані? <a href="login-page.php">Увійти</a></p></center>
	</div>
</form> 


<?php
	require_once("footer.html");
?>