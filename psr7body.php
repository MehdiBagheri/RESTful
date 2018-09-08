<?php
require  'vendor\autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request(
    'GET',
    'http://jsonplaceholder.typicode.com/posts/1'
);

var_dump($response);

echo $response->getBody()->getSize().'</br>';
echo $response->getBody()->read(20).'</br>';
echo $response->getBody()->getSize().'</br>';
