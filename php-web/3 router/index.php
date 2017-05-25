<?php

namespace App;

require_once '/composer/vendor/autoload.php';

$app = new Application();

$app->get('/companies', function () {
    return 'companies list';
});

$app->post('/companies', function () {
    return 'company was created';
});

$app->run();

