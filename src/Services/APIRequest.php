<?php
/**
 * HTTPRequest class
 * Modeled after Eulfedora's HTTP_API_Base--https://github.com/emory-libraries/eulfedora/blob/master/eulfedora/api.py#L52-L147
 * @method [name]([[type] [parameter]<, ...>]) [<description>]
 */

// see 
// Generic Template inspired by: 
// http://www.php-fig.org/psr/psr-2/
namespace App\Services;

use Monolog\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class APIRequest
{
    protected $client;
    public $base_url = "http://192.168.42.5/WSUAPI";
    public $username;
    public $password;

    // public function __construct($base_url, $username = null, $password = null)
    public function __construct(Logger $logger, Client $client)
    {
        // Future Stuff to do about sessions go here
        $this->logger = $logger;
        $this->client = $client;
        // $this->username = $username;
        // $this->password = $password;
        // $this->base_url = $base_url;
    }

    private function request($type)
    {

        // Use logger to log activity
        $start = microtime(true);
        $response = $this->client->request($type, $this->base_url);
        $time_spent = microtime(true) - $start;
        $this->logger->info("Request took $time_spent");
        return $response;

        // $logger->error('An error occurred');
        // $logger->critical('I left the oven on!', array(
        // include extra "context" info in your logs
        // 'cause' => 'in_hurry',
    }

    public function get($view,$args=null)
    {
        $this->base_url = $this->base_url.$view;
        return $this->request('GET');
    }

    public function post()
    {
        return $this->request($base_url, 'POST');
    }

    public function put()
    {
        return $this->request($base_url, 'PUT');
    }

    public function head()
    {
        return $this->request($base_url, 'HEAD');
    }

    public function delete()
    {
        return $this->request($stuff);
    }
}
