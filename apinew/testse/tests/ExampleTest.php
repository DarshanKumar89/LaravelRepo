<?php // testse/tests/ExampleTest.php

require('TestCases.php');

class ExampleTest extends TestCases {

 public function testsourceeasy()
	 {
	 $greeting = 'Testing.';

	 $this->assertTrue($greeting === 'Testing.');
	 }

 //  public function testShouldDoLogin()
	// {
	// 	//session controller testcase
	// // provide post input

	// $credentials = array(
	//         'username'=>'b@b.com',
	//         'password'=>'12345',
	//         'csrf_token' => csrf_token()
	// );

	// $response = $this->action('POST', 'SessionController@store', null, $credentials); 

	// // if success user should be redirected to homepage
	// //$this->assertRedirectedTo('/');

	// $this->assertResponseOk();

	// }
}