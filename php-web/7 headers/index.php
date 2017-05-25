<?php

namespace App;

require_once '/composer/vendor/autoload.php';

use function App\response;
use function App\Renderer\render;

$users = [
    1 => [
        ['id' => 3, 'name' => 'john'],
        ['id' => 4, 'name' => 'ada']
    ]
];

$app = new Application();

$app->get('/', function () use ($users) {
    return response(render('index', ['friends' => $users[1]]));
});

$app->post('/users', function ($meta, $params, $attributes) {
    if (!isset($params['email'])) {
        return response('Expected email')->withStatus(400);
    }
    return response()->redirect('/');
});

$app->get('/users/:id/friends', function ($meta, $params, $attributes) use ($users) {
    if (!isset($users[$attributes['id']])) {
        return response(['error' => 'message not found'])->withStatus(404)->format('json');
    }
    $response = response($users[$attributes['id']])->format('json');
    return $response;
});

$app->run();
