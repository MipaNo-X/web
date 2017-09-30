<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Импорт гостевой книги</title>
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
        <p class="lead">Импорт гостевой книги</p>
	    <?if($result !== false):?>
            <div class="row form-result">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <div class="alert alert-<?=$result['type']?>"><?=$result['message']?></div>
                </div>
            </div>
	    <?endif;?>
        <form name="form__contact" method="post" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-7 col-md-offset-1 form-group">
                        <label for="form__file">Файл:</label>
                        <input type="file" name="file" required id="form__file" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-3 form-group">
                        <label>Опции:</label>
                        <br>
                        <label class="checkbox-inline" for="form__rewrite">
                            <input type="checkbox" name="rewrite" value="true"
                                   id="form__rewrite"> Перезаписать
                        </label>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group">
                        <input name="submit" type="submit" value="Отправить" class="form-control btn btn-block btn-my"
                               id="bsub">
                    </div>
                    <div class="col-xs-12 col-md-5 form-group">
                        <input type="button" readonly value="Очистить" class="form-control btn btn-block btn-default"
                               id="bres">
                    </div>
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

<footer class="footer">
    <div class="container">
        <p class="text-muted pull-right">Паникарчик М. В. &copy; 2017</p>
        <p class="text-muted pull-left">Разработано в рамках дисциплины "WEB технологии"</p>

    </div>
</footer>
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/form_check.js"></script>
<script src="/assets/js/clock.js"></script>
<script src="/assets/js/main.js"></script>
<script src="/assets/js/calendar.js"></script>
<script src="/assets/js/modal_window.js"></script>
<script src="/assets/js/popover_test.js"></script>
</body>
</html>