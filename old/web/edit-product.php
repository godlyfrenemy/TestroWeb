<?php

if(isset($_POST["submit"])){
	$name = $_POST["name"];
	$description = $_POST["description"];
	$category = $_POST["category"];
	$os = $_POST["os"];
	$company = $_POST["company"];
	$id = $_POST["id"];

	$forsale = 0;
	if(isset($_POST["forsale"]))
		$forsale = $_POST["forsale"];

	$new_img_name = '';
	if(isset($_FILES["img-file"])){
		$img_name = $_FILES["img-file"]["name"];
		$tmp_name = $_FILES["img-file"]["tmp_name"];
		$error = $_FILES["img-file"]["error"];

		if($error === 0){
			$img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ext = strtolower($img_ext);
			$new_img_name = uniqid("IMG-", true).'.'.$img_ext;
			$img_upload_path = "uploads/".$new_img_name;
			move_uploaded_file($tmp_name, $img_upload_path);
		}
	}

	$mysql = new mysqli("localhost", "root", "root", "odz");
	$q = "UPDATE `products` SET `name` = '$name', `description` = '$description', `category` = '$category', 
	`os` = '$os', `company` = '$company', `forsale` = '$forsale'";

	if($new_img_name !== '')
		$q .= ", `image_url` = '$new_img_name'";

	$q .= " WHERE `id` = '$id'";
		
	$mysql->query($q);

	$mysql->close();

	header("Location: admin-panel.php");
}

?>