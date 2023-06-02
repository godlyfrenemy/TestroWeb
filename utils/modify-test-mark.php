<?php
    session_start();

    function modifyTestTime($mysql, $testDataValue) {
        $query = "UPDATE `tests` SET `test_mark` = " . $testDataValue . " WHERE `test_id` = " . $_GET['testId'];
        mysqli_next_result($mysql);
        return $mysql->query($query);
    }

    $mysql = new mysqli("localhost", "root", "", "testro_db");  
    $mysql->autocommit(true);

    modifyTestTime($mysql, $_POST['test-mark']);

    $mysql->close();
    header("location: /test-page.php?testId=" . $_GET['testId']);
    exit();
?>