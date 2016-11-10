<?php
// Routes

$app->get('/', function ($req, $response, $args) {
    $this->logger->warning('Foo');
    $this->logger->error('Bar');
  // return $response->withStatus(302)->withHeader('Location', '/digitalcollections');
});

// Test routes //////
// Generic named route
$app->get('/hello/{name}', function ($request, $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/test/[{myvar}]', function ($request, $response, $args = []) {
    $myvar1 = $request->getParam('myvar'); //checks both _GET and _POST [NOT PSR-7 Compliant]
    $myvar2 = $request->getParsedBody()['myvar']; //checks _POST  [IS PSR-7 compliant]
    $myvar3 = $request->getQueryParams()['myvar']; //checks _GET [IS PSR-7 compliant]
    $response->getBody()->write($myvar3);
    // echo $myvar3;
    return $response;
});
// END test routes /////////

// SEARCH VIEW
$app->get('/search/{query}', function ($request, $response, $args) {
    $response = $this->guzzle->request('GET', "http://digital.library.wayne.edu/WSUAPI?q=$args[query]&start=0&rows=1&wt=json
&functions%5B%5D=solrSearch");
    $args['data'] = json_decode($res->getBody(), true);

    return $this->view->render($response, 'item.html', $args);
});

// ITEM VIEW
$app->get('/item/{pid}', function ($request, $response, $args) {
    $response = $this->guzzle->request('GET', "http://digital.library.wayne.edu/WSUAPI?q=$args[pid]&start=0&rows=1&wt=json
&functions%5B%5D=solrSearch");
    $args['data'] = json_decode($res->getBody(), true);

    return $this->view->render($response, 'item.html', $args);
});

// DATA DISPLAY
// Candidate for Route group (/metadata)
// JSON data display
$app->get('/item/{pid}/metadata', function ($request, $response, $args) {
    $response = $this->guzzle->request('GET', "http://digital.library.wayne.edu/WSUAPI?q=$args[pid]&start=0&rows=1&wt=json
&functions%5B%5D=solrSearch");
    // seamlessly passes through JSON response and headers...?
    return $response;
});

// messy XML data display
$app->get('/item/{pid}/xml', function ($request, $response, $args) {
    $json = $this->guzzle->request('GET', "http://digital.library.wayne.edu/WSUAPI?q=$args[pid]&start=0&rows=1&wt=json
&functions%5B%5D=solrSearch");
    // echo $request->getQueryParams()['paramName'];
    function array2xml($array, $xml = false)
    {
        if ($xml === false) {
            $xml = new SimpleXMLElement('<result/>');
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                array2xml($value, $xml->addChild($key));
            } else {
                $xml->addChild($key, $value);
            }
        }

        return $xml->asXML();
    }

    $json = json_decode($json->getBody(), true);
    $xml = array2xml($json, false);
    $response->withHeader('Content-type', 'text/xml');
    $response->getBody()->write($xml);

    return $response;
});

// LOGIN
$app->get('/login', function ($req, $response, $args) {
    return $this->view->render($response, 'login.html', $args);
});

$app->group('/auth', function () {
    $this->map(['GET', 'POST'], '/login', 'App\controllers\AuthController:login');
    $this->map(['GET', 'POST'], '/logout', 'App\controllers\AuthController:logout');
    $this->map(['GET', 'POST'], '/signup', '');
});
