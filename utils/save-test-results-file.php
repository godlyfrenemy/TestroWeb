<?php
	session_start();
	include("db-connection.php");
    $filename = "{$_SERVER['DOCUMENT_ROOT']}/tmp/{$_SESSION['user_id']}_" . time() . ".csv";

    if($mysql->query("CALL SaveTestResultsFile('" . $_POST['test-id'] . "', '" . $filename . "');"))
   		echo json_encode(array('data' => file_get_contents($filename), 'filename' => $filename));
   	else
   		echo json_encode(array('data' => "", 'filename' => ""));
   	
   	unlink($filename);
?>