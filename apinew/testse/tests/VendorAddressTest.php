<?php // testse/tests/


class VendorAddressTest extends PHPUnit_Framework_TestCase {

	  public function __call($method, $args)
         {
			    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
			    {
			        return $this->call($method, $args[0]);
			    }
			 
			  
         }
          public function testGetVendorAddressIndex()
        { 
		  $response = $this->call('GET', 'v1/vendors/1/address');

		  $this->assertResponseOk();
		}
        
       	public function testVendorAddressPost()
		{
		$response= $this->call('POST', 'v1/vendors/1/address', ['addressLabel' => 'work'],['addressLine1'=>'bsk'],['addressLine2'=>'bda'],['addressCity'=>'Bangalore'],['addressState'=>'karanataka'],['addressZip'=>'560061'],['addressCountry'=>'India']);

		 $this->assertEquals('work',$response);

        
		}
       public function testVendorAddressPost1()
		{
		$response= $this->call('POST', 'v1/vendors/1/address',['addressLabel' => 'office'],['addressLine1'=>'bsk'],['addressLine2'=>'bda'],['addressCity'=>'Bangalore'],['addressState'=>'karanataka'],['addressZip'=>'560061'],['addressCountry'=>'India']);

		 $this->assertEquals('work',$response);

        
		}
		 public function testVendorCity1()
		{
		$response= $this->call('POST', 'v1/vendors/1/address',['addressLabel' => 'office'],['addressLine1'=>'bsk'],['addressLine2'=>'bda'],['addressCity'=>'Bangalore'],['addressState'=>'karanataka'],['addressZip'=>'560061'],['addressCountry'=>'India']);

		 $this->assertEquals('hydrabad',$response);

        
		}
		
      public function testVendorAddressLine()
		{
		$response= $this->call('POST', 'v1/vendors/1/address', ['addressLabel' => 'office'],['addressLine1'=>'bsk'],['addressLine2'=>'bda'],['addressCity'=>'Bangalore'],['addressState'=>'karanataka'],['addressZip'=>'560061'],['addressCountry'=>'India']);

		 $this->assertEquals('bsk1st',$response);

        
		}
			public function VendorAddressPincode()
		{
		$response= $this->call('post', 'v1/vendors/1/address',['addressLabel' => 'office'],['addressLine1'=>'bsk'],['addressLine2'=>'bda'],['addressCity'=>'Bangalore'],['addressState'=>'karanataka'],['addressZip'=>'560061'],['addressCountry'=>'India']);

		 $this->assertEquals('560078',$response);

        
		}
		public function VendorAddressCityPut()
		{
		$response= $this->call('put', 'v1/vendors/1/address',['addressLabel' => 'office'],['addressLine1'=>'bsk'],['addressLine2'=>'bda'],['addressCity'=>'Bangalore'],['addressState'=>'karanataka'],['addressZip'=>'560061'],['addressCountry'=>'India']);

		 $this->assertEquals('India',$response);

        
		}
		public function VendorAddressPut()
		{
		$response= $this->call('put', 'v1/vendors/1/address',['addressLabel' => 'office'],['addressLine1'=>'bsk'],['addressLine2'=>'bda'],['addressCity'=>'Bangalore'],['addressState'=>'karanataka'],['addressZip'=>'560061'],['addressCountry'=>'India']);

		 $this->assertEquals('USA',$response);

        
		}
		public function testGetVendoraddressDelete()
        { 
		  $response = $this->call('DELETE', 'v1/vendors/1/address');

		  $this->assertResponseOk($response);
		}
		public function testGetVendoraddressshow()
        { 
		  $response = $this->call('GET', 'v1/vendors/1/address/1');

		  $this->assertResponseOk();
		}
     }
       