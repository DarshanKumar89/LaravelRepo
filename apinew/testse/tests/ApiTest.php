<?php // testse/tests/




class ApiTest extends PHPUnit_Framework_TestCase {

	  public function __call($method, $args)
         {
			    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
			    {
			        return $this->call($method, $args[0]);
			    }
			 
			    // throw new BadMethodCallException;
         }

         public function testPostuser()
		{
		   $response= $this->call('POST', '/v1/session', ['userEmail' => 'a@a.com'],['userPassword'=>'12345']);

		    $this->assertEquals('c@c.com', $response);
		}
		 public function testPostuserpass()
		{
		   $response= $this->call('POST', '/v1/session', ['userEmail' => 'a@a.com'],['userPassword'=>'']);

		    $this->assertEquals('12345', $response);
		}
		 public function PostSession()
		{
		   $response= $this->call('POST', '/v1/session', ['userEmail' => ''],['userPassword'=>'']);

		    $this->assertEquals('a@a.com', $response);
		}
		
		public function testUserUpdate()
        {

            $response=  $this->call('PUT', 'v1/users/{users}', ['userFname' => 'sam'],['userLname'=>'d'],['current_password' => '12345'],['userPassword'=>'123456'],['userEmail' => 'com'],['userIsActive'=>'true']);

		    $this->assertEquals('dan', $response);

		    

        }

        public function testRolePost()
		{
		$response= $this->call('POST', '/v1/roles', ['roleName' => 'user'],['roleDesc'=>'admin'],['roleIsActive'=>'true']);

		

		   $this->assertEquals('admin', $response);
		}
		 public function testRole()
		{
		$response= $this->call('Get', '/v1/roles', ['roleName' => ''],['roleDesc'=>'admin'],['roleIsActive'=>'true']);

		

		   $this->assertEquals('admin', $response);
		}
		 public function testRoleValue()
		{
		$response= $this->call('Post', '/v1/roles', ['roleName' => ''],['roleDesc'=>''],['roleIsActive'=>'']);

		
		   $this->assertEquals('user', $response);
		  
		}
		public function testPostUserCreate()
		{
		$response = $this->call('POST', 'v1/session');
		
		$this->assertSessionHas('userPassword');
		$this->assertSessionHas('userEmail');
		

		}
		

}	