<?php
    session_start();

    $mysql = new mysqli("localhost", "root", "", "testro_db");  
    $mysql->autocommit(true);

    mysqli_next_result($mysql);
    $mysql->query("CALL ModifyTestMark('" . $_POST['test-mark'] . "', '" . $_GET['testId'] . "');");

    $mysql->close();
    header("location: /test-page.php?testId=" . $_GET['testId']);
    exit();
?>