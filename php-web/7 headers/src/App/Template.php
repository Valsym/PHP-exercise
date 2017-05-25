<?php

namespace App\Template;

function render($template, $variables)
{
    // BEGIN (write your solution here)
    extract($variables); // берет массив и каждый элемент делает переменной, в которую записывает её значение
    ob_start(); // буферизация вывода
    include $template;
    return ob_get_clean(); // делает вывод и очищает буфер обмена
    // END
}
