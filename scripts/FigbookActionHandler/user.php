<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 * register user,login user
 * @author Ndivhuwo
 */

require_once('ext/Diff/Diff3.php');
class user {
 
    //properties
    private $dbInstance;
    private $responseObject;
    private $message;
    //methods
    
    //initialise member variable/ properties
    public function __construct($dbInstance) {
        
        $this->dbInstance = $dbInstance;
    }
    
    //clean up, all references
    public function __destruct() {
        
        $this->dbInstance = null;
    }

    public function getUsers()
    {
        $sql = "SELECT user_id, user_name FROM user";
        $result = mysqli_query($this->dbInstance, $sql);

        while($row=mysqli_fetch_array($result)) {
           $return[]= $row;
       }
       return $return;
    }
    public function getUsersFuzzy($filter="")
    {
        if($filter !== ""){
            $sql = "SELECT user_id, user_name FROM user where user_name LIKE \"%$filter%\"";
        }
        else{
            $sql = "SELECT user_id, user_name FROM user";
        }
        $result = mysqli_query($this->dbInstance, $sql);
        $return=array();
        while($row=mysqli_fetch_array($result)) {
           //$return[]= $row;
           $return[]=array(
                    "id"=>$row["user_id"],
                    "label"=>$row["user_name"]
                );
       }
       return $return;
    }
    
