<?php

require("databaseHandler.php");
require("user.php");
require("manuscript.php");

$response = "";
$dbHandler = new databaseHandler();
session_start();
if($dbHandler->isConnected()){

///get json string
$getJSONObject = $_REQUEST['json'];
$object = json_decode(stripslashes($getJSONObject));
///get the action flag
$actionFlag = $object->action;

/**
* This method return all user data.
*@param id		user id for which data is required
*@param status 	account status of the user
*@param dbHandler 	actual handler to the database
*/
function accountStatus($id, $status, $dbHandler){
	$tmpUser = new user($dbHandler->getConnection());
	///get the user details.
	$result = $tmpUser->getUserDetails($id);
	///get the row of results 
	$row = mysqli_fetch_assoc($result); 
	return $tmpUser->updateUser($row[user_name],$row[user_password],$row[user_email],$row[user_role], $status);	
}

///determine the type of action
if(isset($actionFlag) && $actionFlag != ""){
	/// register user
    if($actionFlag == "register"){         
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
	}
	else if($actionFlag == "getTimeStamp"){		
		$uID = $_COOKIE['username'];
		$tmpUser = new user($dbHandler->getConnection());		
		$response = ($tmpUser->getTimeStamp($uID, $object));	
	}
	else if($actionFlag == "verifyTimeStamp"){		
		$obj = json_decode($getJSONObject);
		$uID = $_COOKIE['username'];
		$tmpUser = new user($dbHandler->getConnection());		
		$response = ($tmpUser->verifyTimeStamp($uID, $obj));	
	}
	elseif ($actionFlag == "updateAboutMe"){
		$uID = $_COOKIE['username'];
		$tmpUser = new user($dbHandler->getConnection());		
		$response = ($tmpUser->updateAboutMe($uID, $object));
	}
	elseif ($actionFlag == "updatePortfolioInfo"){
		$uID = $_COOKIE['username'];
		$tmpUser = new user($dbHandler->getConnection());
		$response = ($tmpUser->updatePortfolioInfo($uID, $object));
	}
	elseif ($actionFlag == "updateContactInfo"){
		$uID = $_COOKIE['username'];
		$tmpUser = new user($dbHandler->getConnection());
		$response = ($tmpUser->updateContactInfo($uID, $object));
	}
	else if($actionFlag == "login"){ //login user
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
	}
	///suspend account
	else if($actionFlag == "suspend"){ 
		$id = $_COOKIE['username']; 
		$response = accountStatus($id,"2", $dbHandler);
		if($response == "updated"){
			$response = "Account Suspended";
		}
		else{
			$response = "Account Not Suspended";
		}
	}
	///Delete account
	else if($actionFlag == "delete"){ 
		$id = $_COOKIE['username']; 
		$response = accountStatus($id,"0", $dbHandler);
		if($response == "updated"){
			$response = "Account Deleted";
		}
		else{
			$response = "Account Not Deleted";
		}
	}
	///Activate account
	else if($actionFlag == "activate"){ 
		$id = $_COOKIE['username'];
		$response = accountStatus($id,"1", $dbHandler);
		
		if($response == "updated"){
			$response = "Account Activated";
		}
		else{
			$response = "Account Not Activate";
		}
	}
	///Register user
	else if($actionFlag == "checkTitle"){ 
		$tmpMen= new manuscript($dbHandler->getConnection());
		$response = $tmpMen->titleExists($object->title);
	}
	///Get User Status
	else if($actionFlag == "getUserStatus"){ 
            $id = $_COOKIE['username'];
            $tmpUser = new user($dbHandler->getConnection());
            $response = $tmpUser->userStatus($id);
    }
}
else{    
    $response = "no valid action specified";
}
///Database connection failed 
}else{   
    $response =  "dbError: database connection failed!";
}
echo json_encode($response);
?>