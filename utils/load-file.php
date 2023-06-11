<?php
	include("db-connection.php");
	$content = file_get_contents($_FILES['uploadFile']['tmp_name']);
    $query = "UPDATE `questions` SET `image` = '" . $mysql->real_escape_string($content) . "' WHERE `question_id` = '" . $_POST['questionId'] . "'";
    echo $mysql->query($query);
    $mysql->close();
?>