    //go to systems database and check if the username and password match a single record
    public function loginUser($uemail,$upassword){
         
        //handling sql injections
        $upassword = stripslashes($upassword);
        //$upassword = mysql_real_escape_string($upassword);
        $upassword = mysqli_real_escape_string($this->dbInstance,$upassword);
        
        $query="SELECT * FROM useraccount WHERE (Username='$uemail' OR  EmailAddress='$uemail') AND Password = '$upassword'";

	//$queryResult = mysql_query($query); //run query
        $queryResult = mysqli_query($this->dbInstance,$query);
        if($queryResult){
            
            if(mysqli_num_rows($queryResult) == 1){
                
                //get user details
                $found_user = mysqli_fetch_array($queryResult);
                
                $this->message = "success";
                 $isactive = $this->isActive($found_user['Username']);
                if($isactive == "false"){
                    
                    $this->message = "not_active";
                }
                $this->responseObject = "{\"serverResponse\":\"".$this->message."\",
                                     \"Username\":\"".$found_user['Username']."\",
                                     \"Email\":\"".$found_user['EmailAddress']."\",
                                     \"UserID\":\"".$found_user['UserID']."\"
                                     }";
               
                //return to app
                return $this->responseObject;
                
            }else if(mysqli_fetch_array($queryResult) <= 0){ //no such user exists
                
                $this->message = "'invalid username or password'";
                
                $this->responseObject = "{\"serverResponse\":\"".$this->message."\"}";
                
                //return to app
                return $this->responseObject;
            }
        }
        
    }
    
    private function isActive($userName) {
        
        $query="SELECT * FROM useraccount WHERE (Username='$userName' OR  EmailAddress='$userName') AND Status=1";
        $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $result = "false";
        if($queryResult){
            
            if(mysqli_num_rows($queryResult) == 1){
                $result = "true";
            }
           
            }
        return $result;
    }
    
    public function userStatus($userName) {
        
        $query="SELECT user_status FROM user WHERE user_name='$userName'";
        $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $result = "0";
        if($queryResult){
            
            if(mysqli_num_rows($queryResult) != 1){
                $result = "Status could not be retrieved";
            }
            else{
                $row = mysqli_fetch_assoc($queryResult);
                $result = $row['user_status'];
            }
           
            }
        return $result;
        
    }
    //adds a new user to the systems database
    //check if similiar user does not exist 1st
    //if details are correct, a new user is added
    public function insertUser($uname,$upassword,$uemail,$urole){
        
        //suppress notice errors
        error_reporting(E_ALL ^ E_NOTICE);
         
        $available = false;
        
        //check username availability
        $queryString = "SELECT Username from useraccount where Username ='$uname'";
        
        $queryResults = mysqli_query($this->dbInstance, $queryString);
        
        
        if(mysqli_num_rows($queryResults) >= 1){
                
           //the username exists, append appropriate message
           $this->message = "Username already exists.";       
           $available = TRUE;
        }
        
        //check email availability
        $queryResults = mysqli_query($this->dbInstance, "SELECT EmailAddress from useraccount where EmailAddress ='$uemail'");
        if(mysqli_num_rows($queryResults) >= 1){
            //the email exists, append message
            $this->message .= "Useremail already exists.";
            $available = TRUE;
        }
            
         
        if($available){
            
            //do not store the user
            $this->responseObject = "{\"serverResponse\":\"".$this->message."\"}";
            
        }else if (!$available){
            
             $today = getdate();

             $date = $today[mday];
             $date .= "/".$today[mon];
             $date .= "/".$today[year];
            //echo $uname . $upassword . $uemail;
            //add user to database
            $queryString = "INSERT INTO useraccount (Username,UserRole,Password,EmailAddress, Status) VALUES('$uname','$urole','$upassword','$uemail','1')";

             $queryResults = mysqli_query($this->dbInstance, $queryString);
            $UserID = null;
             if($queryResults){
                 
                 $UserID = mysqli_insert_id($this->dbInstance);
                 
             }else if(!$queryResults){
                 $this->message = "could not insert user";
             }
            //send success message and current user details 
            $this->message = "success";
            $this->responseObject = "{\"serverResponse\":\"".$this->message."\"
                                     }";
        }
        
         //return to app      
         return $this->responseObject;
    }
    
	//Function to get required values for delete,suspend,activate account.
	public function getUserDetails($uname)
	{
		$sql = "SELECT * FROM user where user_name = '$uname' ";
		
		$queryResults = mysqli_query($this->dbInstance, $sql);
		return $queryResults;
	}
	 
	//Function update user details
    public function updateUser($uname,$upassword,$uemail,$urole,$status)
	{
		//suppress notice errors
        error_reporting(E_ALL ^ E_NOTICE);
         
		 
		 
        //update user
	//echo $uname;
        $queryString = "UPDATE user SET user_role='$urole', user_password='$upassword', user_email='$uemail', user_status='$status' WHERE user_name='$uname'";
        
        //$queryResults = mysql_query($queryString);
        $queryResults = mysqli_query($this->dbInstance, $queryString);
        echo $queryResults;
        if ($queryResults === TRUE) {
			return "updated";
		} else {
			return "notupdated";
		}
	}
    
    
    public function getforgotPassword($Useremail){
    
        //scan usertable searching for matchin email addr,if found, get the username and password of User 
        $query = "SELECT Username, Userpassword FROM User WHERE Useremail = '$Useremail'";
        
        //$queryRes = mysql_query($query);
        $queryRes = mysqli_query($this->dbInstance, $query);
        
        if($queryRes){
            
            if(mysqli_num_rows($queryRes) >= 1){ //user with the email exists
             
                $found_user = mysqli_fetch_array($queryRes);
              
                $username = $found_user['Username'];
                $password = $found_user['Userpassword'];
                
                //try sending email
                
                $to = $Useremail;
                $subject = "Uthinc Password Recovery";
                $message = "Hello ".$username." \nThank you for using our password Recovery System \n Your password is:".$password ." \n \n Thank you. \n Regards \n Uthinc Management.";
                $from = "info@uinc.co.za";
                $headers = "From:" . $from;

                $check = @mail($to,$subject,$message,$headers);
                
                if($check){ //successfull
                 
                    $this->message = "Your password has been emailed to you.";

                    $this->responseObject = "{\"serverResponse\":\"".$this->message."\"}";
                    
                    echo $this->responseObject;
                    
                }else{ //unsuccessfull
                    
                    $this->message = "Unable to send mail to'$Useremail'!";

                    $this->responseObject = "{\"serverResponse\":\"".$this->message."\"}";
                    
                    echo $this->responseObject;
                }
                
            }else{ // the email does not exist
                
                $this->message = "Useremail Does not exist!";

                $this->responseObject = "{\"serverResponse\":\"".$this->message."\"}";
                
                return $this->responseObject;
            }
        }
        
    }
	public function getOtherUserInfo($userID, $obj)
	{
		$sql = "SELECT user_id, user_role, user_name, first_name, last_name, about_me, genres_of_interest, cell, home, email, work FROM user, personal_details WHERE user.user_name='$userID' AND personal_details.username='$userID'";
		$myResponse = (mysqli_fetch_assoc(mysqli_query($this->dbInstance, $sql)));
		$usersIdFromUserPage = $myResponse["user_id"];
		$query="SELECT page_id FROM user_page WHERE user_name='$usersIdFromUserPage' AND user_role='Creator'";
       
	    $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $returnArray = array();
        $arryaofBookTitles = array();
		$count = 0;
		if($queryResult){
            
            while ($row = mysqli_fetch_assoc($queryResult)) {

                $returnArray[] = $row;
            }
			
            $sql = "SELECT page_title, page_id FROM page";
			$bookTitles = ((mysqli_query($this->dbInstance, $sql)));
			
			while ($row = mysqli_fetch_assoc($bookTitles))
			{
				for ($i = 0; $i < count($returnArray); $i++)
				{
					if ($returnArray[$i]["page_id"] == $row["page_id"])
					{
						
						$myResponse['books'][$count] = $row["page_title"];
						
						$count++;
						break;
					}
				}
			}
			
        }
        else {
            $myResponse['books'] = "Failed";
        }
		
		return ($myResponse);
	}
	
		public function getUserInfo($userID)
	{
		$sql = "SELECT user_id, user_role, user_name, first_name, last_name, about_me, genres_of_interest, cell, home, email, work FROM user, personal_details WHERE user.user_name='$userID' AND personal_details.username='$userID'";
		$myResponse = (mysqli_fetch_assoc(mysqli_query($this->dbInstance, $sql)));
		$usersIdFromUserPage = $myResponse["user_id"];
		$query="SELECT page_id FROM user_page WHERE user_name='$usersIdFromUserPage' AND user_role='Creator'";
       
	    $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $returnArray = array();
        $arryaofBookTitles = array();
		$count = 0;
		if($queryResult){
            
            while ($row = mysqli_fetch_assoc($queryResult)) {

                $returnArray[] = $row;
            }
			
            $sql = "SELECT page_title, page_id FROM page";
			$bookTitles = ((mysqli_query($this->dbInstance, $sql)));
			
			while ($row = mysqli_fetch_assoc($bookTitles))
			{
				for ($i = 0; $i < count($returnArray); $i++)
				{
					if ($returnArray[$i]["page_id"] == $row["page_id"])
					{
						
						$myResponse['books'][$count] = $row["page_title"];
						
						$count++;
						break;
					}
				}
			}
			
        }
        else {
            $myResponse['books'] = "Failed";
        }
		
		return ($myResponse);
		
	}
	
	public function updateAboutMe($uID, $jsonObj)
	{
		$sql = "UPDATE personal_details SET about_me='$jsonObj->aboutme' WHERE username='$uID'";
		
		$myResponse = mysqli_query($this->dbInstance, $sql);
		return $myResponse;
	}
	
	public function updatePortfolioInfo($uID, $jsonObj)
	{
		$sql = "UPDATE personal_details SET first_name='$jsonObj->firstname', last_name='$jsonObj->surname', genres_of_interest='$jsonObj->genres' WHERE username='$uID'";
		
		$myResponse = mysqli_query($this->dbInstance, $sql);
		return $myResponse;
	}
	
	public function updateContactInfo($uID, $jsonObj)
	{
		$sql = "UPDATE personal_details SET cell='$jsonObj->cell', home='$jsonObj->home', work='$jsonObj->work', email='$jsonObj->email' WHERE username='$uID'";
		$myResponse = mysqli_query($this->dbInstance, $sql);
		
		//This is only gonna return an error once (this should be fixed later on.)
		$sql = "UPDATE user SET user_email='$jsonObj->email' WHERE user_name='$uID'";
		$myResponse = mysqli_query($this->dbInstance, $sql);
		
		return $myResponse;
	}
	
	/**
	 *@param string $userID the username of the user that made this call
	 *@param json $obj json object containing information necessary to make the query to retrieve the timestamp for this section.
	 *
	 */
	public function getTimeStamp($userID, $obj)
	{

		$sql = "SELECT * FROM section_revisions WHERE book_title = '$obj->title' AND section_number = '$obj->section'";
		$myResponse = mysqli_fetch_assoc(mysqli_query($this->dbInstance, $sql));
		
		// If no such record exists, create it and persist
		if ($myResponse == null)
		{
			$sql = "INSERT INTO section_revisions (book_title, section_number, last_edited_by, date_last_edited)
			VALUE ('$obj->title', '$obj->section', '$userID', CURRENT_TIME)";
			mysqli_query($this->dbInstance, $sql);
			
			$sql = "SELECT * FROM section_revisions WHERE book_title = '$obj->title' AND section_number = '$obj->section'";
			$myResponse = mysqli_fetch_assoc(mysqli_query($this->dbInstance, $sql));
		}
		
		//return the timestamp
		return $myResponse;
	}
	
	public function verifyTimeStamp($uID, $obj)
	{
		$sql = "SELECT * FROM section_revisions WHERE book_title = '$obj->title' AND section_number = '$obj->section'";
		$myResponse = mysqli_fetch_assoc(mysqli_query($this->dbInstance, $sql));
		
		//Check timestamps
		if ($myResponse["date_last_edited"] == $obj->timestamp)
		{
			$sql = "UPDATE section_revisions SET section_content='$obj->newContent', date_last_edited=CURRENT_TIME, last_edited_by='$uID' WHERE book_title = '$obj->title' ";
			mysqli_query($this->dbInstance, $sql);
			
			//Getting the updated time
			$sql = "SELECT date_last_edited FROM section_revisions WHERE book_title = '$obj->title' AND section_number = '$obj->section'";
		    $temp = mysqli_fetch_assoc(mysqli_query($this->dbInstance, $sql));
			
			$myResponse["message"] = "no_conflict";
			$myResponse["date_last_edited"] = $temp["date_last_edited"];
			return $myResponse;
		}
		else
		{
			//attempt Automatic Merge
			$diff = new Text_Diff3($obj->originalContent, $myResponse["section_content"], $obj->newContent);
			$var = ($diff->mergedOutput());
			$conflict = "none";
			for ($i = 0; $i < $var.length; $i++)
			{
				if ($var[$i] == "<<<<<<<")
				{
					$conflict = "conflict";
					break;
				}
			}
			
			//automatic merge completed with no conflicts
			if ($conflict == "none")
			{
				$myResponse["message"] = "no_conflict";
				$myResponse["date_last_edited"] = $temp["date_last_edited"];
				return $myResponse;
			}
			else //return the merged text with conflicts in them
			{
				$myResponse["message"] = "conflict";
				$myResponse["mergedText"] = $var;
				return $myResponse;
			}
		}
	}
    
    
}


?>
