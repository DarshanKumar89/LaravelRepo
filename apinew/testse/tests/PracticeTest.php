<?php // testse/tests/PracticeTest.php


class PracticeTest extends PHPUnit_Framework_TestCase {

	  public function __call($method, $args)
         {
			    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
			    {
			        return $this->call($method, $args[0]);
			    }
			 
			    // throw new BadMethodCallException;
         }

    public function testsourceeasy()
	 {
	 $greeting = 'Testing.';

	 $this->assertTrue($greeting === 'Testing.');
	 }
	 public function testContinuousTests()
		 {

		 	$this->assertTrue(true);
		 }
		

		//user controller 
		 public function testGetUserIndex()
		{ 
		  $response = $this->call('GET', '/v1/users');

		//  $this->assertTrue($response->isOk()); 

		  $this->assertResponseOk();
		}
		public function testUserLoginPost()
		{
		   $response= $this->call('POST', '/v1/session', ['userEmail' => 'a@a.com'],['userPassword'=>'12345']);

		  $this->assertResponseOk();

		  // $this->assertEquals('a@a.com', $response);
		}
        public function testGetUserShow()
		{ 
		  $response = $this->call('GET', '/v1/users/{users}');

		//  $this->assertTrue($response->isOk()); 

		  $this->assertResponseOk();
		}
		  public function testGetUserUpdate()
		{ 
		  $response = $this->call('PUT', '/v1/users/{users}');

		//  $this->assertTrue($response->isOk()); 

		  $this->assertResponseOk();
		}

          public function testGetUserDelete()
		{ 
		  $response = $this->call('DELETE', '/v1/users/{users}');

		//  $this->assertTrue($response->isOk()); 

		  $this->assertResponseOk();
		}

        public function testPutUserUpdate()
        {

              $this->call('PUT', 'v1/users/2', ['userFname' => 'ku'],['userLname'=>'darshan'],['current_password' => '12345'],['userPassword'=>'123456'],['userEmail' => 'd@d.com'],['userIsActive'=>'true']);

		    $this->assertResponseOk();

        }
        
  //        public function testSuccessfulAPICall()
		// {

		//   $response = $this->call('POST', '/v1/session', ['userEmail' => 'b@b.com'],['userPassword'=>'12345']);//this is where im having difficulties
			
		//   $this->assertEquals(200, $response->status);
		//   var_dump($response);
		// }

		//session controller
		 public function testGetSessionStatus()
		{ 
		  $response = $this->call('GET', '/v1/session/status');

		 //$this->assertTrue($response->isOk()); 

		  $this->assertResponseOk();
		}
		public function testUserSessionPost()
		{
             
		   $response =$this->call('POST', '/v1/session', ['username' => 'b@b.com'],['password'=>'12345']);

		    $this->assertResponseOk();
            
		   // $this->assertEquals('b@b.com', Input::get('userEmail'));
		}

       public function testGetroles()
    {
        // this tests the controller, not the route
        $this->call('GET', 'v1/roles');
    }
}
 