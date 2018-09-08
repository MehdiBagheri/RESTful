<?php
require 'vendor/autoload.php';
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Client;

class JsonPlaceholderPost {
    public function __construct($jsonString) {
        $decodedJsonString = json_decode($jsonString);
        $this->id = $decodedJsonString->id;
        $this->userId = $decodedJsonString->userId;
        $this->title = $decodedJsonString->title;
        $this->body = $decodedJsonString->body;
        unset($decodedJsonString);
    }

    public function __toString() {
        $string = "id: {$this->id}</br>";
        $string .= "userId: {$this->userId}</br>";
        $string .= "title: {$this->title}</br>";
        $string .= "body: {$this->body}</br>";
        return $string;
    }
}

$stack = new HandlerStack();
$stack->setHandler(\GuzzleHttp\choose_handler());

$stack->push(Middleware::mapRequest(function (RequestInterface $request) {
    return $request->withHeader('X-Custom-Header-Request', 'Modified Headers Using Middleware');
}), 'add_custom_header_request');

$stack->push(Middleware::mapResponse(function (ResponseInterface $response) {
    return $response->withHeader('X-Custom-Header-Response', 'Modified Headers Using Middleware');
}), 'add_custom_header_response');

$stack->push(Middleware::mapResponse(function (ResponseInterface $response) {
    $PostObj = new JsonPlaceholderPost($response->getBody());
    $PostStream = GuzzleHttp\Psr7\stream_for($PostObj);
    return $response->withBody($PostStream);
}), 'convert');


echo "</br>==== Full Stack ===</br>";
$client = new Client(['handler' => $stack]);
$response = $client->get('http://jsonplaceholder.typicode.com/posts/1');

echo $response->getBody();
echo "</br>";
echo "On Response: X-Custom-Header-Response: {$response->getHeaderLine('X-Custom-Header-Response')}";
echo "</br>";


echo "</br>==== Removed String Middleware ===</br>";
$stack->remove('convert');

$client = new Client(['handler' => $stack]);
$response = $client->get('http://jsonplaceholder.typicode.com/posts/1');

echo $response->getBody();
echo "</br>";
echo "On Response: X-Custom-Header-Response: {$response->getHeaderLine('X-Custom-Header-Response')}";
echo "</br>";