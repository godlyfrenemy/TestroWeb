<?php
	require_once("header.php");

	if(!isset($_SESSION['login']))
		header("Location: sign-up-page.php");

	if(!isset($_GET['query'])){
		echo "<br><br><center><h1>Категорія не обрана</h1></center>";
		exit();
	}
	else{
		echo "<br><br><center><h1>".$_GET['query']."</h1></center><br><br>";
		$mysql = new mysqli("localhost", "root", "root", "odz");
?>

<form action="category-page.php?query=<?=$_GET['query']?>" method="post" class="filter-form">
	<center><h2 onclick="show_filters()"><img src="img/filter-icon.png"> Фільтри</h2></center>
	<hr>

	<div>
		<h3>Компанія</h3>
		<?php
			$q = "SELECT DISTINCT `company` FROM `products`";
			$result = $mysql->query($q);
			if($result->num_rows > 0){
				while($res_assoc = $result->fetch_assoc()){
					echo "<input type='checkbox' name='company[]' 
					value='".$res_assoc['company']."' id='cat-cb-".$res_assoc['company']."'>";
					echo "<label for='cat-cb-".$res_assoc['company']."'> ".$res_assoc['company']."</label><br>";
				}
			}
		?>
		<br>

		<h3>Акційний товар</h3>
		<input type="checkbox" name="forsale" id="cat-cb-fs" value="1"><label for="cat-cb-fs"> Так</label><br>
		<br>

		<h3>Операційна система</h3>
		<input type="checkbox" name="os[]" id="cat-cb-win" value="Windows"><label for="cat-cb-win"> Windows</label><br>
		<input type="checkbox" name="os[]" id="cat-cb-mac" value="macOS"><label for="cat-cb-mac"> macOS</label><br>
		<input type="checkbox" name="os[]" id="cat-cb-andr" value="Android"><label for="cat-cb-andr"> Android</label><br>
		<input type="checkbox" name="os[]" id="cat-cb-ios" value="iOS"><label for="cat-cb-ios"> iOS</label><br>
		<input type="checkbox" name="os[]" id="cat-cb-linux" value="Linux"><label for="cat-cb-linux"> Linux</label><br>
		<br>

		<center><button type="submit" name="submit">ОК</button></center>
	</div>
</form>

<?php
	}
?>

<div class="product-items">
	<?php
		$search_query = $_GET['query'];

		$q = array("SELECT * FROM `products` WHERE `category` = '$search_query'");

		if(isset($_POST['submit'])){
			if(isset($_POST['company'])){
				foreach($_POST['company'] as &$c)
					$c = "'".$c."'";
				$qc = "`company` IN (".implode(", ", $_POST['company']).")";
				array_push($q, $qc);
			}

			if(isset($_POST['forsale'])){
				$qf = "`forsale` = 1";
				array_push($q, $qf);
			}

			if(isset($_POST['os'])){
				$qo = "`os` REGEXP '".implode("|", $_POST['os'])."'";
				array_push($q, $qo);
			}
		}

		$q = implode(' AND ', $q);

		$result = $mysql->query($q);

		if($result->num_rows > 0){
			while($res_assoc = $result->fetch_assoc())
				include("product-item-include.php");
		}
		else
			echo "<h3>На жаль, нічого не знайдено(</h3>";

		$mysql->close();
	?>
</div>


<?php
	require_once("footer.html");
	include("product-card-include.php");
?>