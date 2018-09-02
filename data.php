<?php
require  'vendor\autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request(
    'POST',
    'http://jsonplaceholder.typicode.com/posts',
    [
        'json' => [
            'title' => 'Guzzle and REST',
            'body' => 'Guzzle makes working whit REST APIs easy.',
            'userId' =>2
        ],
    ]
);

var_dump($response);

echo $response->getBody();