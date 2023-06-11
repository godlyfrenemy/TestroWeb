<?php
	session_start();

    function createQuestionAnswers($questionId) {
        $result = true;
        include("db-connection.php");

        for($i = 0; $i < 4 && $result == true; $i++)
            $result &= $mysql->query("CALL CreateQuestionAnswer('" . $questionId . "');");

        $mysql->close();
        return $result;     
    }

    include("db-connection.php");
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