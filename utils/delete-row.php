<?php
	function delete($tableName, $condition)
	{
		include("db-connection.php");
	    $mysql->query("CALL DeleteRow('" . $tableName . "', '" . $condition["name"] . "', '" . $condition["value"] . "');");
	    $mysql->close();
    } 

    delete($_POST['tableName'], $_POST['condition']);
?>