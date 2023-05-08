<?php
    session_start();
    function getTestInfo($mysql) {
        $query = "SELECT * FROM `tests` WHERE `test_id` = " . $_GET['testId'] . " AND `teacher_id` = " . $_SESSION['user_id'];
        $result = $mysql->query($query);
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;      
    }

    function getTestData($mysql, $testDataId) {
        $query = "SELECT * FROM `test_data` WHERE `test_data_id` = " . $testDataId;
        $result = $mysql->query($query);
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;       
    }

    function getTestQuestions($mysql) {
        $query = "SELECT * FROM `questions` WHERE `test_id` = " . $_GET['testId'];
        $result = $mysql->query($query);
        $questions = array();
        while ($question = $result->fetch_assoc()) {
            $questions[] = $question;
        }
        return $questions;      
    }

    function getTestTypes($mysql){
        $query = "SELECT * FROM `test_types` WHERE is_ready = true";
        $result = $mysql->query($query);
        $testTypes = array();
        while ($type = $result->fetch_assoc()) {
                $testTypes[] = $type;
        }
        return $testTypes;  
    }

    function getTimeSelectHTML($testData){
        echo '<select name="time-constraint" onchange="this.form.submit()">';
        for($i = 5; $i <= 50; $i += 5)
        {
          $selectedText = $i == $testData['test_time_constraint'] ? ' selected' : '';
          echo '<option value="' . $i .'"' . $selectedText . '>' . $i . ' хвилин</option>';
        }
        echo '</select>';
    }

    function getTypeSelectHTML($testTypes, $testData){
        echo '<select name="type-constraint" onchange="this.form.submit()">';
        foreach($testTypes as $type){
            $selectedText = $type['test_type_id'] == $testData['test_type_constraint_id'] ? ' selected' : '';
            echo '<option value="' . $type['test_type_id'] .'"' . $selectedText . '>' . $type['test_type_name'] . '</option>';
        }
        echo '</select>';
    }

    $mysql = new mysqli("localhost", "root", "", "u981289406_testro_main");  
    $mysql->autocommit(true);

    $testInfo = getTestInfo($mysql);
    $testData = !empty($testInfo) ? getTestData($mysql, $testInfo['test_data_id']) : null;
    $testQuestions = !empty($testInfo) ? getTestQuestions($mysql) : null;
    $testTypes = getTestTypes($mysql);
    $mysql->close();
?>

<!DOCTYPE html>
<html lang="ru" style="font-size: 18px;">
    <head>
        <title>
            Тест
        </title>
        <?php include_once("utils/common-head.php"); ?>
        <link href="/styles/test-page.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script class="u-script" type="text/javascript" src="scripts/edit-answers.js" defer=""></script>
        </link>
    </head>
    <body class="u-body u-xl-mode" data-lang="ru">
        <?php include_once("header.html"); ?>
        <section class="u-clearfix u-section-1" id="sec-498f">
            <div class="u-clearfix u-sheet u-sheet-1">
                <div class="u-clearfix u-expanded-width u-gutter-10 u-layout-wrap u-layout-wrap-1">
                    <div class="u-gutter-0 u-layout">
                        <div class="u-layout-col u-border-2 u-border-grey-75" >
                            <div class="u-size-30">
                                <div class="u-layout-col">
                                    <div class="u-container-style u-layout-cell u-size-60 u-layout-cell-1">
                                        <div class="u-container-layout u-container-layout-1">
                                            <h3 class="u-align-center u-text" style="color: red;">
                                                <?php echo $testInfo['test_name']; ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="u-size-30">
                                <div class="u-layout-row">
                                    <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-2">
                                        <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-3">
                                            <div class="u-list u-list-1">
                                                <div class="u-repeater u-repeater-1">
                                                    <?php 
                                                      if(count($testQuestions) == 0)
                                                        echo '<h3 class="u-align-center u-text">Жодного завдання не додано((9</h3>';
                                                      else{
                                                        $list_item_number = 1;
                                                        foreach ($testQuestions as $question)
                                                        {
                                                          include("question-element-include.php");
                                                          $list_item_number++;
                                                        }
                                                      }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-3">
                                        <div class="u-border-2 u-border-grey-75 u-container-layout u-valign-top u-container-layout-5">
                                            <div class="u-container-style u-grey-10 u-group u-group-1">
                                                <div class="u-container-layout u-container-layout-6">
                                                    <label class="u-align-center u-text u-text-default u-text-4" for="standard-select">
                                                        Ліміт часу на тест
                                                    </label>
                                                    <div class="select">
                                                      <form method="POST" action="/utils/modify-test-time.php?testId=<?=$_GET['testId'];?>">
                                                        <?php getTimeSelectHTML($testData); ?>
                                                      </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="u-container-style u-grey-10 u-group u-group-2">
                                                <div class="u-container-layout u-container-layout-6">
                                                    <label class="u-align-center u-text u-text-default u-text-4" for="standard-select">
                                                        Тип тесту
                                                    </label>
                                                    <div class="select select--multiple">
                                                      <form method="POST" action="/utils/modify-test-type.php?testId=<?=$_GET['testId'];?>">
                                                        <?php getTypeSelectHTML($testTypes, $testData); ?>
                                                      </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="u-align-center u-border-2 u-border-grey-75 u-btn u-btn-round u-button-style u-gradient u-none u-radius-4 u-text-body-alt-color u-btn-3" href="/utils/add-test-question.php?testId=<?=$_GET['testId'];?>">
                                                <span class="u-file-icon u-icon">
                                                    <img alt="" src="/images/1286857.png"/>
                                                </span>
                                                Додати питання
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php 
          require_once("footer.html"); 
          require_once("pop-up.php");    
        ?>
        </body>
</html>