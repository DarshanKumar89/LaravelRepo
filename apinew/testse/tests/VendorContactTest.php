<?php // testse/tests/


class VendorContactTest extends PHPUnit_Framework_TestCase {

	  public function __call($method, $args)
         {
			    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
			    {
			        return $this->call($method, $args[0]);
			    }
			 
			  
         }
        
         public function testGetVendorcontactIndex()
        { 
		  $response = $this->call('GET', 'v1/vendors/1/contact');

		  $this->assertResponseOk();
		}
        
       	public function testVendorcontactPost()
		{
		$response= $this->call('POST', 'v1/vendors/1/contact', ['contactName' => 'ayush'],['contactDesignation'=>'sourceeasy'],['contactEmail'=>'a@a.com'],['contactPhone1'=>'12345'],['contactPhone2'=>'1234567']);

		 $this->assertEquals('developer',$response);

        
		}
       public function testVendorcontactPost1()
		{
		$response= $this->call('POST', 'v1/vendors/1/contact', ['contactName' => 'ayush'],['contactDesignation'=>'sourceeasy'],['contactEmail'=>'a@a.com'],['contactPhone1'=>'12345'],['contactPhone2'=>'1234567']);

		 $this->assertEquals('darshan',$response);

        
		}
		 public function testVendorcontactNo1()
		{
		$response= $this->call('POST', 'v1/vendors/1/contact', ['contactName' => 'ayush'],['contactDesignation'=>'sourceeasy'],['contactEmail'=>'a@a.com'],['contactPhone1'=>'9900568729'],['contactPhone2'=>'1234567']);

		 $this->assertEquals('99005687',$response);

        
		}
		
      public function testVendorcontactNo()
		{
		$response= $this->call('POST', 'v1/vendors/1/contact', ['contactName' => 'ayush'],['contactDesignation'=>'sourceeasy'],['contactEmail'=>'a@a.com'],['contactPhone1'=>'9900568729'],['contactPhone2'=>'1234567']);

		 $this->assertEquals('ab',$response);

        
		}
			public function VendorcontactPost()
		{
		$response= $this->call('post', 'v1/vendors/1/contact', ['contactName' => 'ayush'],['contactDesignation'=>'sourceeasy'],['contactEmail'=>'a@a.com'],['contactPhone1'=>'12345'],['contactPhone2'=>'1234567']);

		 $this->assertEquals('ayush',$response);

        
		}
		public function VendorcontactPut()
		{
		$response= $this->call('put', 'v1/vendors/1/contact', ['contactName' => 'veera'],['contactDesignation'=>'dev'],['contactEmail'=>'a@a.com'],['contactPhone1'=>'98566'],['contactPhone2'=>'1234567']);

		 $this->assertEquals('bheema',$response);

        
		}
		public function testGetVendorcontactDelete()
        { 
		  $response = $this->call('DELETE', 'v1/vendors/1/contact');

		  $this->assertResponseOk();
		}
		public function testGetVendorcontactshow()
        { 
		  $response = $this->call('GET', 'v1/vendors/1/contact/1');

		  $this->assertResponseOk();
		}
     }