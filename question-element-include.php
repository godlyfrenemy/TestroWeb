<?php
    $border_class = is_null($question['correct_answer_id']) ? "u-border-3 u-border-palette-2" : "u-border-2 u-border-grey-75";
?>
<div>
    <div class=" <?php echo $border_class;?> u-shape-rectangle u-list-item-1">
        <div>
            <ol class="u-align-center u-text u-text-2 container">
                <label class="u-valign-middle u-text-palette-1-base first-item">
                    <li value="<?=$list_item_number?>">
                        <?php echo $question['question_name'];?>
                    </li>
                </label>
                <div class="first-item container">
                    <a class="u-align-center u-border-2 u-btn u-btn-round u-radius-4 u-btn-3 u-text-hover-white item u-button-link u-dialog-link" href="#question-<?=$question['question_id']?>">
                        <span class="u-file-icon u-icon">
                            <img alt="" src="/images/edit.png"/>
                        </span>
                        Редагувати
                    </a>
                    <a class="delete-question u-align-center u-border-2 u-btn u-btn-round u-radius-4 u-btn-5 u-border-palette-2-base u-hover-palette-2-base u-text-hover-white item" id="<?=$question['question_id']?>">
                        <span class="u-file-icon u-icon">
                            <img alt="" src="/images/cross.png"/>
                        </span>
                        Видалити
                    </a>
                </div>

            </ol>
        </div>
    </div>
    <?php
        include("test-question-pop-up.php");
    ?>
</div>