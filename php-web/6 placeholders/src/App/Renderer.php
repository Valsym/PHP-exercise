<?php

// BEGIN (write your solution here)
namespace App\Renderer;

//use function App\Template\render;

function render($template, $variables = [])
{
    $html = \App\Template\render("/usr/src/app/resources/views/" . $template . ".phtml", $variables);

    print_r($html);
}
// END
