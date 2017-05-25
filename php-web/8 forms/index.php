<?php

namespace App;

use function App\response;
use function App\Renderer\render;

require_once '/composer/vendor/autoload.php';

$opt = array(
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
);

$pdo = new \PDO('sqlite:/var/tmp/db.sqlite', null, null, $opt);
$repository = new CarRepository($pdo);

$app = new Application();

$app->get('/', function () use ($repository) {
    $cars = $repository->all();
    return response(render('index', ['cars' => $cars]));
});

// BEGIN (write your solution here)
$newCar = [
   'model' => '',
   'year' => ''
];

$app->get('/cars/new', function ($meta, $param, $attributes) use ($repository, $newCar) {
    return response(render('cars/new', ['car' => $newCar]));
});

$app->post('/cars', function ($meta, $param, $attributes) use ($repository) {
    $car = $param['car'];
    if (!$car['model'] || !$car['year'] ) {
        return response(render('/cars/new', ['car' => $car]))
            ->withStatus(422);
    }


});

$app->delete('/cars/:id', function ($meta, $params, $attributes) use ($repository) {
    $id = $attributes['id'];
    $repository->delete($id);
    return response()->redirect('/');
});
// END

$app->run();

