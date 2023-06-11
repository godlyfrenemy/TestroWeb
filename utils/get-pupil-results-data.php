<?php
    function GetTestMark($test_id){
        include("db-connection.php");
        $query = "CALL GetTestInfo('" . $test_id . "');";
        $result = $mysql->query($query);
        return $result->num_rows != 0 ? $result->fetch_assoc()['test_mark'] : 0;
    }

    function GetTestTotalQuestionsAmount($test_id){
        include("db-connection.php");
        $query = "CALL GetTestQuestionsCount('" . $test_id . "');";
        $result = $mysql->query($query);
        return $result->num_rows != 0 ? $result->fetch_assoc()['total_count'] : 0;
    }

    function GetPupilCorrectAnswersCount($test_id, $pupil_id){
        include("db-connection.php");
        $result = $mysql->query("CALL CountCorrectAnswers('" . $pupil_id . "', '" . $test_id . "');");
        $correct_answers_count = $result->num_rows != 0 ? $result->fetch_assoc()['total_count'] : "0";
        return $correct_answers_count . " / " . GetTestTotalQuestionsAmount($test_id);
    }

    function GetPupilQuestionMark($user_id, $question_id){
        include("db-connection.php");
        $query = "CALL GetQuestionAnswerMark('" . $user_id . "', '" . $question_id . "');";
        $result = $mysql->query($query);
        return $result->num_rows != 0 ? $result->fetch_assoc()['result'] : 0;
    }

    function GetPupilTotalMark($test_id, $user_id){
        $total_mark = 0;
        $coef = GetTestMark($test_id) / (100.0 * GetTestTotalQuestionsAmount($test_id));

        include("db-connection.php");
        $result = $mysql->query("CALL GetTestQuestions('" . $test_id . "');");

        while($question = $result->fetch_assoc()) {
            $total_mark += GetPupilQuestionMark($user_id, $question['question_id']) * $coef;
        }

        return round($total_mark, 2);
    }

    function GetPupilData($pupil_id){
        include("db-connection.php");
        $query = "CALL GetPupilData('" . $pupil_id . "');";
        $result = $mysql->query($query);
        return $result->num_rows != 0 ? $result->fetch_assoc() : [];
    }
?>