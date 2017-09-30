<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Обо мне-Автобиография  </title>
    <link rel="stylesheet" href="/assets/css/aboutstyle.css">
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
                        <p>
                            Многолетние травянистые водные растения, до 30—40 см длиной. Корневище ползучее, ветвистое, около 1 мм в диаметре. Стебли цилиндрические, дихотомически ветвистые; междоузлия короткие или удлинённые, 1—6 см длиной. Листья прозрачные, все погруженные в воду, простые, от ланцетных до яйцевидных, (0,5)1—3(6) см длиной и 0,3—0,8(1,5) см шириной, с 3(7) жилками, сидячие, с полустеблеобъемлющим основанием, кверху суженные, острые или тупые, сближены и расположены почти супротивно или по 3 в ложных мутовках, без влагалищ и без прилистников (лишь верхние прицветные листья могут быть с двураздельными прилистниками).
                        </p>
                        <p>
                            Цветки обоеполые, актиноморфные, собраны в немногоцветковое, из 2—4(8) цветков, колосовидное соцветие 1,5—5 см длиной, шарообразной или шаровидно-яйцевидной формы, на ножке 0,5—1(1,5) см длиной; прицветники отсутствуют. Околоцветник из 4 свободных долей. Тычинок 4, с выростом связника треугольной формы; пыльники почти сидячие. Гинецей апокарпный, из 4 свободных плодолистиков; рыльца сидячие. Плод состоит из 1—4 орешковидных, односемянных, округло-почковидных плодиков, 2,5—3 мм длиной и 2 мм шириной; сдавленные или сплюснутые с боков, килеватые на спинке, с изогнутым носиком 0,2—0,5(1) мм длиной. Зародыш спирально изогнутый.
                        </p>
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

</body>
</html>