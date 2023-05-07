<?php
	require_once("header.php");
?>

<br><br>
<center>
	<h1>Welcome to найкращий магазин ліцензійного ПЗ*</h1>
	<p>*ну майже найкращий</p>
</center>

<br><br>
<br><h2 align="center">Новинки</h2><br>
<div class="catalogue-container">
	<div class="catalogue-items">
		<?php
			$mysql = new mysqli("localhost", "root", "root", "odz");

			$q = "SELECT * FROM `products` ORDER BY `id` DESC LIMIT 10";
			$result = $mysql->query($q);
			if($result->num_rows > 0){
				while($res_assoc = $result->fetch_assoc())
					include("product-item-include.php");
			}

			$mysql->close();
		?>
	</div>
	<button class="catalogue-left" onclick="catalogue_scroll(this, -2)">&#8249;</button>
	<button class="catalogue-right" onclick="catalogue_scroll(this, 2)">&#8250;</button>
</div>

<br><br>
<br><h2 align="center">Продукти</h2><br>
<div class="tiles">
	<div class="tile" style="flex: 1; background-image: url('img/photoshop.jpg');">
		<a href="search-page.php?query=Photoshop">
			<h2>Photoshop</h2>
			<br>
			<p>Яскраві зображення, насичена графіка та дивовижна майстерність — все це можливо разом з Photoshop</p>
		</a>
	</div>

	<div class="tile" style="flex: 1; background-image: url('img/adobe-express.jpg');">
		<a href="search-page.php?query=Adobe Express">
			<h2>Adobe Express</h2>
			<br>
			<p>Швидко створюйте приголомшливий контент. Тепер кожен, хто має ідею, може її висловити</p>
		</a>
	</div>

	<div class="tile" style="flex: 1; background-image: url('img/final-cut.jpg'); color: #f5f5f7;">
		<a href="search-page.php?query=Final Cut Pro">
			<h2>Final Cut Pro</h2>
			<br>
			<p>Розкажіть світові свою історію</p>
		</a>
	</div>
</div>
<div class="tiles">
	<div class="tile" style="flex: 3;  background-image: url('img/davinci.jpg'); color: #f5f5f7;">
		<a href="search-page.php?query=DaVinci Resolve">
			<h2>DaVinci Resolve</h2>
			<br>
			<p>Монтаж, корекція кольору, накладання ефектів, створення графіки та постобробка звуку в єдиному додатку</p>
		</a>
	</div>

	<div class="tile" style="flex: 1; background-image: url('img/procreate.jpg'); color: #f5f5f7;">
		<a href="search-page.php?query=Procreate">
			<h2>Procreate</h2>
			<br>
			<p>Найпотужніший додаток для стврорення цифрових ілюстрацій</p>
		</a>
	</div>
</div>

<?php
	require_once("footer.html");
?>