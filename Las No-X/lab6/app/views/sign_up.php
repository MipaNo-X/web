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
        <p class="lead">Регистрация</p>

        <form class="form form__sign_up" name="form__sign_up" method="post">
            <div class="container-fluid">
                <?if($form->success()):?>
                <div class="row">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <div class="alert alert-success"><?= $form->result() ?></div>
                    </div>
                </div>
                <?endif?>
                <div class="row">
                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group <?= $form->state('name') ?>">
                        <input placeholder="Логин" type="text" name="name" id="form__name" class="form-control" required
                               <?= $form->value('name') ?>>
                        <?= $form->hint('name') ?>
                    </div>
                    <div class="col-xs-12 col-md-5 form-group <?= $form->state('password') ?>">

                        <input placeholder="Пароль" type="password" name="password" id="form__password" class="form-control" required
                               <?= $form->value('password') ?>>
                        <?= $form->hint('password') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group <?= $form->state('email') ?>">

                        <input placeholder="e-mail" type="email" name="email" id="form__email" class="form-control" required
                               <?= $form->value('email') ?>>
                        <?= $form->hint('email') ?>
                    </div>
                    <div class="col-xs-12 col-md-5 form-group <?= $form->state('real_name') ?>">

                        <input placeholder="Фамилия Имя Отчество" type="text" name="real_name" id="form__real_name" class="form-control" required
                               <?= $form->value('real_name') ?>>
                        <?= $form->hint('real_name') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <input type="submit" value="Зарегистрироваться" class="form-control btn btn-block btn-primary">
                    </div>
                    <br><br>
                </div>
            </div>
        </form>
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
</body>
</html>