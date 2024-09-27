<?php
$app = app()->router;

$app->group([
    'namespace' => 'App\Web\Controllers',
    'prefix' => ''
], function () use ($app) {
    $app->get('/','IndexController@index');
});


