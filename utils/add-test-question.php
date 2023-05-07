<?php
	session_start();
    function addTest($mysql, $testId) {
        $query = "INSERT INTO `questions` (`test_id`) VALUES($testId);";
        $result = $mysql->query($query);
        return $result->affected_rows > 0;     
    }

    $mysql = new mysqli("localhost", "root", "", "u981289406_testro_main");  
    $mysql->autocommit(true);

    addTest($mysql, $_GET['testId']);
    $mysql->close();
    header("location: /test-page.php?testId=" . $_GET['testId']);
    exit();
?>