<?php
	function delete($tableName, $condition)
	{
		$mysql = new mysqli("localhost", "root", "", "testro_db");  
	    $mysql->autocommit(true);
	    $mysql->query("CALL DeleteRow('" . $tableName . "', '" . $condition["name"] . "', '" . $condition["value"] . "');");
	    $mysql->close();
    } 

    delete($_POST['tableName'], $_POST['condition']);
?>