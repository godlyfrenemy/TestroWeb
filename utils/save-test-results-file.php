<?php
	session_start();
	$mysql = new mysqli("localhost", "root", "", "testro_db");
    $mysql->autocommit(true);
    $filename = "{$_SERVER['DOCUMENT_ROOT']}/tmp/{$_SESSION['user_id']}_" . time() . ".csv";
    $query = "CALL SaveTestResultsFile('" . $_POST['test-id'] . "', '" . $filename . "');";

    if($mysql->query($query))
   		echo json_encode(array('data' => file_get_contents($filename), 'filename' => $filename));
   	else
   		echo json_encode(array('data' => "", 'filename' => ""));
   	
   	unlink($filename);
?>