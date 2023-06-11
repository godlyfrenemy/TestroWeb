<?php
        include("db-connection.php");
        $result = $mysql->query("CALL GetQuestionAnswers('" . $question['question_id'] . "');");

        echo '<div class="u-expanded-width u-list u-list-1">
              <div class="container">';

        $answer_idx = 0;

        while ($answer_data = $result->fetch_assoc())
        {           
            $answer_idx++;
            include("{$_SERVER['DOCUMENT_ROOT']}/answer-element-include.php");
        }

        echo '</div>
              </div>';

        if($answer_idx < 6)
            echo '<button class="add-answer u-btn-round u-radius-4 u-btn-3 u-text-hover-white u-hover-palette-1-base item active" id="' . $question['question_id'] . '">
                    Додати варіант відповіді
                </button>';

        $mysql->close();
?>