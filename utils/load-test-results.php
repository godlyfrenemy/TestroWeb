<?php
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();

    function includePupilResults($test_id) {
        include("db-connection.php");
        $result = $mysql->query("CALL GetPupilTestCompletions('" . $test_id . "');");

        if($result->num_rows > 0){
            while($pupil_data = $result->fetch_assoc()){
                $pupil_id = $pupil_data['pupil_id'];
                include("{$_SERVER['DOCUMENT_ROOT']}/pupil-result-element-include.php");
            }
        }
        else
            echo "<h3 class='u-align-center u-valign-center first-item'>Ще ніхто не проходив тест</h3>";
    }

    function includePupilResultsByName($test_id, $pupil_to_find) {
        include("db-connection.php");
        $result = $mysql->query("CALL GetPupilResultsByName('" . $test_id . "', '" . $pupil_to_find . "');");

        if($result->num_rows > 0){
            while($pupil_data = $result->fetch_assoc()){
                $pupil_id = $pupil_data['pupil_id'];
                include("{$_SERVER['DOCUMENT_ROOT']}/pupil-result-element-include.php");
            }
        }
    }

    if(isset($_GET['testId']))
        includePupilResults($_GET['testId']);
    else
        includePupilResultsByName($_POST['test-id'], $_POST['pupil-to-find']);
?>
