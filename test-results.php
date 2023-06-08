<?php
    session_start();
?>
<!DOCTYPE html>
<html class="full-height" lang="ru" style="font-size: 18px;">
    <head>
        <title>
            Результати тестувань
        </title>
        <?php include_once("utils/common-head.php"); ?>
        <link href="/styles/results.css" rel="stylesheet" type="text/css"/>
        <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.19.3/package/dist/xlsx.full.min.js"></script>
        <script class="u-script" type="text/javascript" src="scripts/ajax-get-pupil-results.js" defer=""></script>
    </head>
    <body class="u-body u-xl-mode" data-lang="ru">
        <?php include_once("header.html"); ?>
        <div class="u-section-1">
            <form class="container u-container-style u-group u-palette-5-dark-1 u-shape-rectangle">
                <input type="hidden" id="test-id" value="<?=$_GET['testId']?>">
                <input class="first-item" id="pupil-to-find" name="pupil-to-find" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Заповніть поле')" placeholder="Ім'я учня для пошуку" required="" type="input" style="color: black; text-align: center; font-size: 25px;" />
                <a class="u-align-center u-border-2 u-btn u-btn-round u-gradient u-none u-radius-4 u-btn-3 u-text-hover-white item" id="refresh-pupil-results-submit">
                    <span class="u-align-center u-file-icon u-icon">
                        <img alt="" src="/images/refresh-black.png"/>
                    </span>
                </a>
                <a class="u-align-center u-border-2 u-btn u-btn-round u-gradient u-none u-radius-4 u-btn-3 u-text-hover-white item" id="find-pupil-results-submit">
                    <span class="u-file-icon u-icon">
                        <img alt="" src="/images/search-icon.png"/>
                    </span>
                    Пошук
                </a>
                <a class="u-align-center u-border-2 u-btn u-btn-round u-radius-4 u-btn-3 u-text-hover-white item" id="download-test-results">
                    <span class="u-file-icon u-icon">
                        <img alt="" src="/images/download.png"/>
                    </span>
                    Зберегти результати
                </a>
            </form>
            <div id="test-results-list" class="container">
                <?php include("utils/load-test-results.php"); ?>
            </div>
        </div>
        <?php include_once("footer.html"); ?>
    </body>
</html>
