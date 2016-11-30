<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    return $this->view->render($response, 'index.html', $args);
});

// SEARCH VIEW
$app->get('/search', function ($request, $response, $args) {
    $api = $this->APIRequest->get("/search",$request->getQueryParams());
    return $api;

    // $args['data'] = json_decode($api->getBody(), true);

    // return $this->view->render($response, 'search.html', $args);
});

// COLLECTIONS VIEW
$app->get('/collections/[{pid}]', function ($request, $response, $args = []) {
    $api = $this->APIRequest->get($request->getAttribute('path'),$request->getQueryParams());
    // $args['data'] = json_decode($api->getBody(), true);
    // return $this->view->render($response, 'search.html', $args);
});

// SINGLE ITEM/RECORD VIEW
$app->get('/item/{pid}', function ($request, $response, $args) {
    $api = $this->APIRequest->get($request->getAttribute('path'));
    $args['data'] = json_decode($api->getBody(), true);
    return $this->view->render($response, 'item.html', $args);
});

// DATA DISPLAY
// JSON data display
$app->get('/item/{pid}/metadata', function ($request, $response, $args) {
    $api = $this->APIRequest->get("/item/$args[pid]");
    // seamlessly passes through JSON response and headers
    return $api;
});