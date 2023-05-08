<?php
	session_start();
    function getTestInfo($mysql) {
        $query = "CALL getTestInfo(" . $_GET['testId'] . ", " . $_SESSION['user_id'] . ");";
        $result = $mysql->query($query);
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;      
    }

    function modifyQuestionData($mysql, $questionName, $answers) {
        $testInfo = getTestInfo($mysql);
        $testDataId = !is_null($testInfo) && !empty($testInfo) ? $testInfo['test_data_id'] : -1;
        $query = "UPDATE `test_data` SET `test_time_constraint` = " . $testDataValue . " WHERE `test_data_id` = " . $testDataId;
        mysqli_next_result($mysql);
        return $mysql->query($query);
    }

    $mysql = new mysqli("localhost", "root", "", "u981289406_testro_main");  
    $mysql->autocommit(true);

    $answers = array();
    for($i = 0; $i < 4; $i++)
    	$answers[] = $_POST['answer-name-' . $i ];

    modifyQuestionData($mysql, $_POST['question-name'], $answers);

    $mysql->close();
    header("location: /test-page.php?testId=" . $_GET['testId']);
    exit();
?>