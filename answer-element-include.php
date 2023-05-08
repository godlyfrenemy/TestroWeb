<div class="answer u-border-2  u-border-grey-75 u-container-style u-list-item u-repeater-item" style="padding: 5px;">
    <div class="u-container-layout u-similar-container u-valign-top u-container-layout-8">
        <input type="hidden" id="question-answer-<?=$answer_data['answer_id']?>" value="<?=$question['question_id']?>">
        <input class="editable-answer-name u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-input-1" name="name-answer"  placeholder="Введіть відповідь" value="<?=$answer_data['text']?>" type="text" id="<?=$answer_data['answer_id']?>" required>
        </input>
        <?php 
            echo '<button type="button" value="' . $answer_data['answer_id'] . '" class="assign-answer u-border-2 u-align-center u-btn-round u-radius-6 u-text-body-color u-btn-2 ';

            if($answer_data['answer_id'] != $question['answer_id'])
                echo 'u-border-palette-2-base u-hover-palette-2-base u-text-hover-white">Позначити як правильну</button>';
            else 
                echo 'u-border-palette-3-dark-1" disabled>Правильна відповідь</button>';
        ?>
    </div>
</div>