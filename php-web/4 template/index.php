<?php

namespace App;

require '/composer/vendor/autoload.php';

use function App\Renderer\render;

$app = new Application();

$app->get('/', function () {
    return render('index');
});

$app->get('/about', function () {
    return render('about', ['site' => 'hexlet.io']);
});

$app->run();


