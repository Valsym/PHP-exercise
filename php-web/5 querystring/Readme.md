Цель: Рассмотреть параметры запроса, как они обрабатываются и как сочетаются с роутингом.



Задание
x
public/index.php

Реализуйте маршрут /, который может принимать параметр sort и выполнять сортировку $data в соответствии с содержимым этого параметра. Формат sort: field direction. field - название поля, direction - либо asc либо desc. Пример: id desc.

Отдаваемые данные должны кодироваться в json с помощью функции json_encode.

Пример:

<?php

$data = [
    ['id' => 4, 'age' => 15],
    ['id' => 3, 'age' => 28],
    ['id' => 8, 'age' => 3],
    ['id' => 1, 'age' => 23]
];

$actual = file_get_contents('http://localhost:8080?sort=age+desc');

$expected = [
    ['id' => 3, 'age' => 28],
    ['id' => 1, 'age' => 23],
    ['id' => 4, 'age' => 15],
    ['id' => 8, 'age' => 3]
];

json_encode($expected) == $actual







