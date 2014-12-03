<?php
//require_once "PHPUnit/Autoload.php";

 include "app/model/User.php";
class UserTest extends PHPUnit_Framework_TestCase
{
//protected $user;
public function test() {
        $expected = "";
        $actual = $this->User->getAuthPassword();
        $this->assertEquals($expected, $actual);
    }
}