<?php
    session_start();

    include("db-connection.php");
    $mysql->query("CALL ModifyTestMark('" . $_POST['test-mark'] . "', '" . $_GET['testId'] . "');");

    $mysql->close();
    header("location: /test-page.php?testId=" . $_GET['testId']);
    exit();
?>