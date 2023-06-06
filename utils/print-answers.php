<?php
        $mysql = new mysqli("localhost", "root", "", "testro_db");  
        $mysql->autocommit(true);

        $query = "SELECT * FROM `answers` WHERE `answer_id` IN (SELECT `answer_id` FROM `question_answers` WHERE `question_id` = '" . $question['question_id'] . "');";
        $result = $mysql->query($query);

        $answer_idx = 0;

        while ($answer_data = $result->fetch_assoc())
        {
            include("{$_SERVER['DOCUMENT_ROOT']}/answer-element-include.php");
            $answer_idx++;
        }

        $mysql->close();
?>