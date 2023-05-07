<?php
	require_once("header.php");

	if(!isset($_SESSION['login']))
		header("Location: sign-up-page.php");

	if(!isset($_GET['query'])){
		echo "<br><br><center><h1>Будь ласка введіть пошуковий запит</h1></center>";
		exit();
	}
	else{
		echo "<br><br><center><h1>Пошук: ".ucwords($_GET['query'])."</h1></center><br><br>";
	}
?>

<div class="product-items">
	<?php
		$mysql = new mysqli("localhost", "root", "root", "odz");
		$search_query = $_GET['query'];

		$q = "SELECT * FROM `products` WHERE LOWER(`name`) LIKE '%$search_query%'";
		$result = $mysql->query($q);
		if($result->num_rows > 0){
			while($res_assoc = $result->fetch_assoc())
				include("product-item-include.php");
		}
		else
			echo "<h3>За вашим запитом нічого не знайдено</h3>";

		$mysql->close();
	?>
</div>


<?php
	require_once("footer.html");
	include("product-card-include.php");
?>