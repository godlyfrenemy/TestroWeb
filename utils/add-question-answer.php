<?php
	function createQuestionAnswer($mysql, $questionId) {
        $query = "INSERT INTO `answers` () VALUES()";
        $result &= $mysql->query($query);
        $query = "INSERT INTO `question_answers` (`question_id`, `answer_id`) VALUES ($questionId, $mysql->insert_id);";
        return $mysql->query($query);
    }

    $mysql = new mysqli("localhost", "root", "", "testro_db");
    $mysql->autocommit(true);

    $result = createQuestionAnswer($mysql, $_POST['question_id']);
    $mysql->close();
?>