<?php
	function modify($tableName, $result, $condition)
	{
		if(is_null($result))
			return;

		$mysql = new mysqli("localhost", "root", "", "testro_db");  
	    $mysql->autocommit(true);
	    $query = "CALL ModifyRow('" . $tableName . "', '" . $result["name"] . "', '" . $result["value"] . "', '" . $condition["name"] . "', '" . $condition["value"] . "');";
	    $mysql->query($query);
	    $mysql->close();
    } 

    modify($_POST['tableName'], $_POST['result'], $_POST['condition']);
?>