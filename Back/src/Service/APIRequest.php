<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class APIRequest
{
    private $url = 'https://api.themoviedb.org/3/movie';
    private $token = 'c89646cb9c2f9f7a6144c074fff0e9c7';

    public function request($url, $method, $headers = [])
    {
        $client = HttpClient::create();
        $request = $client->request($method, $this->getUrl() . '/' . $url, [
            'headers' => array_merge($headers, [
                'Accept' => 'application/json'
            ]),
            'query' => [
                'api_key' => $this->getToken()
            ]
        ]);

        return json_decode($request->getContent(), true);
    }

    /**
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }
}
