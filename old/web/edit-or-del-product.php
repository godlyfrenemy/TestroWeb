<?php
	require_once("header.php");
?>

<?php
	if(isset($_POST["submit"])){
		$mysql = new mysqli("localhost", "root", "root", "odz");

		if(strpos($_POST["submit"], "del-") === 0){
		 	$c = str_replace("del-", "", $_POST["submit"]);
		 	$q = "DELETE FROM `products` WHERE `id` = '$c'";

		 	$mysql->query($q);
		 	$mysql->close();
		 	
		 	header("Location: admin-panel.php");
		}
		else if(strpos($_POST["submit"], "edit-") === 0){
			$c = str_replace("edit-", "", $_POST["submit"]);
			$q = "SELECT * FROM `products` WHERE `id` = '$c'";

			$result = $mysql->query($q);

			if($result->num_rows > 0){
				$res_assoc = $result->fetch_assoc();?>

				<form action="edit-product.php" method="post" enctype="multipart/form-data" class="addproduct-form">

				<input name="id" value="<?=$res_assoc['id']?>" hidden>

				<input type="text" minlength="4" maxlength="40" name="name" value="<?=$res_assoc['name']?>" required>
				
				<input type="text" minlength="4" name="description" value="<?=$res_assoc['description']?>" required>
				
				<input type="text" minlength="4" maxlength="40" name="category" value="<?=$res_assoc['category']?>" required>
				
				<input type="text" minlength="3" maxlength="40" name="os" value="<?=$res_assoc['os']?>" required>
				
				<input type="text" minlength="4" maxlength="40" name="company" value="<?=$res_assoc['company']?>" required>
				
				<label for="forsale">Товар зі знижкою&nbsp</label>
				<input type="checkbox" name="forsale" id="forsale" value="1" 
				<?php if($res_assoc['forsale']) echo 'checked';?>>
				<br><br>

				<input type="file" name="img-file" id="img-file" accept="image/*">
				
				<button type="submit" name="submit">Змінити</button>

				</form>

			<?php
			}
		}

		$mysql->close();
	}
?>

<?php
	require_once("footer.html");
?>