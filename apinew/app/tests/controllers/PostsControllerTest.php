<?php


// require_once '../vendor/<span class="skimlinks-unlinked">autoload.php</span>';


class PostsControllerTest extends PHPUnit_Framework_TestCase {
 
//  public function setup()
// {


// }

// public function test_mockery()
// {

//   $mock=Mockery::mock('controllers\UserController');
//   $mock->shouldReceive('index')->once()->andReturn('mocked');
//   var_dump($mock->index());
// }
 public function __construct()
{
    //$this->mock = \Mockery::mock('Eloquent', 'User');
}

  public function setUp()
    {
        parent::setUp();
        $this->mock = \Mockery::mock('Eloquent', 'User');
 
        $_ENV['DB_HOST'] = 'localhost';
        $_ENV['DB_NAME'] = 'se_db';
        $_ENV['DB_USERNAME'] = 'root';
        $_ENV['DB_PASSWORD'] = 'asdf';
 
    }
 
    public function tearDown()
    {
        Mockery::close();
    }
 
    public function testStoreSuccess()
    {
        // Establish us as Admin (user_id == 1)
        $user = Sentry::findUserByID(1);
        Sentry::setUser($user);
 
        Input::replace($input = ['userFname' => 'darshan',
            'userLname' => 'kumar','userPassword' => '12345','userEmail' => 'b@b.com','userIsActive' => 'true'
        ]);
 
        $this->mock
            ->shouldReceive('store')
            ->once()
            ->with($input);
 
        $this->app->instance('User', $this->mock);
 
        $this->call('POST', 'v1/user', $input);
 
        $this->assertRedirectedToRoute('v1.users.index', null, ['flash']);
    }
}