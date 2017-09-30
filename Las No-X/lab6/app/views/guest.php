<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Гостевая книга</title>
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
        <p class="lead">Форма сообщений</p>
        <form name="form__contact" method="post">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group <?= $form->state( 'name' ) ?>">

                        <input placeholder="Фамилия Имя Отчество" type="text" name="name" required id="for__name" <?= $form->value( 'name' ) ?>
                               class="form-control" data-popover="Введите Фамилию Имя Отчетво(последнее при наличии)">
						<?= $form->hint( 'name' ) ?>
                    </div>
                    <div class="col-xs-12 col-md-5 form-group <?= $form->state( 'email' ) ?>">
                        <input placeholder="e-mail" type="email" name="email" required id="form__email" <?= $form->value( 'email' ) ?>
                               class="form-control" data-popover="Введите действительный адрес">
						<?= $form->hint( 'email' ) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-10 col-md-offset-1 form-group <?= $form->state( 'text' ) ?>">
                        <textarea placeholder="Ваше сообщение..." name="text" required id="form__message"
                                  class="form-control"><?= $form->val( 'text' ) ?></textarea>
						<?= $form->hint( 'text' ) ?>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group">
                        <input name="submit" type="submit" value="Отправить" class="form-control btn btn-block btn-my"
                               id="bsub">
                        <br>
                    </div>
                    <br>
                    <div class="col-xs-12 col-md-5 form-group">
                        <input type="button" readonly value="Очистить" class="form-control btn btn-block btn-default"
                               id="bres">
                    </div>
                    <br>
                </div>
            </div>
        </form>
		<? if ( ! empty( $messages ) ): ?>
            <section id="messages" class="container-fluid">
                <div class="message row">
                    <div class="message-head col-xs-12 col-md-offset-1 col-md-3">
                        Фамилия Имя Отчество<br>
                        <span class="text-muted message-date">Дата</span>
                    </div>
                    <div class="message-body col-xs-12 col-md-7">Сообщение</div>
                </div>
				<? foreach ( $messages as $message ): ?>
                    <div class="message row">
                        <div class="message-head col-xs-12 col-md-offset-1 col-md-3">
                            <a href="mailto:<?= $message['email'] ?>"
                               class="message-author"><?= $message['last_name'] . ' ' . $message['first_name'] . ' ' . $message['middle_name'] ?></a>
                            <br>
                            <span class="text-muted message-date"><?= $message['date']->format( 'h:i:s d.m.Y' ) ?></span>
                        </div>
                        <div class="message-body col-xs-12 col-md-7"><?= $message['text'] ?></div>
                    </div>
				<? endforeach ?>
            </section>
		<? else: ?>
            <div class="alert alert-info">Сообщения не найдены</div>
		<? endif ?>
    </section>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</main>


<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/form_check.js"></script>
<script src="/assets/js/clock.js"></script>
<script src="/assets/js/main.js"></script>
<script src="/assets/js/calendar.js"></script>
<script src="/assets/js/modal_window.js"></script>
<script src="/assets/js/popover_test.js"></script>
</body>
</html>