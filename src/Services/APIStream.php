<?php
/**
 * APIStream class
 * A direct method by which to communicate with the WSUDOR API and stream responses. Harnesses Guzzle and Monolog to communicate and log activity.
 * @param  object $logger the logging interface
 * @param  object $client the guzzle client instance
 */

namespace App\Services;

use Monolog\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Exception\RequestException;

class APIStream
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

		// pseudocode from http://docs.guzzlephp.org/en/latest/psr7.html#body
		$response = $this->client->request('GET', 'http://httpbin.org/get');

		// echo $response->getBody()->read(4);
		// echo $response->getBody()->read(4);
		// echo $response->getBody()->read(1024);
		// var_export($response->eof());

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

}