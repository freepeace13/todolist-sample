<?php

use App\Http\Controllers;

$router->group([
    'prefix' => 'groups'
], function ($router) {
    $router->patch('/{id:[0-9]+}', Controllers\UpdateTaskGroup::class);
    $router->delete('/{id:[0-9]+}', Controllers\DeleteTaskGroup::class);

    $router->group([
        'prefix' => '{groupId:[0-9]+}/tasks'
    ], function ($router) {
        $router->post('/', Controllers\CreateTask::class);
        $router->delete('/{taskId:[0-9]+}', Controllers\DeleteTask::class);
        $router->patch('/{taskId:[0-9]+}', Controllers\UpdateTask::class);
    });

    $router->post('/{date}', Controllers\CreateTaskGroup::class);
    $router->get('/{date}', Controllers\GetTaskGroup::class);
});

