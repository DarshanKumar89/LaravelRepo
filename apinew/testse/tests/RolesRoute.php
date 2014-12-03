<?php // testse/tests/


class RolesRoute extends PHPUnit_Framework_TestCase {

	  public function __call($method, $args)
         {
			    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
			    {
			        return $this->call($method, $args[0]);
			    }
			 
			  
         }

         public function testGetRoleIndex()
		{ 
		  $response = $this->call('GET', '/v1/roles');

		//  $this->assertTrue($response->isOk()); 

		  $this->assertResponseOk();
		}
		public function testRolePost()
		{
		$response= $this->call('POST', '/v1/roles', ['roleName' => 'admin'],['roleDesc'=>'admin'],['roleIsActive'=>'true']);

		  $this->assertResponseOk();

		   $this->assertEquals('admin', $response);
		}
     

        public function testGetRoleIndex()
		{ 
		  $response = $this->call('GET', '/v1/roles/{roles}');

		$this->assertTrue($response->isOk()); 

		  $this->assertResponseOk();
		}
		 public function testRoleDelete()
		{ 
		  $response = $this->call('DELETE', '/v1/roles/{roles}');

		  $this->assertResponseOk();
		}

        public function testPutRoleUpdate()
        {

              $this->call('PUT', '/v1/roles/{roles}',['roleName' => 'admin'],['roleDesc'=>'admin'],['roleIsActive'=>'true']);

		    $this->assertResponseOk();

        }

         public function RolePostCheck()
		{
		$response = $this->call('GET', 'user/profile');

     $response = $this->call($method, $uri, $parameters, $files, $server, $content);
		}
   }