<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

// Define named route
$app->get('/hello/{name}', function ($request, $response, $args) {
	$res = $this->guzzle->request('GET', 'https://api.github.com');
    $data = $res->getBody();
    return $this->view->render($response, 'index.html', $args, $data);
});

// Define named route
$app->get('/view/{pid}', function ($request, $response, $args) {
	$res = $this->guzzle->request('GET', "http://digital.library.wayne.edu/WSUAPI?q=$args[pid]&start=0&rows=1&wt=json
&functions%5B%5D=solrSearch");
    $args['data'] = json_decode($res->getBody(), true);
    return $this->view->render($response, 'view.html', $args);
});

// Define named route
$app->get('/json/{pid}', function ($request, $response, $args) {
	$res = $this->guzzle->request('GET', "http://digital.library.wayne.edu/WSUAPI?q=$args[pid]&start=0&rows=1&wt=json
&functions%5B%5D=solrSearch");
    echo $res->getBody();
});