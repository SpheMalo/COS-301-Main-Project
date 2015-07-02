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
        $Username = $object->username;
        $Userpassword = $object->password;
        
        $tmpUser = new user($dbHandler->getConnection());
        
        $response = $tmpUser->insertUser($Username, $Userpassword, $Email);
        
        
    }else if($actionFlag == "login"){ //login user
        
        
        $Email = $object->email;
        $Userpassword = $object->password;
        
        $tmpUser = new user($dbHandler->getConnection());
        
        $response = $tmpUser->loginUser($Email, $Userpassword);
        
        
    }
    
}else{
    
    $response = "no valid action specified";
}

}else{ //db connection failed   
    $response =  "dbError: database connection failed!";
}
echo json_encode($response);
?>