// <?php

// require_once 'ControllerTestCase.php';
// // use Mockery;
// require "vendor/autoload.php";

class UsersControllerTest extends PHPUnit_Framework_TestCase
{

	// public function testSignupWithNoDataRedirectsAndHasErrors()
	// {
	// 	$response = $this->post('UserController@store', array());
	// 	$this->assertEquals('302', $response->foundation->getStatusCode());

	// 	$session_errors = Session::instance()->get('errors')->all();
	// 	$this->assertNotEmpty($session_errors);
	// }

	// public function testSignupWithValidDataRedirectsAndHasNoErrors()
	// {
	// 	$response = $this->post('UserController@store', array(
	// 		'userFname' => 'validusername',
	// 		'userLname' => 'validusername',
	// 		'userPassword' => 'passw0rd',
	// 		'userEmail' => 'me@validateemail.com',
	// 		'userIsActive' => 'true',
	// 	));
	// 	$this->assertEquals('302', $response->foundation->getStatusCode());

	// 	$session_errors = Session::instance()->get('errors');
	// 	$this->assertNull($session_errors);
	// }
// 	public function setUp()
// {
//   parent::setUp();
 
//   $this->mock = $this->mock('\Platform\Repositories\UserRepository');
// }
// public function mock($class)
// {
//   $mock = \Mockery::mock($class);
  
//   $this->app->instance($class, $mock);
  
//   return $mock;
// }
// public function tearDown()
//   {
//     Mockery::close();
//   }

  


// public function testIndex()
// {
//   $this->mock->shouldReceive('all')->once();
 
//   $this->call('GET', 'v1/users');
 
//   $this->assertResponseOk();
// }
// public function testIndexuser()
//   {
//     $this->call('GET', 'v1/users');
 
//     $this->assertResponseOk();
//   }
 
//   /**
//    * Test Store fails
//    */
//   public function testStoreFails()
//   {
//     $this->mock->shouldReceive('create')
//       ->once()
//       ->andReturn(Mockery::mock(array('isSaved' => false, 'errors' => array())));
 
//     $this->call('POST', 'v1/users');
 
//     $this->assertRedirectedToRoute('user.index');
//     $this->assertSessionHasErrors();
//   }
 
//   /**
//    * Test Store success
//    */
//   public function testStoreSuccess()
//   {
//     $this->mock->shouldReceive('create')
//       ->once()
//       ->andReturn(Mockery::mock(array('isSaved' => true)));
 
//     $this->call('POST', 'v1/users');
 
//     $this->assertRedirectedToRoute('users.index');
//     $this->assertSessionHas('flash');
//   }

}
