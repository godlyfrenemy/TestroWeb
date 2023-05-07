<?php
	require_once("header.php");

	if(!isset($_SESSION['login']))
		header("Location: sign-up-page.php");
	else{
		if($_SESSION['rank'] != '1')
			header("Location: index.php");
	}
?>

<br><br>
<center>
	<h1>Адмін панель</h1>
</center>
<br><br>

<div class="admin-panel-tabs">
	<button onclick="change_adm_panel_tab(0)" style="background: #ddd">Інформація</button>
	<button onclick="change_adm_panel_tab(1)">Додати товар</button>
	<button onclick="change_adm_panel_tab(2)">Категорії</button>
</div>

<div class="admin-panel-welc">
	<b>Вітаємо на адмін панелі!</b><br><br><hr><br>

	Щоб додати товар перейдіть на вкладку Додати товар.<br><br>
	Щоб відредагувати або видалити категорію перейдіть на вкладку Категорії.<br><br>
	Щоб додати нову категорію введіть її назву при доданні нового товару.
</div>

<form action="addproduct.php" method="post" enctype="multipart/form-data" class="addproduct-form" style="display:none">

	<label for="name"><b>Назва</b></label>
	<input type="text" minlength="4" maxlength="40" placeholder="Введіть назву" name="name" id="name" required>
	
	<label for="description"><b>Опис</b></label>
	<input type="text" minlength="4" placeholder="Введіть опис" name="description" id="description" required>
	
	<label for="category"><b>Категорія</b></label>
	<input list="categories" type="text" minlength="4" maxlength="40" placeholder="Оберіть категорію, або введіть нову" name="category" id="category" required>
	<datalist id="categories">
		<?php
			$mysql = new mysqli("localhost", "root", "root", "odz");

			$q = "SELECT DISTINCT `category` FROM `products`";
			$result = $mysql->query($q);
			if($result->num_rows > 0){
				while($res_assoc = $result->fetch_assoc())
					echo "<option value='".$res_assoc['category']."'></option>";
			}

			//$mysql->close();
		?>
	</datalist>
	
	<label for="os"><b>Операційні системи</b></label>
	<input type="text" minlength="3" maxlength="40" placeholder="Введіть ОС" name="os" id="os" required>
	
	<label for="company"><b>Компанія</b></label>
	<input type="text" minlength="4" maxlength="40" placeholder="Введіть компанію" name="company" id="company" required>
	
	<label for="forsale"><b>Товар зі знижкою&nbsp</b></label>
	<input type="checkbox" name="forsale" id="forsale" value="1">
	<br><br>

	<label for="img-file"><b>Картинка&nbsp</b></label>
	<input type="file" name="img-file" id="img-file" accept="image/*" required>
	
	<button type="submit" name="submit">Додати</button>
</form>

<form action="edit-or-del-categ.php" method="post" style="display:none">
<table class="categ-table">
	
	<?php
		//$mysql = new mysqli("localhost", "root", "root", "odz");

		$q = "SELECT DISTINCT `category` FROM `products`";
		$result = $mysql->query($q);
		if($result->num_rows > 0){
			while($res_assoc = $result->fetch_assoc()){
				echo "<tr>";
				echo "<td style='width: 70%;'>".$res_assoc['category']."</td>";
				echo "<td><button type='submit' name='submit' style='background: #17a2b8'
				 value='edit-".$res_assoc['category']."'>Редагувати</button></td>";
				echo "<td><button type='submit' name='submit' style='background: #dc3545'
				 value='del-".$res_assoc['category']."' onclick='return confirm(\"Точно?\");'>Видалити</button></td>";
				echo "</tr>";
			}
		}

		$mysql->close();
	?>

</table>
</form>

<?php
	require_once("footer.html");
?>