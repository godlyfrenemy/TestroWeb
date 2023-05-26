<?php
	function delete($tableName, $condition)
	{
		$mysql = new mysqli("localhost", "root", "", "testro_db");  
	    $mysql->autocommit(true);
	    $query = "DELETE FROM `" . $tableName . "` WHERE `" . $condition["name"] . "` = '" . $condition["value"] . "';";
	    $mysql->query($query);
	    $mysql->close();
    } 

    delete($_POST['tableName'], $_POST['condition']);
?>