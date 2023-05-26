<?php
    function includeTests($mysql) {
        $user_id = $_SESSION['user_id'];
        $query = "CALL GetTeacherTests(" . $user_id . ");";
        $result = $mysql->query($query);

        if($result->num_rows > 0){
            while($test_data = $result->fetch_assoc()){
                include("test-element-include.php");
            }       
        }        
    }

    $mysql = new mysqli("localhost", "root", "", "testro_db");  
    $mysql->autocommit(true);
    includeTests($mysql);
    $mysql->close();
?>
