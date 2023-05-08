<?php 
    $mysql = new mysqli("localhost", "root", "", "u981289406_testro_main");  
    $mysql->autocommit(true);
    $query = "UPDATE `questions` SET `answer_id` = " . $_POST['answer'] . " WHERE `question_id` = " . $_POST['question'];
    $mysql->query($query);
    $mysql->close(); 
 ?>

