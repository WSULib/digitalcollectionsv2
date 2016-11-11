<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    $response = $this->APIRequest->hello('Cole');
    return $response;
});

// SEARCH VIEW
$app->get('/search/{query}', function ($request, $response, $args) {
    $guzzle = $this->guzzle->request('GET', "http://digital.library.wayne.edu/WSUAPI?q=$args[query]&start=0&rows=1&wt=json
&functions%5B%5D=solrSearch");
    $args['data'] = json_decode($guzzle->getBody(), true);

    return $this->view->render($response, 'item.html', $args);
});

// COLLECTIONS VIEW
$app->get('/collections/[{query}]', function ($request, $response, $args = []) {
    // request data from API
    $response = $request->getQueryParam('query', $default = null);
    return $response;
})->add($test);

// SINGLE ITEM/RECORD VIEW
$app->get('/item/{pid}', function ($request, $response, $args) {
    $guzzle = $this->guzzle->request('GET', "http://digital.library.wayne.edu/WSUAPI?q=$args[pid]&start=0&rows=1&wt=json
&functions%5B%5D=solrSearch");
    $args['data'] = json_decode($guzzle->getBody(), true);

    return $this->view->render($response, 'item.html', $args);
});

// DATA DISPLAY
// JSON data display
$app->get('/item/{pid}/metadata', function ($request, $response, $args) {
    $this->HTTPRequest->get('http://digital.library.wayne.edu/WSUAPI?q=$args[pid]&start=0&rows=1&wt=json&functions%5B%5D=solrSearch');
    // $response = $this->guzzle->get("http://digital.library.wayne.edu/WSUAPI?q=$args[pid]&start=0&rows=1&wt=json&functions%5B%5D=solrSearch");
    // seamlessly passes through JSON response and headers...?
    return $response;
});


// User
$app->get('/login', function ($req, $response, $args) {
    return $this->view->render($response, 'login.html', $args);
});

$app->get('/logout', function ($req, $response, $args) {
    return $response->withStatus(302)->withHeader('Location', '/auth/logout');
});

$app->group('/auth', function () {
    $this->map(['GET', 'POST'], '/login', 'App\controllers\AuthController:login');
    $this->map(['GET', 'POST'], '/logout', 'App\controllers\AuthController:logout');
    $this->map(['GET', 'POST'], '/signup', '');
});
