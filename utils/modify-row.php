<?php
	function modify($tableName, $result, $condition)
	{
		if(is_null($result))
			return;

		include("db-connection.php");
	    $mysql->query("CALL ModifyRow('" . $tableName . "', '" . $result["name"] . "', '" . $result["value"] . "', '" . $condition["name"] . "', '" . $condition["value"] . "');");
	    $mysql->close();
    } 

    modify($_POST['tableName'], $_POST['result'], $_POST['condition']);
?>