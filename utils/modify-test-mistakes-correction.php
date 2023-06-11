<?php
    session_start();
    function getTestInfo() {
        include("db-connection.php");
        $result = $mysql->query("CALL GetTestInfo(" . $_GET['testId'] . ");");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    function modifyTestMistakesCorrection($testDataValue) {
        $testInfo = getTestInfo();
        $testDataId = !is_null($testInfo) && !empty($testInfo) ? $testInfo['test_data_id'] : -1;
        include("db-connection.php");
        return $mysql->query("CALL ModifyRow('tests_data', 'test_mistakes_correction', '" . $testDataValue . "', 'test_data_id', '" . $testDataId . "');");
    }

    modifyTestMistakesCorrection($_POST['mistakes-correction']);
    header("location: /test-page.php?testId=" . $_GET['testId']);
    exit();
?>