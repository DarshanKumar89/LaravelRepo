<?php // testse/tests/


class VendorBaccountTest extends PHPUnit_Framework_TestCase {

	  public function __call($method, $args)
         {
			    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
			    {
			        return $this->call($method, $args[0]);
			    }
			 
			  
         }
          public function testGetVendorbaccountIndex()
        { 
		  $response = $this->call('GET', 'v1/vendors/1/baccount');

		  $this->assertResponseOk();
		}
        
       	public function testVendorbaccountPost()
		{
		$response= $this->call('POST', 'v1/vendors/1/baccount', ['bAccountBank' => 'Citibank'],['bAccountName'=>'dan'],['bAccountNumber'=>'12345'],['bAccountBranch'=>'Bangalore'],['bAccountIFSC'=>'SE123'],['bAccountType'=>'saving']);

		 $this->assertEquals('Citibank',$response);

        
		}
       public function testVendorbaccountPost1()
		{
		$response= $this->call('POST', 'v1/vendors/1/baccount',['bAccountBank' => 'Citibank'],['bAccountName'=>'dan'],['bAccountNumber'=>'12345'],['bAccountBranch'=>'Bangalore'],['bAccountIFSC'=>'SE123'],['bAccountType'=>'saving']);

		 $this->assertEquals('ICIC',$response);

        
		}
		 public function testbaccountCity1()
		{
		$response= $this->call('POST', 'v1/vendors/1/baccount',['bAccountBank' => 'Citibank'],['bAccountName'=>'dan'],['bAccountNumber'=>'12345'],['bAccountBranch'=>'Bangalore'],['bAccountIFSC'=>'SE123'],['bAccountType'=>'saving']);

		 $this->assertEquals('BSK',$response);

        
		}
		
      public function testVendorbaccountNo()
		{
		$response= $this->call('POST', 'v1/vendors/1/baccount',['bAccountBank' => 'Citibank'],['bAccountName'=>'dan'],['bAccountNumber'=>'12345'],['bAccountBranch'=>'Bangalore'],['bAccountIFSC'=>'SE123'],['bAccountType'=>'saving']);

		 $this->assertEquals('EF12300',$response);

        
		}
			public function VendorbaccountIFCcode()
		{
		$response= $this->call('post', 'v1/vendors/1/baccount',['bAccountBank' => 'Citibank'],['bAccountName'=>'dan'],['bAccountNumber'=>'12345'],['bAccountBranch'=>'Bangalore'],['bAccountIFSC'=>'SE123'],['bAccountType'=>'saving']);

		 $this->assertEquals('IFSC1298',$response);

        
		}
		public function VendorbaccountBankPut()
		{
		$response= $this->call('put', 'v1/vendors/1/baccount',['bAccountBank' => 'HDFC'],['bAccountName'=>'John'],['bAccountNumber'=>'12345'],['bAccountBranch'=>'Bangalore'],['bAccountIFSC'=>'SE123'],['bAccountType'=>'saving']);

		 $this->assertEquals('Citibank',$response);

        
		}
		public function VendorbaccountPut()
		{
		$response= $this->call('put', 'v1/vendors/1/baccount',['bAccountBank' => 'Citibank'],['bAccountName'=>'dan'],['bAccountNumber'=>'12345'],['bAccountBranch'=>'Bangalore'],['bAccountIFSC'=>'SE123'],['bAccountType'=>'saving']);

		 $this->assertEquals('sam',$response);

        
		}
		public function testGetVendorbaccountDelete()
        { 
		  $response = $this->call('DELETE', 'v1/vendors/1/baccount');

		  $this->assertResponseOk($response);
		}
		public function testGetVendorbaccountshow()
        { 
		  $response = $this->call('GET', 'v1/vendors/1/baccount/1');

		  $this->assertResponseOk();
		}
     }
       