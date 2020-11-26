<?php

use App\Http\Controllers;

$router->get('/todos/{date}', Controllers\GetTaskList::class);
$router->post('/todos/{date}', Controllers\CreateTaskList::class);
$router->patch('/lists/{listId}', Controllers\UpdateTaskList::class);
$router->delete('/lists/{listId}', Controllers\DeleteTaskList::class);

$router->post('/tasks', Controllers\CreateTask::class);
