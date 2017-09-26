<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('', function ($request, $response, $args) {
    echo '<h1>Books API</h1>';
});