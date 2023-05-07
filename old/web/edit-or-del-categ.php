<?php
	require_once("header.php");
?>

<?php
	if(isset($_POST["submit"])){
		$mysql = new mysqli("localhost", "root", "root", "odz");

		if(strpos($_POST["submit"], "del-") === 0){
			$c = str_replace("del-", "", $_POST["submit"]);
			$q = "DELETE FROM `products` WHERE `category` = '$c'";

			$mysql->query($q);
			$mysql->close();
			
			header("Location: admin-panel.php");
		}
		else if(strpos($_POST["submit"], "edit-") === 0){
			$c = str_replace("edit-", "", $_POST["submit"]);
			$q = "SELECT * FROM `products` WHERE `category` = '$c'";

			$result = $mysql->query($q);

			if($result->num_rows > 0){
				echo "<form action='edit-or-del-product.php' method='post'><table class='categ-table'>";

				while($res_assoc = $result->fetch_assoc()){
					echo "<tr>";
					
					echo "<td>".$res_assoc['id']."</td>";
					echo "<td>".$res_assoc['name']."</td>";
					echo "<td>".$res_assoc['description']."</td>";
					echo "<td>".$res_assoc['category']."</td>";
					echo "<td>".$res_assoc['os']."</td>";
					echo "<td>".$res_assoc['company']."</td>";
					echo "<td>".$res_assoc['forsale']."</td>";
					echo "<td><img src='uploads/".$res_assoc['image_url']."' width='80'></td>";

					echo "<td><button type='submit' name='submit' style='background: #17a2b8'
					 value='edit-".$res_assoc['id']."'>Редагувати</button></td>";
					echo "<td><button type='submit' name='submit' style='background: #dc3545'
					 value='del-".$res_assoc['id']."' onclick='return confirm(\"Точно?\");'>Видалити</button></td>";

					echo "</tr>";
				}

				echo "</table></form>";
			}
		}

		$mysql->close();
	}
?>

<?php
	require_once("footer.html");
?>