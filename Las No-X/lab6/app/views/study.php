<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Учёба</title>
    <link rel="stylesheet" href="/assets/css/studystyle.css">
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
            <div class="logouniv">
                <img src="assets/img/university.png" alt="Логитп СГУ" title="Логотип СГУ">
            </div>
            <h1>Севастопольский государственный университет</h1>
            <h2>Кафедра информационных систем</h2>
            <div class="block">
                <div class="param">
                    <section>
                        <table>
                            <caption>Перечень изучаемых дисциплин с 1 по 4 семестр.</caption>
                            <tr>
                                <td rowspan="3">№</td>
                                <td rowspan="3">Дисциплина</td>
                                <td colspan="12">Часов в неделю<br>(лекций, лаб.раб, практ. раб)</td>
                            </tr>
                            <tr>
                                <td colspan="6">1 курс</td>
                                <td colspan="6">2 курс</td>
                            </tr>
                            <tr>
                                <td colspan="3">1 сем</td>
                                <td colspan="3">2 сем</td>
                                <td colspan="3">1 сем</td>
                                <td colspan="3">2 сем</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Экология</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>1</td>
                                <td>0</td>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Высшая математика</td>
                                <td>3</td>
                                <td>0</td>
                                <td>3</td>
                                <td>3</td>
                                <td>0</td>
                                <td>3</td>
                                <td>2</td>
                                <td>0</td>
                                <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Русский язык и культура речи</td>
                                <td>1</td>
                                <td>0</td>
                                <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Основы дискретной математики</td>
                                <td>2</td>
                                <td>0</td>
                                <td>1</td>
                                <td>3</td>
                                <td>0</td>
                                <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Основы программирования и алгоритмические языки</td>
                                <td>3</td>
                                <td>2</td>
                                <td>0</td>
                                <td>3</td>
                                <td>3</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Основы экологии</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Теория вероятностей и математическая статистика</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>3</td>
                                <td>1</td>
                                <td>0</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Физика</td>
                                <td>2</td>
                                <td>2</td>
                                <td>0</td>
                                <td>2</td>
                                <td>2</td>
                                <td>0</td>
                                <td>2</td>
                                <td>1</td>
                                <td>0</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Основы электротехники и электроники</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>2</td>
                                <td>1</td>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Численные методы в информатике</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>2</td>
                                <td>2</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td><a href="/test"> Методы исследования операций</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>1</td>
                                <td>1</td>
                                <td>0</td>
                                <td>2</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                        </table>
                    </section>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</main>
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/clock.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>