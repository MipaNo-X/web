<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link rel="stylesheet" href="/assets/css/contactstyle.css">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body onload="clock();">
<nav class="navbar">
    <div class="header">
        <div class="container">
            <div class="navbar-header">
                <div class="logotype">
                    <? if (Auth::instance()->is_guest): ?>
                        <a href="/user/sign_in">Войти</a> | <a href="/user/sign_up">Зарегистрироваться</a>
                    <? else: ?>
                        <?= Auth::instance()->user->real_name ?> | <a href="/user/sign_out">Выйти</a>
                    <? endif ?>
                    <div class="time" id="clock-cont"></div>
                </div>
            </div>
            <div id="navbar" class="collapse navbar-collapse pull-right">
                <div class="topmenu">
                    <asside>
                        <ul class="nav navbar-nav" id="menu">
                            <? if (Auth::instance()->is_admin): ?>
                                <div class="dropdown">
                                    <a href="/">Главная страница<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/home/stats">История посещений</a></li>
                                    </ul>
                                </div>
                            <?else:?>
                                <a href="/">Главная страница</a>
                            <?endif?>
                            <div class="dropdown"><a>Основное меню<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/about">Обо мне</a></li>
                                    <li><a href="/study">Учёба</a></li>
                                    <li><a href="/gallery">Фотоальбом</a></li>
                                    <li><a href="/history">История просмотров</a></li>
                                    <li><a href="/contact">Контакт</a></li>
                                </ul>
                            </div>
                            <div class="dropdown"><a>Интересы<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/interests#literature">Происхождение</a></li>
                                    <li><a href="/interests#music">Биография</a></li>
                                    <li><a href="/interests#music">Семья</a></li>
                                    <li><a href="/interests#music">Литература</a></li>
                                </ul>
                            </div>
                            <? if (!Auth::instance()->is_guest): ?>
                                <div class="dropdown">
                                    <a href="/test">Тест<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/test/result">Результаты тестов</a></li>
                                    </ul>
                                </div>
                            <?else:?>
                                <a href="/test">Тест</a>
                            <?endif?>
                            <? if (Auth::instance()->is_admin): ?>
                                <div class="dropdown">
                                    <a href="/guest">Гостевая книга<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/guest/import">Импорт записей</a></li>
                                    </ul>
                                </div>
                                <div class="dropdownsl dropdown">
                                    <a href="/blog">Блог<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/blog/create">Добавление записи</a></li>
                                        <li><a href="/blog/import">Импорт записей блога</a></li>
                                    </ul>
                                </div>
                            <? else: ?>
                                <div class="dropdown"><a href="/guest">Гостевая книга</a></div>
                                <div class="dropdown"><a href="/blog">Блог</a></div>
                            <? endif; ?>
                        </ul>
                    </asside>
                </div>
            </div>
        </div>
    </div>
</nav>

<main class="container">
    <div class="mid">
        <div class="fon">
            <div class="block">
                <div class="param">
    <section>
        <div id="content">
            <p class="lead">Добавление в блог</p>
            <div class="blog-create">
                <form class="form form__blog" name="form__blog" method="post" enctype="multipart/form-data">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-md-5 col-md-offset-1 form-group <?= $form->state('title') ?>">
                                <label for="form__title">Заголовок:</label>
                                <input type="text" name="title" required id="form__title" class="form-control"
                                    <?= $form->value('title') ?>
                                data-tip="Заголовок обязателен">
                                <?= $form->hint('title') ?>
                            </div>
                            <div class="col-xs-12 col-md-5 form-group">
                                <label for="form__image">Картинка:</label>
                                <input type="file" required name="image" id="form__image" class="form-control">
                            <?= $form->hint('image') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-10 col-md-offset-1 form-group <?= $form->state('message') ?>">
                                <label for="form__message">Текст:</label>
                                <textarea name="message" required id="form__message" rows="8"
                                          class="form-control"><?= $form->val('message') ?></textarea>
                            <?= $form->hint('message') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-2 col-md-offset-1">
                                <input type="reset" value="Очистить" class="form-control btn btn-block btn-default" id="bres">
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <input name="submit" type="submit" value="Отправить"
                                       class="form-control btn btn-block btn-primary btn-my" >
                            </div>
                            <br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
</main>


<script src="/assets/js/jquery.js"></script>
<script src="/assets//js/main.js"></script>
<script src="/assets//js/clock.js"></script>
<script src="/assets/js/modal_window.js"></script>
</body>
</html>