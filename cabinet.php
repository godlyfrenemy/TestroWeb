<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru" style="font-size: 18px;">
    <head>
        <title>Кабінет</title>
        <?php include_once("utils/common-head.php"); ?>
        <link href="/styles/cabinet.css" rel="stylesheet" type="text/css">
        </link>
    </head>
    <body class="u-body u-xl-mode" data-lang="ru">
        <?php include_once("header.html"); ?>
        <section class="u-align-center u-clearfix u-section-1" id="sec-ec1f" style="padding-bottom: 30px;">
            <div class="u-clearfix u-sheet u-valign-bottom u-sheet-1">
                <div class="u-expanded-width u-layout-grid u-pagination-center u-products u-products-1">
                    <div class="u-repeater u-repeater-1">
                        <?php include("utils/load-tests.php"); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php include_once("footer.html"); ?>
    </body>
</html>
