<?php
    session_start();

    if(isset($_SESSION['user_id'])){        
        header("location: cabinet.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ru" style="font-size: 18px;">
    <head>
        <title>
            Вхід
        </title>
        <meta charset="utf-8">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
                <link href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css" rel="stylesheet">
                    <link href="styles/cabinet-login.css" rel="stylesheet" type="text/css">
                    <?php include_once("utils/common-head.php"); ?>                           
                    <script class="u-script" type="text/javascript" src="scripts/cabinet-login.js" defer=""></script>
                </link>
            </link>
        </meta>
    </head>
    <body class="u-body u-xl-mode" data-lang="ru">
        <?php include_once("header.html"); ?>
        <section class="u-clearfix u-section-1" id="sec-0325">
            <div class="u-clearfix u-sheet u-sheet-1">
                <div class="section">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center">
                                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                                    <h6 class="mb-0 pb-3">
                                        <span>
                                            Log in
                                        </span>
                                        <span>
                                            Sign up
                                        </span>
                                    </h6>
                                    <input class="checkbox" id="reg-log" name="reg-log" type="checkbox">
                                        <label for="reg-log">
                                        </label>
                                        <div class="card-3d-wrap mx-auto">
                                            <div class="card-3d-wrapper">
                                                <div class="card card-front">
                                                    <div class="center-wrap">
                                                        <div class="section text-center">
                                                            <h4 class="mb-4 pb-3">
                                                                Вхід
                                                            </h4>
                                                            <?php 
                                                                if(isset($_GET['isWrongLogin']) && $_GET['isWrongLogin'])
                                                                    echo "<i class='error-message'>Користувач з таким логіном не існує, спробуйте знову</i>";
                                                                else if(isset($_GET['isWrongPassword']) && $_GET['isWrongPassword'])
                                                                    echo "<i class='error-message'>Неправильний пароль, спробуйте знову</i>";
                                                            ?>
                                                            <form action="utils/auth.php" id="auth-form" method="post" name="auth-form">
                                                                <div class="form-group">
                                                                    <input autocomplete="off" minlength="4" maxlength="35" class="form-style" id="auth-login" name="auth-login" placeholder="Логін" type="login" required oninvalid="setCustomValidity('Заповніть поле')" oninput="setCustomValidity('')">
                                                                        <i class="input-icon uil uil-at">
                                                                        </i>
                                                                    </input>
                                                                </div>
                                                                <div class="form-group mt-2">
                                                                    <input autocomplete="off" minlength="4" maxlength="32" class="form-style" id="auth-password" name="auth-password" placeholder="Пароль" type="password" required oninvalid="setCustomValidity('Заповніть поле')" oninput="setCustomValidity('')">
                                                                        <i class="input-icon uil uil-lock-alt">
                                                                        </i>
                                                                    </input>
                                                                </div>
                                                                <input class="btn mt-4" id="auth-submit" name="auth-submit" type="submit" value="Увійти">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card card-back">
                                                    <div class="center-wrap">
                                                        <div class="section text-center">
                                                            <h4 class="mb-4 pb-3">
                                                                Реєстрація
                                                            </h4>
                                                            <?php 
                                                                if(isset($_GET['userExists']) && $_GET['userExists'])
                                                                    echo "<i class='error-message'>Користувач з таким логіном вже існує</i>";
                                                            ?>
                                                            <form action="utils/sign-up.php" id="sign-up-form" method="post" name="sign-up-form">
                                                                <div class="form-group">
                                                                    <input autocomplete="off" minlength="4" class="form-style" id="sign-up-fullname" name="sign-up-fullname" placeholder="Повне ім'я" type="text" required oninvalid="setCustomValidity('Заповніть поле')" oninput="setCustomValidity('')">
                                                                        <i class="input-icon uil uil-user">
                                                                        </i>
                                                                    </input>
                                                                </div>
                                                                <div class="form-group mt-2">
                                                                    <input autocomplete="off" minlength="4" maxlength="35" class="form-style" id="sign-up-login" name="sign-up-login" placeholder="Логін" required oninvalid="setCustomValidity('Заповніть поле')" oninput="setCustomValidity('')">
                                                                        <i class="input-icon uil uil-at">
                                                                        </i>
                                                                    </input>
                                                                </div>
                                                                <div class="form-group mt-2">
                                                                    <input autocomplete="off" minlength="4" maxlength="32" class="form-style" id="sign-up-password" name="sign-up-password" placeholder="Пароль" type="password" required oninvalid="setCustomValidity('Заповніть поле')" oninput="setCustomValidity('')">
                                                                        <i class="input-icon uil uil-lock-alt">
                                                                        </i>
                                                                    </input>
                                                                </div>
                                                                <input class="btn mt-4" id="sign-up-submit" name="sign-up-submit" type="submit" value="Зареєструватися">
                                                                </input>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include_once("footer.html");?>
    </body>
</html>
