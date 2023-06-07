
    <section class="u-black u-clearfix u-container-style u-dialog-block u-opacity u-opacity-70 u-valign-middle u-dialog-section-4" id="question-<?=$question['question_id']?>">
        <div class="u-align-center u-container-align-center u-container-style u-dialog u-gradient u-dialog-1" style="overflow-y: auto; max-height: 90vh;">
            <div class="">
                <div class="u-clearfix u-expanded-width u-gutter-6 u-layout-wrap u-layout-wrap-1">
                    <div class="u-gutter-0 u-layout">
                        <form class="u-layout-col">
                            <div class="u-container-style u-layout-cell u-size-20 u-layout-cell-1">
                                <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-2">
                                    <label class="u-label" for="question-name">
                                        Запитання
                                    </label>
                                    <input class="editable-question-name u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-input-1" name="question-name" placeholder="Введіть запитання" type="text" value="<?=$question['question_name']?>" id="<?=$question['question_id']?>" required>
                                    </input>
                                </div>
                            </div>
                            <div class="u-align-justify u-container-style u-layout-cell u-size-20 u-layout-cell-2">
                                <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-3 ">
                                        <div class="image-form u-align-center container">
                                              <div class="preview container max-width-item with-border" id="question-image-preview-<?=$question['question_id']?>">
                                                    <?php
                                                        if($question['image'] != null)
                                                        {
                                                            echo '<p class="label-max-width-item" style="margin: 0 auto">Поточний файл</p>';
                                                            echo "<img class='photo-max-width-item' src='data:image/jpeg;base64," . base64_encode($question['image']) . "'/>";
                                                        }
                                                        else
                                                            echo '<p class="item">Жодного файлу не обрано</p>';
                                                    ?>
                                              </div>
                                              <div class="u-align-center label-max-width-item container">
                                                    <label class="item" for="question-image-<?=$question['question_id']?>">
                                                        Оберіть файл для тесту (PNG, JPG)
                                                    </label>
                                                    <input type="file" name="uploadFile" class="question-image max-width-item" id="question-image-<?=$question['question_id']?>"
                                                      name="question-image-<?=$question['question_id']?>"
                                                      accept="*.jpg, *.jpeg, *.png"
                                                    />
                                              </div>
                                        </div>
                                </div>
                            </div>
                            <div class="u-container-style u-layout-cell u-size-20 u-layout-cell-3">
                                <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-bottom u-container-layout-4">
                                    <h4 class="u-align-center u-text u-text-3">
                                        Варіанти відповідей
                                    </h4>
                                    <div id="answers-<?=$question['question_id']?>" class="container question-data">
                                        <?php include("utils/print-answers.php"); ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <button class="close-module-window-button u-border-3 u-border-palette-1-base u-custom-color-2 u-dialog-close-button u-icon u-icon-circle u-text-grey-70 u-icon-1">
                <svg class="u-svg-link" preserveaspectratio="xMidYMin slice" style="" viewbox="0 0 16 16">
                    <use xlink:href="#svg-efe9">
                    </use>
                </svg>
                <svg class="u-svg-content" id="svg-efe9" version="1.1" viewbox="0 0 16 16" x="0px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" y="0px">
                    <rect height="16" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -3.3138 8.0002)" width="2" x="7" y="0">
                    </rect>
                    <rect height="2" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -3.3138 8.0002)" width="16" x="0" y="7">
                    </rect>
                </svg>
            </button>
        </div>
    </section>
</link>