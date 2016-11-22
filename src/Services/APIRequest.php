<?php
/**
 * APIRequest class
 * Modeled after Eulfedora's HTTP_API_Base--https://github.com/emory-libraries/eulfedora/blob/master/eulfedora/api.py#L52-L147
 * @method [name]([[type] [parameter]<, ...>]) [<description>]
 */

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

    public function __construct(Logger $logger, Client $client)
    {
        // Future Stuff to do about sessions go here
        $this->logger = $logger;
        $this->client = $client;
    }

    private function request($type,$params=null)
    {

        // PLACEHOLDER to sniff out if debug flag was set
        // http://docs.guzzlephp.org/en/latest/request-options.html

        // Use logger to log activity
        $start = microtime(true);
        $response = $this->client->request($type, $this->base_url, $params);
        $time_spent = microtime(true) - $start;
        $this->logger->info("Request took $time_spent");

        // parse status code
        $httpStatus = $response->getStatusCode();
        if ($httpStatus == 456) {
            // perhaps some special response if API returns a custom HTTP response code
        }

        return $response;

        // $logger->error('An error occurred');
        // $logger->critical('I left the oven on!', array(
        // include extra "context" info in your logs
        // 'cause' => 'in_hurry',
    }

    public function get($view,$params=null)
    {
        $params = ['query' => $params];
        $this->base_url = $this->base_url.$view;
        return $this->request('GET',$params);
    }

    public function post($view,$params=null)
    {
        $params = ['form_params' => $params];
        $this->base_url = $this->base_url.$view;
        return $this->request('POST',$params);
    }

    public function put()
    {
        return $this->request('PUT',$params);
    }

    public function head()
    {
        return $this->request('HEAD',$params);
    }

    public function delete()
    {
        return $this->request('DELETE',$params);
    }
}
