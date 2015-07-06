<?php

require("databaseHandler.php");
require("user.php");

$response = "";
$dbHandler = new databaseHandler();

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
        $Userpassword = md5($object->password);
        
        $tmpUser = new user($dbHandler->getConnection());
        
        $response = $tmpUser->insertUser($Username, $Userpassword, $Email, $Role);
        
        
    }else if($actionFlag == "login"){ //login user
        
        
        $Email = $object->username;
        $Userpassword = md5($object->password);
        
        $tmpUser = new user($dbHandler->getConnection());
        
        $response = $tmpUser->loginUser($Email, $Userpassword);
		$logResponse = json_decode($response);
		if($logResponse->serverResponse == "success"){
			
			session_start();
			$_SESSION["UserID"] = $logResponse->UserID;
			$_SESSION["Username"] = $logResponse->Username;
			$response = "correct";
		
		}
                else if($logResponse->serverResponse == "not_active"){
                    $response = "not_active";
                }
		else{
		
			$response = "incorrect";
		}
        //responce= incorrect or correct
        
    }
    
}else{
    
    $response = "no valid action specified";
}

}else{ //db connection failed   
    $response =  "dbError: database connection failed!";
}
echo json_encode($response);
?>