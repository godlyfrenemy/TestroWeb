<?php
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();

    function includePupilResults($mysql, $test_id) {
        $query = "SELECT * FROM `pupil_test_completions` WHERE `test_id` = '" . $test_id . "'";
        $result = $mysql->query($query);

        if($result->num_rows > 0){
            while($pupil_data = $result->fetch_assoc()){
                $pupil_id = $pupil_data['pupil_id'];
                include("{$_SERVER['DOCUMENT_ROOT']}/pupil-result-element-include.php");
            }
        }
        else{
            echo "<h3 class='u-align-center u-valign-center'>Ще ніхто не проходив тест</h3>";
        }
    }

    function includePupilResultsByName($mysql, $test_id, $pupil_to_find) {
        $query = "CALL GetPupilResultsByName('" . $test_id . "', '" . $pupil_to_find . "');";

        $result = $mysql->query($query);

        if($result->num_rows > 0){
            while($pupil_data = $result->fetch_assoc()){
                $pupil_id = $pupil_data['pupil_id'];
                include("{$_SERVER['DOCUMENT_ROOT']}/pupil-result-element-include.php");
            }
        }
    }

    $mysql = new mysqli("localhost", "root", "", "testro_db");
    $mysql->autocommit(true);

    if(isset($_GET['testId']))
        includePupilResults($mysql, $_GET['testId']);
    else
        includePupilResultsByName($mysql, $_POST['test-id'], $_POST['pupil-to-find']);

    $mysql->close();
?>
