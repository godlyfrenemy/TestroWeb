<div class="answer half-width-item u-border-2 u-border-grey-75" id="answer-element-<?=$answer_data['answer_id']?>">
    <div class="max-width-item container">
        <input type="hidden" id="question-answer-<?=$answer_data['answer_id']?>" value="<?=$question['question_id']?>">
    
        <input class="editable-answer-name max-width-item u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-input-1" name="name-answer"  placeholder="Введіть відповідь" value="<?=$answer_data['answer_text']?>" type="text" id="<?=$answer_data['answer_id']?>" required multiline>
        </input>
        <div class="max-width-item container">
            <?php
                echo '<button type="button" value="' . $answer_data['answer_id'] . '" class="assign-answer u-btn-round u-radius-4 u-btn-3 u-text-hover-white half-width-item ';

                if($answer_data['answer_id'] != $question['correct_answer_id'])
                    echo 'u-hover-palette-1-base active">Позначити як правильну</button>';
                else
                    echo 'u-border-palette-4-base" disabled>Правильна відповідь</button>';

                if($answer_idx > 4)
                    echo '<button type="button" value="' . $answer_data['answer_id'] . '" class="delete-answer u-border-2 u-btn-round u-radius-4 u-btn-3 u-border-palette-2-base u-hover-palette-2-base u-text-hover-white item active">
                            Видалити відповідь
                        </button>'
            ?>
        </div>
    </div>
</div>