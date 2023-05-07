<?php
	session_start();

    function createTestAnswers($mysql, $questionId) {
        $result = true;
        for($i = 0; $i < 4 && $result == true; $i++)
        {
            $query = "INSERT INTO `answers` (`question_id`) VALUES($questionId);";
            $result &= $mysql->query($query);
        }
        return $result;     
    }

    function createTestQuestion($mysql, $testId) {
        $query = "INSERT INTO `questions` (`test_id`) VALUES($testId);";
        $result = $mysql->query($query);
        return $result ? createTestAnswers($mysql, $mysql->insert_id) : false; 
    }

    $mysql = new mysqli("localhost", "root", "", "u981289406_testro_main");  
    $mysql->autocommit(true);

    $result = createTestQuestion($mysql, $_GET['testId']);
    $mysql->close();

    if($result)
    {
        header("location: /test-page.php?testId=" . $_GET['testId']);
        exit();
    }
?>