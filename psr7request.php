<?php
/**
 * Filename: ${NAME}.
 * User: Mehdi Bagheri
 * Date: Sep, 2018
 */
require 'vendor/autoload.php';

use GuzzleHttp\Psr7\Request;

$request = new Request(
    'GET',
    'http://jsonplaceholder.typicode.com/posts/1'
    );

echo $request->getUri() . '<br>';
echo $request->getUri()->getScheme() . '<br>';
echo $request->getUri()->getPort() . '<br>';
echo $request->getUri()->getHost() . '<br>';
echo $request->getUri()->getPath() . '<br>';