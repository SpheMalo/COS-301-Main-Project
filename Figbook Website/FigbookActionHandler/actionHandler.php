<?php

require("databaseHandler.php");
require("user.php");
require("view_profile.php")


$dbHandler = new databaseHandler();

if($dbHandler->isConnected()){

//get json string
$getJSONObject = $_REQUEST['json'];
$object = json_decode(stripslashes($getJSONObject));
//get the action flag	
$actionFlag = $object->action;


//determine the type of action
if(isset($actionFlag) && $actionFlag != ""){
    
    if($actionFlag == "insertUser"){ // register user
        
		$name  = $object->name;
        $surname  = $object->surname;
		$Email = $object->email;
        $Username = $object->username;
        $Userpassword = $object->password;
        
        $tmpUser = new user($dbHandler->getConnection());
        
        $tmpUser->insertUser($name, $surname, $Username, $Userpassword, $Email);
        
        
    }else if($actionFlag == "login"){ //login user
        
        
        $Email = $object->email;
        $Userpassword = $object->password;
        
        $tmpUser = new user($dbHandler->getConnection());
        
        $tmpUser->loginUser($Email, $Userpassword);
        
        
    }else if ($actionFlag == "view_profile"){
		
		$userInfo = viewProfile($dbHandler, $object->username);
	}
		
    
}else{
    
    die("no valid action specified");
}

}else{ //db connection failed   
    echo "dbError: database connection failed!";
}

?>