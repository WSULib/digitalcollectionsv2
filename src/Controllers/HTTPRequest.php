<?php
/**
 * HTTPRequestController class
 */

// see https://github.com/emory-libraries/eulfedora/blob/master/eulfedora/api.py#L52-L147
// Generic Template inspired by: https://github.com/akrabat/slim3-skeleton/blob/master/app/src/Action/HomeAction.php
// http://www.php-fig.org/psr/psr-2/
namespace App\Controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class HTTPRequestController
{
    public function hello()
    {
        $response->getBody()->write('Hello');
        $this->view->render($response);
        return $response;
    }
}
