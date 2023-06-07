<?php
        $mysql = new mysqli("localhost", "root", "", "testro_db");
        $mysql->autocommit(true);

        $query = "SELECT * FROM `questions` WHERE `question_id` = " . $_POST['question'];
        $question = $mysql->query($query)->fetch_assoc();

        $query = "SELECT * FROM `answers` WHERE `answer_id` IN (SELECT `answer_id` FROM `question_answers` WHERE `question_id` = '" . $_POST['question'] . "');";
        $result = $mysql->query($query);

        echo '<div class="u-expanded-width u-list u-list-1"><div class="container">';

        $answer_idx = 0;

        while ($answer_data = $result->fetch_assoc())
        {           
            $answer_idx++;
            include("{$_SERVER['DOCUMENT_ROOT']}/answer-element-include.php");
        }

        echo '</div></div>';

        if($answer_idx < 6)
            echo '<button class="add-answer u-btn-round u-radius-4 u-btn-3 u-text-hover-white u-hover-palette-1-base item active" id="' . $question['question_id'] . '">
                    Додати варіант відповіді
                </button>';

        $mysql->close();
?>