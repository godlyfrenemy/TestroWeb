<?php
	function delete($tableName, $condition)
	{
		$mysql = new mysqli("localhost", "root", "", "u981289406_testro_main");  
	    $mysql->autocommit(true);
	    $query = "DELETE FROM `" . $tableName . "` WHERE `" . $condition["name"] . "` = '" . $condition["value"] . "';";
	    $mysql->query($query);
	    $mysql->close();
    } 

    delete($_POST['tableName'], $_POST['condition']);
?>