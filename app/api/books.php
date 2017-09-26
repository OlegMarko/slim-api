<?php

/**
 * Show all books
 */
$app->get('/api/v1/books', function ($request, $response, $args) {

    // Require DB connect
    require 'dbconnect.php';

    $query = "SELECT * FROM books ORDER BY id";
    $result = $mysqli->query($query);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($data));
});

/**
 * Show single row
 */
$app->get('/api/v1/books/{id}', function ($request, $response, $args) {

    // Require DB connect
    require 'dbconnect.php';

    $id = $args['id'];

    $query = "SELECT * FROM books WHERE id = $id";
    $result = $mysqli->query($query);

    $data = $result->fetch_assoc();

    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($data));
});

/**
 * Create row
 *
 * args: title, author, url
 */
$app->post('/api/v1/books', function ($request, $response) {

    // Require DB connect
    require 'dbconnect.php';

    $request_data = $request->getParsedBody();

    $query = "INSERT INTO `books` (`title`, `author`, `url`) VALUES (?, ?, ?)";
    $post = $mysqli->prepare($query);

    $a = $request_data['title'];
    $b = $request_data['author'];
    $c = $request_data['url'];

    $post->bind_param("sss", $a, $b, $c);

    $result = $post->execute();

    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($result));
});

$app->put('/api/v1/books/{id}', function ($request, $response, $args) {

    // Require DB connect
    require 'dbconnect.php';

    $request_data = $request->getParsedBody();

    $id = $args['id'];

    $query = "UPDATE `books` SET `title` = ?, `author` = ?, `url` = ? WHERE `books`.`id` = $id";
    $post = $mysqli->prepare($query);

    $a = $request_data['title'];
    $b = $request_data['author'];
    $c = $request_data['url'];

    $post->bind_param("sss", $a, $b, $c);

    $result = $post->execute();

    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($result));
});

/**
 * Delete row
 */
$app->delete('/api/v1/books/{id}', function ($request, $response, $args) {
    // Require DB connect
    require 'dbconnect.php';

    $id = $args['id'];

    $query = "DELETE FROM `books` WHERE `books`.`id` = $id";
    $result = $mysqli->query($query);

    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($result));
});