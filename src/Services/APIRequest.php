<?php
/**
 * APIRequest class
 * A direct method by which to communicate with the WSUDOR API. Harnesses Guzzle and Monolog to communicate and log activity.
 * Modeled after Eulfedora's HTTP_API_Base
 * @param  object $logger the logging interface
 * @param  object $client the guzzle client instance
 */

namespace App\Services;

use Monolog\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

class APIRequest
{
    protected $client;
    public $base_url = "http://192.168.42.5/WSUAPI";
    public $username;
    public $password;
/**
 * Constructor
 * @param Logger $logger Monolog logging
 * @param Client $client Guzzle Client
 * @return void
 */
    public function __construct(Logger $logger, Client $client)
    {
        // Future Stuff to do about sessions go here
        $this->logger = $logger;
        $this->client = $client;
    }

    /**
     * Make an HTTP request to WSUDOR API
     * Note: private method
     *
     * @param  string $type HTTP 1.1 Methods (GET, POST, etc)
     * @param  array|null $params an optional series of HTTP parameters
     * @return object PSR-7 response object via Guzzle library
     */

    private function request($type, $params = null)
    {

        // PLACEHOLDER to sniff out if debug flag was set
        // http://docs.guzzlephp.org/en/latest/request-options.html

        // logger interface logs activity; indicate log level through logger->info, error, or critical
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
    }

    /**
     * Send a GET request
     * @param  string $view  The Route that initialized this request (/action/PID/sub-action)
     * @param  array $params Associative array of parameters
     * @return object PSR-7 response object via Guzzle library
     */
    public function get($view, $params = null)
    {
        $params = ['query' => $params];
        $this->base_url = $this->base_url.$view;
        return $this->request('GET', $params);
    }

    /**
     * Send a POST request
     * @param  string $view  The Route that initialized this request (/action/PID/sub-action)
     * @param  array $params Associative array of parameters
     * @return object PSR-7 response object via Guzzle library
     */
    public function post($view, $params = null)
    {
        $params = ['form_params' => $params];
        $this->base_url = $this->base_url.$view;
        return $this->request('POST', $params);
    }

    /**
     * Send a HEAD request - e.g. retrieves headers from endpoint
     * @param  string $view  The Route that initialized this request (/action/PID/sub-action)
     * @param  array $params Associative array of parameters
     * @return object PSR-7 response object via Guzzle library
     */
    public function head($view, $params = null)
    {
        $params = ['query' => $params];
        $this->base_url = $this->base_url.$view;
        return $this->request('HEAD', $params);
    }
}
