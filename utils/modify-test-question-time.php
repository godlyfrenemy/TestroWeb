<?php
    session_start();
    function getTestInfo() {
        include("db-connection.php");
        $result = $mysql->query("CALL GetTestInfo(" . $_GET['testId'] . ");");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;      
    }

    function modifyTestTime($testDataValue) {
        $testInfo = getTestInfo();
        $testDataId = !is_null($testInfo) && !empty($testInfo) ? $testInfo['test_data_id'] : -1;
        include("db-connection.php");
        return $mysql->query("CALL ModifyTestData('test_question_time_constraint', '" . $testDataValue . "', '" . $testDataId . "');");
    }

    modifyTestTime($_POST['question-time-constraint']);
    header("location: /test-page.php?testId=" . $_GET['testId']);
    exit();
?>