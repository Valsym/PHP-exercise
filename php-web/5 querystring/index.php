<?php

namespace App;

require_once '/composer/vendor/autoload.php';

$app = new Application();

$data = [
    ['id' => 4, 'age' => 15],
    ['id' => 3, 'age' => 28],
    ['id' => 8, 'age' => 3],
    ['id' => 1, 'age' => 23]
];

// BEGIN (write your solution here)
$app->get('/', function () use (&$data) {
    if ($query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY)) {

        function build_sorter($key, $direction) {
            return function ($a, $b) use ($key, $direction) {
                if ($direction == 'asc') {
                    return strnatcmp($a[$key], $b[$key]);
                } else {
                    return 0 - strnatcmp($a[$key], $b[$key]);
                }
            };
        }
        $field = '';$direction = '';
        if (strstr($query, 'id')) $field = 'id';
        if (strstr($query, 'age')) $field = 'age';
        if (strstr($query, 'asc')) $direction = 'asc';
        if (strstr($query, 'desc')) $direction = 'desc';

        if (($field == 'id' || $field == 'age')
            && ($direction == 'asc' || $direction == 'desc')) {
                usort($data, build_sorter($field, $direction));
        }
    }
    return json_encode($data);
});
// END

$app->run();


