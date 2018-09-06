<?php
require  'vendor\autoload.php';

use GuzzleHttp\Client;

$client = new Client();
try {


    $response = $client->request(
        'GET',
        'https://httpbin.org/status/503'
    );

    var_dump($response);

    echo $response->getBody();
}catch (\Guzzle\Exception\ClientException $exception)
{
    echo $exception->getCode(). "\r\n";
    echo $exception->getMessage(). "\r\n";
}catch (\Guzzle\Exception\ServerException $serverException)
{
    echo $exception->getCode(). "\r\n";
    echo $exception->getMessage(). "\r\n";
}