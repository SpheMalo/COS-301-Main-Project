<?php

require("databaseHandler.php");
require("user.php");

$response = "";
$dbHandler = new databaseHandler();
session_start();
if($dbHandler->isConnected()){

//get json string
$getJSONObject = $_REQUEST['json'];
$object = json_decode(stripslashes($getJSONObject));
//get the action flag	
$actionFlag = $object->action;


//determine the type of action
if(isset($actionFlag) && $actionFlag != ""){
    
    if($actionFlag == "register"){ // register user
        
		$Email = $object->email;
		$Role = $object->role;
        $Username = $object->username;
        $Userpassword = $object->password;
        
        $tmpUser = new user($dbHandler->getConnection());
        
        $response = $tmpUser->insertUser($Username, $Userpassword, $Email, $Role);
        
        
    }else if($actionFlag == "login"){ //login user
        
        
        $Email = $object->username;
        $Userpassword = $object->password;
        
        $tmpUser = new user($dbHandler->getConnection());
        
        $response = $tmpUser->loginUser($Email, $Userpassword);
		$logResponse = json_decode($response);
		if($logResponse->serverResponse == "success"){
			
			
			$_SESSION["UserID"] = $logResponse->UserID;
			$_SESSION["Username"] = $logResponse->Username;
			$response = "correct";
		
		}
		else{
		
			$response = "incorrect";
		}
        //responce= incorrect or correct
        
    }else if($actionFlag == "viewprofile") 
	{
		$userID = 1;
		$tmpUser = new user($dbHandler->getConnection());
		
		$response = $tmpUser->getUserInfo($userID);
	}
    
}else{
    
    $response = "no valid action specified";
}

}else{ //db connection failed   
    $response =  "dbError: database connection failed!";
}
echo json_encode($response);
?>