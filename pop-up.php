<link href="/styles/pop-up.css" rel="stylesheet" type="text/css">
    <section class="u-black u-clearfix u-container-style u-dialog-block u-opacity u-opacity-70 u-valign-middle u-dialog-section-4" id="question-<?=$question['question_id']?>">
        <div class="u-align-center u-container-align-center u-container-style u-dialog u-gradient u-dialog-1">
            <div class="u-container-layout u-valign-middle u-container-layout-1">
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
                                <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-3">
                                    <p class="u-align-center u-text u-text-default u-text-2">
                                        Додати вставку фото та міні фото збоку
                                    </p>
                                </div>
                            </div>
                            <div class="u-container-style u-layout-cell u-size-20 u-layout-cell-3">
                                <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-bottom u-container-layout-4">
                                    <h4 class="u-align-center u-text u-text-3">
                                        Варіанти відповідей
                                    </h4>
                                    <div class="u-expanded-width u-list u-list-1">
                                        <div id="answers-<?=$question['question_id']?>" class="u-repeater u-repeater-1">
                                            <?php include("utils/print-answers.php"); ?>
                                        </div>
                                    </div>
                                    <a class="delete-question u-align-center u-border-2 u-btn u-btn-round u-gradient u-none u-radius-4 u-btn-5 u-border-palette-2-base u-hover-palette-2-base u-text-hover-white" id="<?=$question['question_id']?>">
                                        <span class="u-file-icon u-icon">
                                            <img alt="" src="/images/cross.png"/>
                                        </span>
                                        Видалити питання
                                    </a>
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