<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Интересы</title>
    <link rel="stylesheet" href="/assets/css/intereststyle.css">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body onload="load_list(); clock();">
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
            <p><a name="top"></a></p>
            <div class="block">
                <div class="param">
                    <section id="content" class="text-left">
                        <h3>Содержание</h3>
                        <div>
                            <<?=$list['type']?> id="list-cont">
                            <?foreach($list['list_el'] as $li):?>
                            <li>
                                <a href="<?=$li['href']?>"><?=$li['text']?></a>
                                <?if(isset($li['children'])):?>
                                <<?=$li['children']['type']?>>
                                <?foreach($li['children']['list_el'] as $li2):?>
                            <li>
                                <a href="<?=$li2['href']?>"><?=$li2['text']?></a>
                            </li>
                        <?endforeach;?>
                        </<?=$li['children']['type']?>>
                        <?endif;?>
                        </li>
                        <?endforeach;?>
                    </<?=$list['type']?>>
                </div>
                </section>
                <section class="text-justify">
                    <h1>Гернгрос, Александр Родионович</h1>
                    <p>Александр Родионович Гернгрос (1813—1904) — горный инженер, генерал-лейтенант, директор Департамента Горных и Соляных Дел.</p>

                    <p><a name="born"></a></p>
                    <h2>Происхождение</h2>
                    <p>Из старинного лифляндского дворянского рода. Гернгрос — русский дворянский род, происходящий из Нидерландов, откуда предки его переселились в XVI в. в Лифляндию. Иоанн Гернгрос был в конце XVII века шведским полковником. Александр и брат Андрей — сыновья генерала-майора Гернгроса Родиона Федоровича, шефа Митавского драгунского полка, участника Отечественной войны 1812 года, кавалера орденов Святого Георгия 4-го класса (26.11.1810) и Святого Георгия 3-го класса (15.11.1813).
                    </p>
                    <p><a name="#bio"></a></p>
                    <h2>Биография</h2>
                    <p>
                        В 1832 году окончил Горный Кадетский Корпус и был направлен на Екатеринбургские горные заводы.
                        В 1833 году был переведен на Алтайские (Колывано-Воскресенские) заводы. Занимался поисками полезных ископаемых. Особый интерес представляет его экспедиция в Приволжские районы для поисков и оценки месторождений асфальта (1837), давшая первые научные результаты по нефтеносности этого района.
                        В 1835 году адъютант Главного начальника Алтайских заводов Е. П. Ковалевского. Находился в партиях по отысканию золотых россыпей, служил приставом Касминского и Успенского промыслов, Зыряновского и Змеиногорского рудников.
                        В 1837 году — первый исследователь нефтеносности Поволжья.
                        В 1839 году проводил геологические исследования в западной части Киргиз-Кайсацкой степи (Казахстан).
                        С 1845 года проходил службу в Департаменте Горных и Соляных Дел (ДГиСД).
                        В 1850 году — начальник отделения частных золотых промыслов ДГиСД.
                        В 1855 году — вице-директор ДГиСД.
                        В 1860 году генерал-майор Гернгрос возглавлял Комиссию в Илецкую Защиту для установления контроля за добычей и продажей соли и обследования частных горных заводов Оренбургского края.
                        В 1855—1861 гг. — директор ДГиСД.
                        В 1861 году произведён в генерал-лейтенанты.
                        С 1862 года, и после выхода в отставку (1865), состоял членом Горного совета и Горного ученого комитета.
                        С 1865 года в отставке, директор Правления Санкт-Петербургского общества страхования.
                        С 1866 года — член Мануфактур-совета.
                        Автор публикаций в Горном Журнале.
                    </p>

                    <p><a name="#fam"></a></p>
                    <h2>Семья</h2>
                    <p>
                        Жена, Екатерина Алексеевна. Сыновья: Александр (1853) и Евгений (1855).
                    </p>

                    <p><a name="#lit"></a></p>
                    <h2>Литература</h2>
                    <p>
                        Версилов Н. П. Александр Родионович Гернгрос (некролог). — ГЖ, 1905, т.1, № 2;
                        Лоранский А. М. Краткий исторический очерк административных учреждений горного ведомства в России 1700—1900 гг. СПб., 1900;
                        Заблоцкий Е. М. Гернгросы. — Немцы России: энциклопедия. Т.1. М., 1999;
                        Кострин К. Экспедиция штабс-капитана Гернгроса. — Нефтяник, 1969, № 8.
                    </p>
                    <p><a name="#top">Наверх</a></p>
                </section>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    </div>
</main>
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/interests.js"></script>
<script src="/assets/js/clock.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>