<?php // testse/tests/


class TestingEverything extends PHPUnit_Framework_TestCase {

	  public function __call($method, $args)
         {
			    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
			    {
			        return $this->call($method, $args[0]);
			    }
			 
			  
         }
        
	 public function testFailure()
    {
        $this->assertClassHasAttribute('user', 'User');
    }
public function testPassword()
    {
        $this->assertArrayHasKey('password', array('12345' => '123456'));
    }

    public function testControler()
    {
        $this->assertFileExists('/app/controllers/UserController');
    }
    public function testgenral()
    {
    	 $this->assertInstanceOf('RuntimeException', new Exception);
    }
  
    
}