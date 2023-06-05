<?php 
    $mysql = new mysqli("localhost", "root", "", "testro_db");  
    $mysql->autocommit(true);
    $query = "UPDATE `questions` SET `correct_answer_id` = " . $_POST['answer'] . " WHERE `question_id` = " . $_POST['question'];
    $mysql->query($query);
    $mysql->close(); 
 ?>

