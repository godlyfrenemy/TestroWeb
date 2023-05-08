<?php
        $mysql = new mysqli("localhost", "root", "", "u981289406_testro_main");  
        $mysql->autocommit(true);
        $query = "SELECT * FROM `questions` WHERE `question_id` = " . $_POST['question'];
        $question = $mysql->query($query)->fetch_assoc();
        $query = "SELECT * FROM `answers` WHERE `question_id` = " . $_POST['question'];
        $result = $mysql->query($query);
        $index = 1;
        while ($answer_data = $result->fetch_assoc()) {
                $answer = array(
                    'index' => $index++,
                    'answer_data' => $answer_data
                );
                include("{$_SERVER['DOCUMENT_ROOT']}/answer-element-include.php");
        }                                           
        $mysql->close();
?>