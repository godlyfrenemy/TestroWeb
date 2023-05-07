<div class="u-border-2 u-border-grey-75 u-container-style u-list-item u-repeater-item" style="padding: 5px;">
    <div class="u-container-layout u-similar-container u-valign-top u-container-layout-8">
        <label class="u-label" for="answer-<?=$answer['index'];?>">
            <?=$answer['text'];?>
        </label>
        <input class="u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-input-1" id="answer-<?=$answer['index'];?>" name="contact-name" placeholder="Введіть відповідь" required="" type="text">
        </input>
        <?php 
            if(true)
                echo '<a class="u-border-2 u-align-center u-border-palette-2-base u-btn-round u-button-style u-hover-palette-2-base u-align-center u-radius-6 u-text-body-color u-text-hover-white u-btn-' . $answer['index'] . '" href="https://nicepage.site">Позначити як правильну</a>';
            else 
                echo '<a class="u-border-2 u-align-center u-border-palette-2-base u-btn-round u-button-style u-hover-palette-3-dark-1 u-align-center u-radius-6 u-text-body-color u-text-hover-white u-btn-' . $answer['index'] . '" href="https://nicepage.site" style="color: green;">Правильна відповідь</a>';
        ?>
    </div>
</div>