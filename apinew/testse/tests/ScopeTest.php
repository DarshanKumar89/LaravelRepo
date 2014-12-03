<?php // testse/tests/


class ScopeTest extends PHPUnit_Framework_TestCase {

	  public function __call($method, $args)
         {
			    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
			    {
			        return $this->call($method, $args[0]);
			    }
			 
			  
         }

         public function testGetScopeIndex()
		{ 
		  $response = $this->call('GET', '/v1/scopes');

		//  $this->assertTrue($response->isOk()); 

		  $this->assertResponseOk();
		}
		public function testScopePost()
		{
		$response= $this->call('POST', '/v1/scopes', ['scopeId' => '2'],['scopeName' => 'user'],['scopeDesc'=>'user rights'],['scopePerm'=>'2'],['scopeIsActive'=>'true']);

		 //  $this->assertEquals('user', $response);
		 $this->assertResponseOk();
             
		  
		}

		public function testGetScope()
		{ 
		  $response = $this->call('GET', '/v1/scopes/{scopes}');

		  $this->assertResponseOk();
		}
		 public function testScopeDelete()
		{ 
		  $response = $this->call('DELETE', '/v1/roles/{roles}');

		  $this->assertResponseOk();
		}

        public function testPutScopeUpdate()
        {

              $this->call('PUT', '/v1/roles/{roles}',['scopeId' => '2'],['scopeName' => 'user'],['scopeDesc'=>'user previlages'],['scopePerm'=>'2'],['scopeIsActive'=>'true']);

		    $this->assertResponseOk();

        }
}