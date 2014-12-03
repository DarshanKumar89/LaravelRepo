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


class PostTest extends GuzzleTestCase 
{

public function TestvendorsApiTest()
{
$client = new GuzzleHttp\Client();
$response = $client->post("http://test.se.dev/v1/vendors", [
    'headers' => ['content-type' => 'application/json'],
    'body'  => [

        'vendorName' => 'jack',
         'vendorLocation' => 'USA',
         'vendorType'=>'3',
         'vendorCategory'=>'3',
         'vendorCapacity'=>'3',
          'vendorCompliance' =>'sometimes',
          'vendorIECCode' =>'SE123',
          'vendorIsActive' =>'true'
          ]
]);

 
var_dump($response->getStatusCode());

}
 public function UserDeletesTest()
 {

 $client = new Guzzle\Http\Client();
 $request = $client->delete('http://test.se.dev/vendors/3');
 $response = $request->send();
 var_dump($response);
 }
}