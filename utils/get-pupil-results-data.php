<?php
    function GetTestMark($mysql, $test_id){
        $query = "CALL GetTestInfo('" . $test_id . "');";
        $result = $mysql->query($query);
        return $result->num_rows != 0 ? $result->fetch_assoc()['test_mark'] : 0;
    }

    function GetTestTotalQuestionsAmount($test_id){
        $mysql = new mysqli("localhost", "root", "", "testro_db");
        $mysql->autocommit(true);
        $query = "CALL GetTestQuestionsCount('" . $test_id . "');";
        $result = $mysql->query($query);
        return $result->num_rows != 0 ? $result->fetch_assoc()['total_count'] : 0;
    }

    function GetPupilCorrectAnswersCount($mysql, $test_id, $pupil_id){
        mysqli_next_result($mysql);
        $result = $mysql->query("CALL CountCorrectAnswers('" . $pupil_id . "', '" . $test_id . "');");
        $correct_answers_count = $result->num_rows != 0 ? $result->fetch_assoc()['total_count'] : "0";
        return $correct_answers_count . " / " . GetTestTotalQuestionsAmount($test_id);
    }

    function GetPupilQuestionMark($user_id, $question_id){
        $mysql = new mysqli("localhost", "root", "", "testro_db");
        $mysql->autocommit(true);
        $query = "CALL GetQuestionAnswerMark('" . $user_id . "', '" . $question_id . "');";
        $result = $mysql->query($query);
        return $result->num_rows != 0 ? $result->fetch_assoc()['result'] : 0;
    }

    function GetPupilTotalMark($mysql, $test_id, $user_id){
        $total_mark = 0;
        $coef = GetTestMark($mysql, $test_id) / (100.0 * GetTestTotalQuestionsAmount($test_id));

        mysqli_next_result($mysql);
        $result = $mysql->query("CALL GetTestQuestions('" . $test_id . "');");

        while($question = $result->fetch_assoc()) {
            $total_mark += GetPupilQuestionMark($user_id, $question['question_id']) * $coef;
        }

        return round($total_mark, 2);
    }

    function GetPupilData($mysql, $pupil_id){
        $mysql = new mysqli("localhost", "root", "", "testro_db");
        $mysql->autocommit(true);
        $query = "CALL GetPupilData('" . $pupil_id . "');";
        $result = $mysql->query($query);
        return $result->num_rows != 0 ? $result->fetch_assoc() : [];
    }
?>