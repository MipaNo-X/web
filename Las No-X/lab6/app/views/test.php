<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
    <link rel="stylesheet" href="/assets/css/teststyle.css">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body onload="clock()">
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
                    <section class="content">
                        <p class="lead">Тест по дисциплине: Методы исследования операций</p>
                        <?if($form->success()):?>
                            <div class="row form-result">
                                <div class="col-xs-12 col-md-10 col-md-offset-1">
                                    <div class="alert alert-success"><?=$form->result()?></div>
                                </div>
                            </div>
                        <?endif;?>
                        <form name="form__test" method="post">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group <?=$form->state('name')?>">
                                        <label for="for__name">Фамилия Имя Отчество</label>
                                        <input type="text" name="name" required id="for__name" <?=$form->value('name')?>
                                               class="form-control" data-popover="Введите Фамилию Имя Отчетво(последнее при наличии)">
                                        <?=$form->hint('name')?>
                                    </div>
                                    <div class="col-xs-12 col-md-5 form-group <?=$form->state('group')?>">
                                        <label for="form__group">Группа</label>
                                        <select name="group" id="form__group" class="form-control">
                                            <option value="" disabled <?=$form->val('group') == '' ? 'selected' : ''?>>-Выберите-</option>
                                            <optgroup label="1 Курс">
                                                <option value="is11" <?=$form->selected('group','is11')?>>ИС/б-11о</option>
                                                <option value="is12" <?=$form->selected('group','is12')?>>ИС/б-12о</option>
                                                <option value="is13" <?=$form->selected('group','is13')?>>ИС/б-13о</option>
                                            </optgroup>
                                            <optgroup label="2 Курс">
                                                <option value="is21" <?=$form->selected('group','is21')?>>ИС/б-21о</option>
                                                <option value="is22" <?=$form->selected('group','is22')?>>ИС/б-22о</option>
                                                <option value="is23" <?=$form->selected('group','is23')?>>ИС/б-23о</option>
                                            </optgroup>
                                            <optgroup label="3 Курс">
                                                <option value="is31" <?=$form->selected('group','is31')?>>ИС/б-31о</option>
                                                <option value="is32" <?=$form->selected('group','is32')?>>ИС/б-32о</option>
                                                <option value="is33" <?=$form->selected('group','is33')?>>ИС/б-33о</option>
                                                <option value="is34" <?=$form->selected('group','is34')?>>ИС/б-34о</option>
                                                <option value="is35" <?=$form->selected('group','is35')?>>ИС/б-35о</option>
                                            </optgroup>
                                            <optgroup label="4 Курс">
                                                <option value="is41" <?=$form->selected('group','is41')?>>ИС/б-41о</option>
                                                <option value="is42" <?=$form->selected('group','is42')?>>ИС/б-42о</option>
                                            </optgroup>
                                        </select>
                                        <?=$form->hint('group')?>
                                    </div>
                                </div>
                                <div class="row">
                                    <br>
                                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group <?=$form->state('q1')?>">
                                        <label for="for__q1">Для чего существует класс задач линейного программирования?</label>
                                        <select name="q1" id="for__q1" class="form-control">
                                            <option value="" disabled <?=$form->val('q1') == '' ? 'selected' : ''?>>-Выберите-</option>
                                            <option value="a1" <?=$form->selected('q1','a1')?>>Для нахождения оптимальных решений задачи</option>
                                            <option value="a2" <?=$form->selected('q1','a2')?>>Для проектирования математических моделей</option>
                                            <option value="a3" <?=$form->selected('q1','a3')?>>Для изучения повседненых процеесов</option>
                                            <option value="a4" <?=$form->selected('q1','a4')?>>Для обоснования общности зависимых процессов</option>
                                            <option value="a5" <?=$form->selected('q1','a5')?>>другое</option>
                                        </select>
                                        <?=$form->hint('q1')?>
                                    </div>
                                    <div class="col-xs-12 col-md-5 form-group <?=$form->state('q2')?>">
                                        <label>Укажите к какому классу задач отностися задача о расходе топлива:</label>
                                        <br>
                                        <label class="radio-inline">
                                            <input type="radio" name="q2" id="form__count_f" value="a1" <?=$form->checked('q2','a1')?>>ЗЛП
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="q2" id="form__count_tf" value="a2" <?=$form->checked('q2','a2')?>>ЗНП
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="q2" id="form__count_ht" value="a3" <?=$form->checked('q2','a3')?>>Стохастического программирования
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="q2" id="form__count_o" value="a1" <?=$form->checked('q2','a4')?>>Динамического программирования
                                        </label>
                                        <?=$form->hint('q2')?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12 col-md-10 col-md-offset-1 form-group <?=$form->state('q3')?>">
                                        <label for="form__ans">Опишите теоремы двойственности: </label>
                                        <textarea name="q3" required id="form__ans" class="form-control" data-popover="Продолжите предложение. Ответ должен быть развернутым(не меньше 35 слов)" ><?=$form->val('q3')?></textarea>
                                        <?=$form->hint('q3')?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12 col-md-5 col-md-offset-1 form-group">
                                        <input type="submit" value="Отправить" class="form-control btn btn-block btn-my" id="bsub">
                                    </div>
                                    <div class="col-xs-12 col-md-5 form-group">
                                        <input type="button" readonly value="Очистить" class="form-control btn btn-block btn-default" id="bres">
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
<script src="/assets/js/main.js"></script>
<script src="/assets/js/clock.js"></script>
<script src="/assets/js/test_check.js"></script>
<script src="/assets/js/modal_window.js"></script>
<script src="/assets/js/popover_test.js"></script>
</body>
</html>