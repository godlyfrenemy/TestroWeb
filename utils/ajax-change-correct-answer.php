<?php 
    include("db-connection.php");
    $mysql->query("CALL ChangeCorrectAnswer('" . $_POST['answer'] . "', '" . $_POST['question'] . "');");
    $mysql->close(); 
 ?>

