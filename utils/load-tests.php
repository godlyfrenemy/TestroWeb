<?php
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();

    function includeTests($mysql, $lookForTest = false) {
        $user_id = $_SESSION['user_id'];
        echo $lookForTest;
        $query = "CALL GetTeacherTests('" . $user_id . "');";
        $result = $mysql->query($query);

        if($result->num_rows > 0){
            while($test_data = $result->fetch_assoc()){
                include("{$_SERVER['DOCUMENT_ROOT']}/test-element-include.php");
            }       
        }        
    }

    function includeTestsByName($mysql) {
        $user_id = $_SESSION['user_id'];
        $query = "CALL GetTeacherTestsByName('" . $user_id . "', '" . $_POST['test-to-find'] . "');";
        $result = $mysql->query($query);

        if($result->num_rows > 0){
            while($test_data = $result->fetch_assoc()){
                include("{$_SERVER['DOCUMENT_ROOT']}/test-element-include.php");
            }       
        }        
    }

    $mysql = new mysqli("localhost", "root", "", "testro_db");  
    $mysql->autocommit(true);

    if(!isset($_POST['test-to-find']) || strlen($_POST['test-to-find']) === 0)
        includeTests($mysql);
    else
        includeTestsByName($mysql, $_POST['test-to-find']);

    $mysql->close();
?>
