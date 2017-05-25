Цель: Познакомиться с понятием роутинга. Создать основу для описания маршрутов и их обработки.

Задание
x
Application.php
x
Другой способ добавлять обработчики маршрутов в App это использовать методы, названные по именам глаголов http. Например $app->get($path, $func).

src/App/Application.php

Реализуйте интерфейс ApplicationInterface в классе Application.

Пример:

<?php

$app = new \App\Application();

$app->get('/', function () {
    return 'hello, world!';
});

$app->post('/sign_in', function () {
    return 'sign in';
});

$app->run();

Подсказки

$_SERVER['REQUEST_METHOD'] - содержит текущий http метод.





