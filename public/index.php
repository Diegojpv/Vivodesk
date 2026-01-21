<?php
// We start the session to access session variables.
session_start();
?>

<!DOCTYPE html>
<!-- ============================ Vivodesk Home Page ============================ -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vivodesk: Free open-source CRM for client management and meetings. Streamline your sales and customize your workflow with our software available on GitHub.">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <title>Vivodesk</title>
</head>
<body>
    <div class="background">
        <img src="assets/img/management.webp" alt="" class="active">
        <img src="assets/img/follow.webp" alt="">
        <img src="assets/img/organize.webp" alt="">
        <img src="assets/img/customize.webp" alt="">
    </div>

    <header class="header__content">
            <div class="header__logo">
                <h1>Vivodesk</h1>
            </div>
            <div class="header__user-control">
                <a href="#" class="user-control__wrapper user" id="user-link">
                    <img src="assets/img/user.webp" alt="">
                    <p>
                        <?php
                        echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; 
                        ?>
                    </p>
                </a>
                <div class="user-control__wrapper log-out">
                    <img src="assets/img/log-out.webp" alt="">
                    <p>Log out</p>
                </div>
            </div>
    </header>

    <main>
        <section class="section-hero">
            <div class="hero-content hero-content__wrapper">
                <div class= "hero-content__text-container" id="stack">
                    <div class="text-container__cards">
                        <h2>Title 1</h2>
                        <hr>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate voluptatibus laborum error, eos unde sapiente et explicabo sunt atque, soluta voluptates quam reprehenderit nesciunt ad tempore aperiam adipisci dolorum repellat!</p>
                    </div>

                    <div class="text-container__cards">
                        <h2>Title 2</h2>
                        <hr>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate voluptatibus laborum error, eos unde sapiente et explicabo sunt atque, soluta voluptates quam reprehenderit nesciunt ad tempore aperiam adipisci dolorum repellat!</p>
                    </div>

                    <div class="text-container__cards">
                        <h2>Title 3</h2>
                        <hr>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate voluptatibus laborum error, eos unde sapiente et explicabo sunt atque, soluta voluptates quam reprehenderit nesciunt ad tempore aperiam adipisci dolorum repellat!</p>
                    </div>

                    <div class="text-container__cards">
                        <h2>Title 4</h2>
                        <hr>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate voluptatibus laborum error, eos unde sapiente et explicabo sunt atque, soluta voluptates quam reprehenderit nesciunt ad tempore aperiam adipisci dolorum repellat!</p>
                    </div>
                </div>
                <a class=" hero-content__button" id="workdesk-link"> 
                    <div class="button__wrapper">
                        <p class="hero-content__button--link">Work desk</p>
                    </div>
                    <div href="#" class="button__wrapper">
                        <img src="assets/img/arrow-icon.webp" alt="">
                    </div>
                </a>
            </div>
            <div class="hero-content hero-content__form">
                    <div class="form__user-register">
                        <p>New user</p>
                        <div class="user-register__wrapper">
                            <label for="user-register__button" class="user-register__label">
                                <span class="user-register__cube"></span>
                            </label>
                        </div>
                        <p>Log in</p>
                    </div>
                <input type="checkbox" class="user-register__checkbox" id="user-register__button">
                <div class="form__wrapper form-card__new-user">
                    <form class="form__new-user" id="form__new-user">
                        <hr>
                        <div class="form-input username__input">
                            <input type="text" placeholder="Username" id="new-username" name="new-username">
                        </div>

                        <div class="form-input password__input">
                            <input type="password" placeholder="Password" id="new-password" name="new-password">  
                        </div>

                        <div class="form-input confirm-password__input">
                            <input type="password" placeholder="Confirm password" id="confirm-password" name="confirm-password">
                        </div>

                        <div class="signed-in__wrapper">
                            <input type="checkbox" class="signed-in__checkbox" id="create-user__signed-in">
                            <label for="create-user__signed-in">Keep me signed in</label>
                        </div>

                        <div>
                        <!--From Uiverse.io by mrhyddenn -->  
                            <button class="button new-user__button" id="new-user__button">
                                <span class="button_lg">
                                    <span class="button_sl"></span>
                                    <span class="button_text">Create user</span>
                                </span>
                            </button>
                        </div>
                        <hr>
                    </form>
                </div>

                <div class="form__wrapper form-card__log-in">
                    <form class="form__log-in" id="form__log-in">
                        <hr>
                        <div class="form-input username__input">
                            <input type="text" placeholder="Username" id="username" name="username">
                        </div>

                        <div class="form-input password__input">
                            <input type="password" placeholder="Password" id="password" name="password">  
                        </div>

                        <div class="signed-in__wrapper">
                            <input type="checkbox" class="signed-in__checkbox" id="log-in__signed-in">
                            <label for="log-in__signed-in">Keep me signed in</label>
                        </div>

                        <div>
                            <!-- From Uiverse.io by mrhyddenn --> 
                            <button class="button log-in__button" id="log-in__button">
                                <span class="button_lg">
                                    <span class="button_sl"></span>
                                    <span class="button_text">Log in</span>
                                </span>
                            </button>
                        </div>
                        <hr>
                    </form>
                </div>
                

            </div>
        </section>
    </main>

    <footer>
            <div class="footer__links">
                <a class="footer__github-link">
                    <img src="assets/img/github-white-icon.webp" alt="">
                </a>

                <a class="footer__linkedin-link">
                    <img src="assets/img/linkedin-icon.webp" alt="">
                </a>
            </div>

            <div class="footer__information">
                <div class="information__documentation">
                    <p>Documentation</p>
                    <img src="assets/img/documentation.webp" alt="">
                </div>
                <div class="information__more-info">
                    <p>More information</p>
                    <img src="assets/img/help.webp" alt="">
                </div>
            </div>
    </footer>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/form.js"></script>
</body>
</html>