<?php session_start(); ?>
<!DOCTYPE html>
<html class="full-height" lang="ru" style="font-size: 18px;">
    <head>
        <title>
            Кабінет
        </title>
        <?php include_once("utils/common-head.php"); ?>
        <link href="/styles/cabinet.css" rel="stylesheet" type="text/css">
            <script class="u-script" defer="" src="scripts/ajax-delete-data.js" type="text/javascript">
            </script>
            <script class="u-script" defer="" src="scripts/ajax-get-tests.js" type="text/javascript">
            </script>
            <script class="u-script" defer="" src="scripts/ajax-create-test.js" type="text/javascript">
            </script>
        </link>
    </head>
    <body class="u-body u-xl-mode" data-lang="ru">
        <?php include_once("header.html"); ?>
        <div class="u-section-1">
            <form class="container with-border u-container-style u-group u-palette-5-dark-1 u-shape-rectangle">
                <input class="first-item" id="test-to-find" name="test-to-find" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Заповніть поле')" placeholder="Назва тесту" required="" type="input" style="color: black; text-align: center; font-size: 25px;" />
                <div class="first-item container">
                    <a class="u-align-center u-border-2 u-btn u-btn-round u-radius-4 u-btn-3 u-text-hover-white item" id="refresh-test-submit">
                        <span class="u-align-center u-file-icon u-icon">
                            <img alt="" src="/images/refresh-black.png"/>
                        </span>
                    </a>
                    <a class="u-align-center u-border-2 u-btn u-btn-round u-radius-4 u-btn-3 u-text-hover-white item" id="find-test-submit">
                        <span class="u-file-icon u-icon">
                            <img alt="" src="/images/search-icon.png"/>
                        </span>
                        Пошук
                    </a>
                    <a class="u-align-center u-border-2 u-btn u-btn-round u-radius-4 u-btn-3 u-text-hover-white item" id="add-test-submit">
                        <span class="u-file-icon u-icon">
                            <img alt="" src="/images/1286857.png"/>
                        </span>
                        Створити новий тест
                    </a>
                </div>

            </form>
            <div id="tests_list">
                <?php include("utils/load-tests.php"); ?>
            </div>
        </div>
        <?php include_once("footer.html"); ?>
    </body>
</html>
