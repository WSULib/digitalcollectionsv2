<?php
// Application middleware
// Use to add one-off middlewares that will be run per route/group or invoking larger univeral middlewares
// that reside elsewhere
// e.g: $app->add(new \Slim\Csrf\Guard);

// See https://github.com/codeguy/Slim-Extras/tree/master/Middleware

// Reference: http://www.slimframework.com/docs/concepts/middleware.html

// Content Negotiation

/**
 * Test Data Display - Route middleware
 *
 * @param  \Slim\Http\Request 		$request  PSR7 request
 * @param  \Slim\Http\Response      $response PSR7 response
 * @param  callable                 $next     Next middleware
 *
 * @return \Slim\Http\Response
 */

use \Slim\Http\Request;
use \Slim\Http\Response;

$testMiddleware = function (Request $request, Response $response, $next) {
    $response->getBody()->write('<pre>');
    $response = $next($request, $response);
    $response->getBody()->write('</pre>');

    return $response;
};



/**
 * Media Type Parser Middleware
 * See Media Type Parsers section at http://www.slimframework.com/docs/objects/request.html#route-object
 * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
 * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
 * @param  callable                                 $next     Next middleware
 *
 * @return \Psr\Http\Message\ResponseInterface
 */

// Add the middleware
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
