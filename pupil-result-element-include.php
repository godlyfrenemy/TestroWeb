<?php
    include_once("utils/get-pupil-results-data.php");
    $mysql = new mysqli("localhost", "root", "", "testro_db");
    $mysql->autocommit(true);

    $pupil_data = GetPupilData($mysql, $pupil_id);
    $pupil_result = array(
        "total_mark" =>      GetPupilTotalMark($mysql, $test_id, $pupil_id),
        "correct_answers" => GetPupilCorrectAnswersCount($mysql, $test_id, $pupil_id),
    );
?>

<div class="u-align-center half-width-item">
    <div class="container with-border">
        <h4 class="u-text first-item">
            <a class="u-product-title-link">
                <?php echo $pupil_data['pupil_name'] . " " . $pupil_data['pupil_surname']; ?>
            </a>
        </h4>
        <div class="container first-item">
            <h4 class="u-text first-item">
                <a style="margin: 10px">
                    <?php echo $pupil_result['correct_answers']; ?>
                </a>
            </h4>
            <h4 class="u-text first-item">
                <a style="margin: 10px">
                    <?php echo $pupil_result['total_mark']; ?>
                </a>
            </h4>
            <a class="u-align-center u-border-2 u-btn u-btn-round u-radius-4 u-btn-3 u-text-hover-white item" id="<?=$pupil_id;?>">
                <span class="u-file-icon u-icon">
                    <img alt="" src="/images/results_icon.png"/>
                </span>
                Детальні результати учня
            </a>
        </div>

    </div>

    <?php include("{$_SERVER['DOCUMENT_ROOT']}/test-result-pop-up.php"); ?>
</div>
