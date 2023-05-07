<?php
	require_once("header.php");

	if(!isset($_SESSION['login']))
		header("Location: sign-up-page.php");
?>

<br>
<h2>Новинки</h2>
<br>
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
	<button class="catalogue-left" onclick="catalogue_scroll(this, -1)">&#8249;</button>
	<button class="catalogue-right" onclick="catalogue_scroll(this, 1)">&#8250;</button>
</div>

<br>
<h2>Акції</h2>
<br>
<div class="catalogue-container">
	<div class="catalogue-items">
		<?php
			$mysql = new mysqli("localhost", "root", "root", "odz");

			$q = "SELECT * FROM `products` WHERE `forsale` = 1";
			$result = $mysql->query($q);
			if($result->num_rows > 0){
				while($res_assoc = $result->fetch_assoc())
					include("product-item-include.php");
			}

			$mysql->close();
		?>
	</div>
	<button class="catalogue-left" onclick="catalogue_scroll(this, -1)">&#8249;</button>
	<button class="catalogue-right" onclick="catalogue_scroll(this, 1)">&#8250;</button>
</div>

<?php
	require_once("footer.html");
	include("product-card-include.php");
?>