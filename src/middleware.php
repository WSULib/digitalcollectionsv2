<?php
// Application middleware
// Use this file to add closure middlewares to invoke class middleware that reside in the Service directory
// e.g: $app->add(new \Slim\Csrf\Guard);
// Remember that you can invoke middleware by chaining it after $app, a route, or a group
// Keep $app invocations here to avoid cluttering up routes
// Reference: http://www.slimframework.com/docs/concepts/middleware.html


/**
 * Variable Middleware
 * Exposes useful variables and makes them available to all routes
 * Future development: retrieving current route info -- https://www.slimframework.com/docs/cookbook/retrieving-current-route.html 
 * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
 * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
 * @param  callable                                 $next     Next middleware
 *
 * @return \Psr\Http\Message\ResponseInterface
 */

use \Slim\Http\Request;
use \Slim\Http\Response;
use Slim\App;

$app->add(function (Request $request, Response $response, callable $next) {
    $uri = $request->getUri();
    $path = $uri->getPath();

    $request = $request->withAttribute('path', $path);
    $request = $request->withAttribute('uri', $uri);

    return $next($request, $response);
});

/**
 * Media Type Parser Middleware
 * See Media Type Parsers section at http://www.slimframework.com/docs/objects/request.html#route-object
 * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
 * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
 * @param  callable                                 $next     Next middleware
 *
 * @return \Psr\Http\Message\ResponseInterface
 */

// $app->add(function ($request, $response, $next) {
//     // add media parser
//     $request->registerMediaTypeParser(
//         "text/javascript",
//         function ($input) {
//             return json_decode($input, true);
//         }
//     );

//     return $next($request, $response);
// });

/**
 * PHP Debug Bar Middleware
 * Uses https://github.com/php-middleware/phpdebugbar
 * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
 * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
 * @param  callable                                 $next     Next middleware
 *
 * @return \Psr\Http\Message\ResponseInterface 
 */
$app->add(function (Request $request, Response $response, callable $next) use ($app) {

	if ($request->getQueryParam('debug') == "true") {
		$debug = $app->getContainer()->get('debugbar_middleware');
		return $debug($request, $response, $next);
	}
	else {
		return $next($request, $response);
	}

});