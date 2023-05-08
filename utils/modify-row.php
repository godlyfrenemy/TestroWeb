<?php
	function modify($tableName, $result, $condition)
	{
		if(is_null($result))
			return;

		$mysql = new mysqli("localhost", "root", "", "u981289406_testro_main");  
	    $mysql->autocommit(true);
	    $query = "UPDATE `" . $tableName . "` SET `" . $result["name"] . "` = '" . $result["value"] . "' WHERE `" . $condition["name"] . "` = '" . $condition["value"] . "';";
	    $mysql->query($query);
	    $mysql->close();
    } 

    modify($_POST['tableName'], $_POST['result'], $_POST['condition']);
?>