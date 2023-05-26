<?php
	session_start();

    function createQuestionAnswers($mysql, $questionId) {
        $result = true;
        for($i = 0; $i < 4 && $result == true; $i++)
        {
            $query = "INSERT INTO `answers` () VALUES()";
            $result &= $mysql->query($query);
            $query = "INSERT INTO `question_answers` (`question_id`, `answer_id`) VALUES ($questionId, $mysql->insert_id);";
            $result &= $mysql->query($query);
        }
        return $result;     
    }

    function createTestQuestion($mysql, $testId) {
        $query = "INSERT INTO `questions` () VALUES();";
        $result = $mysql->query($query);

        $query = "INSERT INTO `test_questions` (`test_id`, `question_id`) VALUES ($testId, $mysql->insert_id);";
        $result &= $mysql->query($query);

        return $result ? createQuestionAnswers($mysql, $mysql->insert_id) : false; 
    }

    $mysql = new mysqli("localhost", "root", "", "testro_db");  
    $mysql->autocommit(true);

    $result = createTestQuestion($mysql, $_GET['testId']);
    $mysql->close();

    if($result)
    {
        header("location: /test-page.php?testId=" . $_GET['testId']);
        exit();
    }
?>