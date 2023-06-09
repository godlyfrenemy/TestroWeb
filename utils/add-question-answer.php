<?php
	function createQuestionAnswer($mysql, $questionId) {
        $query = "CALL CreateQuestionAnswer('" . $questionId . "');";
        return $mysql->query($query);
    }

    $mysql = new mysqli("localhost", "root", "", "testro_db");
    $mysql->autocommit(true);

    $query = "CALL CreateQuestionAnswer('" . $_POST['question_id'] . "');";
    $result = $mysql->query($query);
    
    $mysql->close();
?>