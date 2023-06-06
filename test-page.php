<?php
    session_start();
    function getTestInfo($mysql) {
        $query = "SELECT * FROM `tests` WHERE `test_id` = " . $_GET['testId'];
        $result = $mysql->query($query);
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;      
    }

    function getTestData($mysql, $testDataId) {
        $query = "SELECT * FROM `tests_data` WHERE `test_data_id` = " . $testDataId;
        $result = $mysql->query($query);
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;       
    }

    function getTestQuestions($mysql) {
        $query = "CALL GetTestQuestions(" . $_GET['testId'] .  ");";
        $result = $mysql->query($query);
        $questions = array();
        while ($question = $result->fetch_assoc()) {
            $questions[] = $question;
        }
        return $questions;      
    }

    function getTestTypes($mysql){
        $query = "SELECT * FROM `test_types` WHERE `is_ready` = 1";
        mysqli_next_result($mysql);
        $result = $mysql->query($query);
        $testTypes = array();
        while ($type = $result->fetch_assoc()) {
                $testTypes[] = $type;
        }
        return $testTypes;  
    }

    function getMarkSelectHTML($testInfo){
        echo '<select name="test-mark" onchange="this.form.submit()">';
        for($i = 5; $i <= 12; $i++)
        {
          $selectedText = $i == $testInfo['test_mark'] ? ' selected' : '';
          echo '<option value="' . $i .'"' . $selectedText . '>' . $i . ' балів</option>';
        }
        echo '</select>';
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

    function getQuestionTimeSelectHTML($testData){
        echo '<select name="question-time-constraint" onchange="this.form.submit()">';
        for($i = 5; $i <= 50; $i += 5)
        {
          $selectedText = $i == $testData['test_question_time_constraint'] ? ' selected' : '';
          echo '<option value="' . $i .'"' . $selectedText . '>' . $i . ' секунд</option>';
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

    function getMistakesCorrectionSelectHTML($testData){
        echo '<select name="mistakes-correction" onchange="this.form.submit()">';
        for($i = 0; $i <= 1; $i++)
        {
          $selectedText = $i == $testData['test_mistakes_correction'] ? ' selected' : '';
          $optionText = $i == 0 ? "Відсутня" : "Наявна";
          echo '<option value="' . $i .'"' . $selectedText . '>' . $optionText . '</option>';
        }
        echo '</select>';
    }

    $mysql = new mysqli("localhost", "root", "", "testro_db");  
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
        <script class="u-script" type="text/javascript" src="scripts/ajax-edit-answers.js" defer=""></script>
        <script class="u-script" type="text/javascript" src="scripts/ajax-edit-text-input.js" defer=""></script>
        <script class="u-script" type="text/javascript" src="scripts/ajax-delete-data.js" defer=""></script>
        </link>
    </head>
    <body class="u-body u-xl-mode" data-lang="ru">
        <?php include_once("header.html"); ?>
        <section class="u-section-1" id="sec-498f">
            <div class="">
                <div class="u-clearfix u-expanded-width u-gutter-10 u-layout-wrap u-layout-wrap-1">
                    <div class="u-gutter-0 u-layout">
                        <div class="u-border-2 u-border-grey-75" >
                            <div class="u-size-30">
                                <div class="u-layout-col">
                                    <div class="u-container-style u-layout-cell u-size-60 u-layout-cell-1">
                                        <div class="u-container-layout u-container-layout-1">
                                            <h3 class="u-align-center u-text">
                                                <input class="editable-test-name u-border-2 u-border-black u-border-no-left u-border-no-right u-border-no-top u-input u-input-rectangle u-input-1" name="question-name" placeholder="Введіть запитання" required="" type="text" value="<?=$testInfo['test_name']?>" id="<?=$testInfo['test_id']?>">
                                                 </input>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="u-size-30">
                                <div class="container">
                                    <div class="first-item">
                                        <div class="u-border-2 u-border-grey-75 u-container-layout u-container-layout-3">
                                            <div class="u-list u-list-1">
                                                <div>
                                                    <?php 
                                                      if(count($testQuestions) == 0){
                                                        echo '<h4 class="u-align-center u-text">Цей тест пустий</h4>';
                                                        echo '<h4 class="u-align-center u-text">Відредагуйте його назву та властивості</h4>';
                                                        echo '<h4 class="u-align-center u-text">Додати запитання можно за допомогою додаткових кнопок</h4>';
                                                      }
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
                                    <div class="max-third-width-item">
                                        <div class="u-border-2 u-border-grey-75 u-list-item-2">
                                            <div class="u-grey-10 u-border-2">
                                                <div class="container">
                                                    <label class="u-text u-valign-middle u-align-center first-item">
                                                        Тип тесту
                                                    </label>
                                                    <div class="select item">
                                                      <form method="POST" action="/utils/modify-test-type.php?testId=<?=$_GET['testId'];?>">
                                                        <?php getTypeSelectHTML($testTypes, $testData); ?>
                                                      </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="u-grey-10 u-border-2">
                                                <div class="container">
                                                    <label class="u-text u-valign-middle u-align-center first-item">
                                                        Оцінка за тест
                                                    </label>
                                                    <div class="select item">
                                                      <form method="POST" action="/utils/modify-test-mark.php?testId=<?=$_GET['testId'];?>">
                                                        <?php getMarkSelectHTML($testInfo); ?>
                                                      </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="u-grey-10 u-border-2">
                                                <div class="container">
                                                    <label class="u-text u-valign-middle u-align-center first-item">
                                                        Час на тест
                                                    </label>
                                                    <div class="select item">
                                                      <form method="POST" action="/utils/modify-test-time.php?testId=<?=$_GET['testId'];?>">
                                                        <?php getTimeSelectHTML($testData); ?>
                                                      </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="u-grey-10 u-border-2">
                                                <div class="container">
                                                    <label class="u-text u-valign-middle u-align-center first-item">
                                                        Час на запитання
                                                    </label>
                                                    <div class="select item">
                                                      <form method="POST" action="/utils/modify-test-question-time.php?testId=<?=$_GET['testId'];?>">
                                                        <?php getQuestionTimeSelectHTML($testData); ?>
                                                      </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="u-grey-10 u-border-2">
                                                <div class="container">
                                                    <label class="u-text u-valign-middle u-align-center first-item">
                                                        Робота над помилками
                                                    </label>
                                                    <div class="select item">
                                                      <form method="POST" action="/utils/modify-test-mistakes-correction.php?testId=<?=$_GET['testId'];?>">
                                                        <?php getMistakesCorrectionSelectHTML($testData); ?>
                                                      </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>
                                            <div class="container">
                                                <a class="u-border-2 u-btn u-btn-round u-radius-4 u-btn-3 u-text-hover-white item" href="/utils/add-test-question.php?testId=<?=$_GET['testId'];?>">
                                                    <span class="u-file-icon u-icon">
                                                        <img alt="" src="/images/1286857.png"/>
                                                    </span>
                                                    Додати питання
                                                </a>
                                        
                                                <a class="delete-test u-border-2 u-btn u-btn-round u-radius-4 u-btn-3 u-border-palette-2-base u-hover-palette-2-base u-text-hover-white item" id="<?=$_GET['testId'];?>">
                                                    <span class="u-file-icon u-icon">
                                                        <img alt="" src="/images/cross.png"/>
                                                    </span>
                                                    Видалити тест
                                                </a>

                                                <a class="u-align-center u-border-2 u-btn u-btn-round u-radius-4 u-btn-3 u-text-hover-white max-width-item" href="/test-results.php?testId=<?=$_GET['testId'];?>">
                                                    <span class="u-file-icon u-icon">
                                                        <img alt="" src="/images/results_icon.png"/>
                                                    </span>
                                                    Результати тестувань
                                                </a>
                                            </div>
                                            
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
        ?>
        </body>
</html>