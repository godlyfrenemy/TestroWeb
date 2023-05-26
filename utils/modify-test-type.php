<?php
    session_start();
    function getTestInfo($mysql) {
        $query = "CALL GetTestInfo(" . $_GET['testId'] . ", " . $_SESSION['user_id'] . ");";       
        mysqli_next_result($mysql);
        $result = $mysql->query($query);
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;      
    }

    function modifyTestTime($mysql, $testDataValue) {
        $testInfo = getTestInfo($mysql);
        $testDataId = !is_null($testInfo) && !empty($testInfo) ? $testInfo['test_data_id'] : -1;
        $query = "UPDATE `tests_data` SET `test_type_constraint_id` = " . $testDataValue . " WHERE `test_data_id` = " . $testDataId;
        mysqli_next_result($mysql);
        return $mysql->query($query);
    }

    $mysql = new mysqli("localhost", "root", "", "testro_db");  
    $mysql->autocommit(true);

    modifyTestTime($mysql, $_POST['type-constraint']);

    $mysql->close();
    header("location: /test-page.php?testId=" . $_GET['testId']);
    exit();
?>