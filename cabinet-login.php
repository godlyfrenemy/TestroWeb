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
            Кабінет
        </title>
        <meta charset="utf-8">
            <link href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico" rel="shortcut icon" type="image/x-icon">
                <link color="#111" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" rel="mask-icon">
                    <link href="https://codepen.io/ig_design/pen/KKVQpVP?editors=1000" rel="canonical">
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
                            <link href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css" rel="stylesheet">
                                <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeConsoleRunner-6bce046e7128ddf9391ccf7acbecbf7ce0cbd7b6defbeb2e217a867f51485d25.js">
                                </script>
                                <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-44fe83e49b63affec96918c9af88c0d80b209a862cf87ac46bc933074b8c557d.js">
                                </script>
                                <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRuntimeErrors-4f205f2c14e769b448bcf477de2938c681660d5038bc464e3700256713ebe261.js">
                                </script>
                                <link href="styles/cabinet-login.css" rel="stylesheet" type="text/css">
                                <?php include_once("utils/common-head.php"); ?>
                            </link>
                        </link>
                    </link>
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
                        <div class="row full-height justify-content-center">
                            <div class="col-12 text-center">
                                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                                    <h6 class="mb-0 pb-3">
                                        <span>
                                            Log In
                                        </span>
                                        <span>
                                            Sign Up
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
                                                                    <input autocomplete="off" minlength="4" class="form-style" id="sign-up-name" name="sign-up-name" placeholder="Повне ім'я" type="text" required oninvalid="setCustomValidity('Заповніть поле')" oninput="setCustomValidity('')">
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
    <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js">
    </script>
    <script crossorigin="" src="https://cdpn.io/cpe/boomboom/pen.js?key=pen.js-12418115-cb79-680a-4d0c-fddbd1adbe10">
    </script>
</html>
