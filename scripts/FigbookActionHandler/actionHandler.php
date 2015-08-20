<?php

require("databaseHandler.php");
require("user.php");
require("manuscript.php");

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
		//echo $_COOKIE['username'];
	 $result = $tmpUser->getUserDetails($id); //get the user details.
	
	$row = mysqli_fetch_assoc($result); //get the row of results
	//echo $row['user_status'];
	return $tmpUser->updateUser($row[user_name],$row[user_password],$row[user_email],$row[user_role], $status);	
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
	
	}else if($actionFlag == "getTimeStamp"){
		
		$uID = $_COOKIE['username'];
		$tmpUser = new user($dbHandler->getConnection());
		
		$response = ($tmpUser->getTimeStamp($uID, $object));
	
	}else if($actionFlag == "verifyTimeStamp"){
		
		$obj = json_decode($getJSONObject);
		$uID = $_COOKIE['username'];
		$tmpUser = new user($dbHandler->getConnection());
		
		$response = ($tmpUser->verifyTimeStamp($uID, $obj));
	
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
		$id = $_COOKIE['username']; 
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
		$id = $_COOKIE['username']; 
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
		
		$id = $_COOKIE['username'];
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
	else if($actionFlag == "checkTitle"){ // register user
		$tmpMen= new manuscript($dbHandler->getConnection());
		$response = $tmpMen->titleExists($object->title);
	}

         else if($actionFlag == "getUserStatus"){ //Get User Status
            
            $id = $_COOKIE['username'];
            $tmpUser = new user($dbHandler->getConnection());
        
            $response = $tmpUser->userStatus($id);
            
        }
         else if($actionFlag == "lockBook"){ //Get User Status
            
            $id = $_COOKIE['username'];
            $bookTitle = $object->bookTitle;
            
            $tmpMen= new manuscript($dbHandler->getConnection());
            $response = $tmpMen->lockBookToUser($id, $bookTitle);
            
        }
        else if($actionFlag == "checkPagePermissions"){ //Get User Status
            
            $id = $_COOKIE['username'];
            $bookTitle = $object->bookTitle;
            
            $tmpMen= new manuscript($dbHandler->getConnection());
            $response = $tmpMen->checkPagePermissions($id, $bookTitle);
            
        }
}else{
    
    $response = "no valid action specified";
}

}else{ //db connection failed   
    $response =  "dbError: database connection failed!";
}
echo json_encode($response);
?>