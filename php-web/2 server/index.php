<?php

namespace App;

require_once '/composer/vendor/autoload.php';

// BEGIN (write your solution here)
$url = $_SERVER['REQUEST_URI'];
if (1 === preg_match("/(?i:\/about\/?)/", $url)) {
    echo '<h1>about company</h1>';
} else {
    echo '';
}
// END
