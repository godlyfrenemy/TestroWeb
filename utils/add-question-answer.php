<?php
	function createQuestionAnswer($mysql, $questionId) {
        $query = "CALL CreateQuestionAnswer('" . $questionId . "');";
        return $mysql->query($query);
    }

    include("db-connection.php");

    $query = "CALL CreateQuestionAnswer('" . $_POST['question_id'] . "');";
    $result = $mysql->query($query);
    
    $mysql->close();
?>