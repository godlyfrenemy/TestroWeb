<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="img/25.png" rel="icon">
	<script type="text/javascript" src="script.js"></script>
	<title>Mellifluous</title>
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a id="logo" href="index.php"><img src="img/25.png">Mellifluous</a></li>
				<li class="dd-category">
					<a>Категорії +</a>
					<div class="dd-category-content">
					<?php

						$mysql = new mysqli("localhost", "root", "root", "odz");

						$q = "SELECT DISTINCT `category` FROM `products`";
						$result = $mysql->query($q);
						if($result->num_rows > 0){
							while($res_assoc = $result->fetch_assoc())
								echo "<a href='category-page.php?query=".$res_assoc['category']."'>".$res_assoc['category']."</a>";
						}

						$mysql->close();

					?>
					</div>
				</li>

				<li><a href="catalogue.php">Каталог</a></li>
				<li><a href="about.php">Про нас</a></li>

				<?php
					if(isset($_SESSION['login'])){
						echo "<li><a><img height=20 onclick=\"opensearch()\" src=\"img/search-icon.png\"></a></li>";
						echo "<li><a href=\"exit-session.php\">Вийти</a></li>";
					}
					else
						echo "<li><a href=\"sign-up-page.php\">Sign up / Login</a></li>";
				?>
			</ul>
		</nav>
	</header>

	<main>