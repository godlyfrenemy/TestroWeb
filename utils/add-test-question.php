<?php
	session_start();

    function createQuestionAnswers($questionId) {
        $result = true;
        $mysql = new mysqli("localhost", "root", "", "testro_db");  
        $mysql->autocommit(true);

        for($i = 0; $i < 4 && $result == true; $i++)
            $result &= $mysql->query("CALL CreateQuestionAnswer('" . $questionId . "');");

        $mysql->close();
        return $result;     
    }

    $mysql = new mysqli("localhost", "root", "", "testro_db");  
    $mysql->autocommit(true);
    $result = $mysql->query("CALL CreateTestQuestion('" . $_GET['testId'] . "');");

    if($result->num_rows)
    {
        $isOk = createQuestionAnswers($result->fetch_assoc()['id']); 
        $mysql->close();

        if($isOk)
        {
            header("location: /test-page.php?testId=" . $_GET['testId']);
            exit();
        }
    }
?>