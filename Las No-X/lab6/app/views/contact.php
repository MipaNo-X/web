<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Контакт</title>
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
                        <p class="lead">Форма обратной связи</p>
                        <form name="form__contact" method="post">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group <?=$form->state('name')?>">
                                        <input type="text" placeholder="Ваша фамилия, имя, отчество..." name="name" required id="for__name" <?=$form->value('name')?>
                                               class="form-control" data-popover="Введите Фамилию Имя Отчетво(последнее при наличии)">
                                        <?=$form->hint('name')?>
                                    </div>
                                    <div class="col-xs-12 col-md-5 form-group <?=$form->state('age')?>">
                                        <div class="select">
                                            <select name="age" id="form__age" class="form-control">
                                                <option value="" disabled <?=$form->val('age') == '' ? 'selected' : ''?>>-Ваш возраст-</option>
                                                <option <?=$form->selected('age', '< 16')?>>&lt; 16</option>
                                                <option <?=$form->selected('age', '16-17')?>>16-17</option>
                                                <option <?=$form->selected('age', '18-20')?>>18-20</option>
                                                <option <?=$form->selected('age', '21-25')?>>21-25</option>
                                                <option <?=$form->selected('age', '26-35')?>>26-35</option>
                                                <option <?=$form->selected('age', '36-45')?>>36-45</option>
                                                <option <?=$form->selected('age', '46-55')?>>46-55</option>
                                                <option <?=$form->selected('age', '> 56')?>>&gt; 56</option>
                                            </select>
                                        </div>
                                        <?=$form->hint('age')?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group <?=$form->state('email')?>">
                                        <input type="email" placeholder="e-mail" name="email" required id="form__email" <?=$form->value('email')?>
                                               class="form-control" data-popover="Введите действительный адрес">
                                        <?=$form->hint('email')?>
                                    </div>
                                    <div class="col-xs-12 col-md-5 form-group <?=$form->state('dob')?>">

                                        <input type="text" placeholder="Дата рождения" name="dob" required id="form__dob" <?=$form->value('dob')?>
                                               class="form-control js-calendar" >
                                        <?=$form->hint('dob')?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group <?=$form->state('phone')?>">
                                        <input type="tel" placeholder="Телефон" name="phone" required id="form__phone" <?=$form->value('phone')?>
                                               class="form-control" data-popover="Введите номер мобильного телефона в формате +7 или +380">
                                        <?=$form->hint('phone')?>
                                    </div>
                                    <div class="col-xs-12 col-md-5 form-group <?=$form->state('sex')?>">
                                        <label>Пол</label>
                                        <br>
                                        <label class="radio-inline">
                                            <input type="radio" name="sex" value="male" id="form__sex_m" required <?=$form->checked('sex', 'male')?>>Мужской
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="sex" value="female" id="form__sex_f" required <?=$form->checked('sex', 'female')?>>Женский
                                        </label>
                                        <?=$form->hint('sex')?>
                                    </div>
                                    <div class="row">
                                        <textarea rows="10" cols="40" placeholder="Ваше сообщение..." name="text" id="message" ></textarea>
                                    </div>
                                    <br>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group">
                                        <input name="submit" type="submit" value="Отправить" class="form-control btn btn-block btn-my" id="bsub">
                                    </div>
                                    <div class="col-xs-12 col-md-5 form-group">
                                        <input type="button" readonly value="Очистить" class="form-control btn btn-block btn-default" id="bres" >
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
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/form_check.js"></script>
<script src="/assets/js/clock.js"></script>
<script src="/assets/js/main.js"></script>
<script src="/assets/js/calendar.js"></script>
<script src="/assets/js/modal_window.js"></script>
<script src="/assets/js/popover_test.js"></script>
</body>
</html>