<?php
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();

    function createTest($mysql) {
        $query = "INSERT INTO `tests_data` () VALUES();";
        $result = $mysql->query($query);

        $query = "INSERT INTO `tests` (`test_data_id`) VALUES ('" . $mysql->insert_id . "');";
        $result &= $mysql->query($query);

        $testId = $mysql->insert_id;
        $query = "INSERT INTO `teacher_tests` (`teacher_id`, `test_id`) 
                  VALUES ('" . $_SESSION['user_id'] . "', '" . $testId . "');";
        $result &= $mysql->query($query);

        return $testId; 
    }

    $mysql = new mysqli("localhost", "root", "", "testro_db");  
    $mysql->autocommit(true);

    echo createTest($mysql);
    $mysql->close();
?>