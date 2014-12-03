<?php // testse/tests/


class VendorTest extends PHPUnit_Framework_TestCase {

	  public function __call($method, $args)
         {
			    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
			    {
			        return $this->call($method, $args[0]);
			    }
			 
			  
         }
         
		public function testVendorPost()
		{
		$response= $this->call('POST', '/v1/vendors', ['vendorName' => 'jon player'],['vendorLocation'=>'hydrabad'],['vendorType'=>'2'],['vendorCategory'=>'2'],['vendorCapacity'=>'2'],['vendorCompliance'=>'correct'],['vendorIECCode'=>'b'],['vendorIsActive'=>'true']);

		  $this->assertResponseOk();

		  
		}

        public function testGetVendorIndex()
		{ 
		  $response = $this->call('GET', '/v1/vendors/{vendors}');

		  $this->assertResponseOk();
		}
		 public function testVendorDelete()
		{ 
		  $response = $this->call('DELETE', '/v1/vendors/{vendors}');

		  $this->assertResponseOk();
		}

        public function testPutVendorUpdate()
        {

              $this->call('PUT', '/v1/vendors/{vendors}', ['vendorName' => 'jon player'],['vendorLocation'=>'hydrabad'],['vendorType'=>'2'],['vendorCategory'=>'2'],['vendorCapacity'=>'2'],['vendorCompliance'=>'correct'],['vendorIECCode'=>'b'],['vendorIsActive'=>'true']);

		    $this->assertResponseOk();

        }
     public function testFailureVendor()
	    {
	    	 $response=$this->call('PUT', '/v1/vendors/{vendors}', ['vendorName' => 'jon player'],['vendorLocation'=>'hydrabad'],['vendorType'=>'2'],['vendorCategory'=>'2'],['vendorCapacity'=>'2'],['vendorCompliance'=>'correct'],['vendorIECCode'=>'b'],['vendorIsActive'=>'true']);

	        $this->assertEquals('bangalore',$response);
	    }
	    public function vendorpostdata()
	    {

	    	$response= $this->call('POST', '/v1/vendors', ['vendorName' => 'jon player'],['vendorLocation'=>'hydrabad'],['vendorType'=>'2'],['vendorCategory'=>'2'],['vendorCapacity'=>'2'],['vendorCompliance'=>'correct'],['vendorIECCode'=>'b'],['vendorIsActive'=>'true']);
             $this->assertEquals('johnplayers',$response);
	    }
	    public function testExceptionHasRightMessage()
    {
        $this->setExpectedException(
          'InvalidArgumentException', 'Right Message'
        );
        throw new InvalidArgumentException('Some Message', 10);
    }

    public function testExceptionMessageMatchesRegExp()
    {
        $this->setExpectedException(
          'InvalidArgumentException', '/Right.*/', 10
        );
        throw new InvalidArgumentException('The Wrong Message', 10);
    }

    public function testExceptionHasRightCode()
    {
        $this->setExpectedException(
          'InvalidArgumentException', 'Right Message', 20
        );
        throw new InvalidArgumentException('The Right Message', 10);
    }
    public function testException() {
        try {
          $response= $this->call('POST', '/v1/vendors', ['vendorName' => 'jon player'],['vendorLocation'=>'hydrabad'],['vendorType'=>'2'],['vendorCategory'=>'2'],['vendorCapacity'=>'2'],['vendorCompliance'=>'correct'],['vendorIECCode'=>'b'],['vendorIsActive'=>'true']);
             $this->assertEquals('johnplayers',$response);
        }

        catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }
     public function testException2() {
        try {
          $response= $this->call('POST', '/v1/vendors', ['vendorName' => 'jon player'],['vendorLocation'=>'hydrabad'],['vendorType'=>'2'],['vendorCategory'=>'2'],['vendorCapacity'=>'2'],['vendorCompliance'=>'correct'],['vendorIECCode'=>'b'],['vendorIsActive'=>'true']);
             $this->assertEquals('bangalore',$response);
        }

        catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }


    public function testExpectVendorActualName()
    {
        $this->expectOutputString('johnplayers');
        print 'john';
    }
    public function testExpectVendorActualLocation()
    {
        $this->expectOutputString('hydrabad');
        print 'bangalore location';
    }
    public function testExpectVendorActualType()
    {
        $this->expectOutputString('clothing apparels');
        print 'hoods';
    }
   
}