<?php
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();

    include("db-connection.php");
    echo $mysql->query("CALL CreateTest('" . $_SESSION['user_id'] . "', @created_test);")->fetch_assoc()['id'];
    $mysql->close();
?>