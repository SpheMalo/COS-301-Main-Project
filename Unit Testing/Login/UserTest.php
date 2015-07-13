<?php

namespace phpUnit\Test;

use scripts\FigbookActionHandler\user;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testLoginUser()
    {
        $username = 'Mjimaro';
        $password = 'Ntate';

        $user = new user();

        $result = $user->loginUser($username,$password);

        foreach (json_decode($result) as $object)
		{
  			foreach ($object as $property=>$value)
   			{
     			switch ($property) {
        			case 'serverResponse':            
        				$this->assertEquals($value,"success");
            			break;
        			case 'Username':
        			 	$this->assertEquals($value, "Armand");
            			break;
        			case 'Email':
       					$emailNull = ($value == null);

        			 	$this->assertEquals($emailNull, false);
            			break;
            		case 'UserID':
            			$userID = ($value == null);
            			$this->assertEquals($userID, false);
            			break;
     			}
   			} 
		}
       
    }

    public function testIsActive(){
    	$user = new user();
    	$result = $user->isActive("Mjimaro");

    	$this->assertEquals($result, false);
    }

    public function testInsertUser(){
    	$user = new user();
    	$uname = "Kim";
    	$upassword = "kimello";
    	$uemail = "kim@gmail.com";
    	$urole = 1;

    	$result = $user->insertUser($uname, $upassword, $uemail, $urole);

    	foreach (json_decode($result) as $object){
  			foreach ($object as $property=>$value)
   			{
     			switch ($property) {
        			case 'serverResponse': 
						$this->assertEquals($value, "success");
						break;
				}
			}
		}
    }

}