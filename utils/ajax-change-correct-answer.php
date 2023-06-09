<?php 
    $mysql = new mysqli("localhost", "root", "", "testro_db");  
    $mysql->autocommit(true);
    $mysql->query("CALL ChangeCorrectAnswer('" . $_POST['answer'] . "', '" . $_POST['question'] . "');");
    $mysql->close(); 
 ?>

