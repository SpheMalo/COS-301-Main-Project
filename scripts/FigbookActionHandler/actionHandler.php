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

//change account status
function accountStatus($id, $status, $dbHandler) //To do: select from user get required fields/values to use in the function.
{
	$tmpUser = new user($dbHandler->getConnection());
	return $tmpUser->updateUser($id,'$uname','$upassword','$uemail','$urole', $status);	
}

//determine the type of action
if(isset($actionFlag) && $actionFlag != ""){
    
    if($actionFlag == "register"){ // register user
        
		$Email = $object->email;
		$Role = $object->role;
        $Username = $object->username;
        $Userpassword = md5($object->password);
        
        $tmpUser = new user($dbHandler->getConnection());
        
        $response = $tmpUser->insertUser($Username, $Userpassword, $Email, $Role);
        
        
    }
	
	else if($actionFlag == "viewprofile"){
		$uID = $_COOKIE['username'];
		$tmpUser = new user($dbHandler->getConnection());
		
		$response = ($tmpUser->getUserInfo($uID));
	
	}elseif ($actionFlag == "updateAboutMe"){
		$uID = $_COOKIE['username'];
		$tmpUser = new user($dbHandler->getConnection());
		
		$response = ($tmpUser->updateAboutMe($uID, $object));
	}elseif ($actionFlag == "updatePortfolioInfo"){
		$uID = $_COOKIE['username'];
		$tmpUser = new user($dbHandler->getConnection());
		
		$response = ($tmpUser->updatePortfolioInfo($uID, $object));
	}elseif ($actionFlag == "updateContactInfo"){
		$uID = $_COOKIE['username'];
		$tmpUser = new user($dbHandler->getConnection());
		
		$response = ($tmpUser->updateContactInfo($uID, $object));
	}else if($actionFlag == "login"){ //login user
        
        
        $Email = $object->username;
        $Userpassword = substr(md5($object->password), 0, 25);
        
        $tmpUser = new user($dbHandler->getConnection());
        
        $response = $tmpUser->loginUser($Email, $Userpassword);
		$logResponse = json_decode($response);
		if($logResponse->serverResponse == "success"){
			
			
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
	else if($actionFlag == "suspend"){ //suspend account
		$id = 1; // change to session id
		$response = accountStatus($id,"2", $dbHandler);
		
		if($response == "updated")
		{
			$response = "Account Suspended";
		}
		else
		{
			$response = "Account Not Suspended";
		}
	}
	else if($actionFlag == "delete"){ //delete account
		$id = 1; // change to session id
		$response = accountStatus($id,"0", $dbHandler);
		if($response == "updated")
		{
			$response = "Account Deleted";
		}
		else
		{
			$response = "Account Not Deleted";
		}
	}
	else if($actionFlag == "activate"){ //activate account
		
		$id = 1; // change to session id
		$response = accountStatus($id,"1", $dbHandler);
		
		if($response == "updated")
		{
			$response = "Account Activated";
		}
		else
		{
			$response = "Account Not Activate";
		}
	}
}else{
    
    $response = "no valid action specified";
}

}else{ //db connection failed   
    $response =  "dbError: database connection failed!";
}
echo json_encode($response);
?>