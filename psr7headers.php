<?php
require  'vendor\autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request(
    'GET',
    'http://jsonplaceholder.typicode.com/posts/1'
);

if($response->hasHeader('Content-Type')){
    $header = GuzzleHttp\Psr7\parse_header($response->getHeader('Content-Type'));
    foreach ($header as $value)
    {
        if(array_key_exists('charset', $value)){
            echo $value['charset'];
        }
    }
}


