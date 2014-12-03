<?php
use Guzzle\Tests\GuzzleTestCase,
    Guzzle\Plugin\Mock\MockPlugin,
    Guzzle\Http\Message\Response,
    Guzzle\Http\Client as HttpClient,
    Guzzle\Service\Client as ServiceClient,
    Guzzle\Http\EntityBody;

    use Guzzle\Log\MonologLogAdapter;
    use Guzzle\Plugin\Log\LogPlugin;
    use Guzzle\Log\MessageFormatter;
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Guzzle\Http\Exception\RequestException;
use Guzzle\Http\Exception\CurlException;


class APIGuzzleTest extends GuzzleTestCase 
{
 //  protected $_client;

public function testapi()
{
    $client = new GuzzleHttp\Client(['base_url' => 'http://test.se.dev']);
$res = $client->get('/v1/users', [
    'auth' =>  ['userFname', 'userLname','userPassword','userEmail','userIsActive']
]);
echo $res->getStatusCode();           // 200
echo $res->getHeader('content-type'); // 'application/json; charset=utf8'
echo $res->getBody();                 // {"type":"User"...'
var_export($res->json());             // Outputs the JSON decoded data

}


public function testConcurrentReq()
{

	// Create a client with an optional base_url
$client = new GuzzleHttp\Client(['base_url' => 'http://test.se.dev']);

// We want to send this array of requests
$requests = [
    $client->createRequest('GET', '/v1/users'),
    $client->createRequest('DELETE', '/v1/users/1'),
    $client->createRequest('PUT', '/put', ['body' => 'test'])

];

// Note: sendAll accepts an array or Iterator
$client->sendAll($requests, [
      // Call this function when each request completes
    'complete' => function (CompleteEvent $event) {
        echo 'Completed request to ' . $event->getRequest()->getUrl() . "\n";
        echo 'Response: ' . $event->getResponse()->getBody() . "\n\n";
    },
    // Call this function when a request encounters an error
    'error' => function (ErrorEvent $event) {
        echo 'Request failed: ' . $event->getRequest()->getUrl() . "\n";
        echo $event->getException();
    },
    // Maintain a maximum pool size of 25 concurrent requests.
    'parallel' => 25
]);
}


}