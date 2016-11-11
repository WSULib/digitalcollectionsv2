<?php
/**
 * HTTPRequest class
 * Modeled after Eulfedora's HTTP_API_Base--https://github.com/emory-libraries/eulfedora/blob/master/eulfedora/api.py#L52-L147
 */

// see 
// Generic Template inspired by: 
// http://www.php-fig.org/psr/psr-2/
// namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class APIRequest
{
    // protected $client;

    public function __constructor($base_url, $username = null, $password = null)
    {
        // Stuff to do about sessions go here
        $this->username = $username;
        $this->password = $password;
        $this->base_url = $base_url;
    }

    private function request($type)
    {
        // a generic client
        $this->$client = new Client([
            'url' => $this->$base_url
            ]);

        // Use logger to log activity
        $logger = $this->get('logger');

        $start = microtime(true);
        $response = $this->$client->request($type);
        $time_spent = microtime(true) - $start;
        $logger->info("Request took $time_spent");
        return $time_spent;

        // $logger->error('An error occurred');
        // $logger->critical('I left the oven on!', array(
        // include extra "context" info in your logs
        // 'cause' => 'in_hurry',
    }

    public function get()
    {
        return $this->request('GET');
    }

    public function post()
    {
        return $this->request('POST');
    }

    public function put()
    {
        return $this->request('PUT');
    }

    public function head()
    {
        return $this->request('HEAD');
    }

    public function delete()
    {
        return $this->request($stuff);
    }
}
