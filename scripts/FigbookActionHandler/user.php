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
    
    //go to systems database and check if the username and password match a single record
    public function loginUser($uemail,$upassword){
         
        //handling sql injections
        $upassword = stripslashes($upassword);
        $upassword = mysql_real_escape_string($upassword);
        
        $query="SELECT * FROM useraccount WHERE (Username='$uemail' OR  EmailAddress='$uemail') AND Password = '$upassword'";

	$queryResult = mysql_query($query); //run query
        
        if($queryResult){
            
            if(mysql_num_rows($queryResult) == 1){
                
                //get user details
                $found_user = mysql_fetch_array($queryResult);
                
                $this->message = "success";
                
                $this->responseObject = "{\"serverResponse\":\"".$this->message."\",
                                     \"Username\":\"".$found_user['Username']."\",
                                     \"Email\":\"".$found_user['EmailAddress']."\",
                                     \"UserID\":\"".$found_user['UserID']."\"
                                     }";
          
                //return to app
                return $this->responseObject;
                
            }else if(mysql_num_rows($queryResult) <= 0){ //no such user exists
                
                $this->message = "'invalid username or password'";
                
                $this->responseObject = "{\"serverResponse\":\"".$this->message."\"}";
                
                //return to app
                return $this->responseObject;
            }
        }
        
    }
    
    //adds a new user to the systems database
    //check if similiar user does not exist 1st
    //if details are correct, a new user is added
    public function insertUser($uname,$upassword,$uemail){
        
        //suppress notice errors
        error_reporting(E_ALL ^ E_NOTICE);
         
        $available = false;
        
        //check username availability
        $queryString = "SELECT Username from useraccount where Username ='$uname'";
        
        $queryResults = mysql_query($queryString);
        
        if(mysql_num_rows($queryResults) >= 1){
                
           //the username exists, append appropriate message
           $this->message = "Username already exists.";       
           $available = TRUE;
        }
        
        //check email availability
        $queryResults = mysql_query("SELECT EmailAddress from useraccount where EmailAddress ='$uemail'");
        if(mysql_num_rows($queryResults) >= 1){
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
            $queryString = "INSERT INTO useraccount (Username,Password,EmailAddress, Status) VALUES('$uname','$upassword','$uemail','1')";
        
            $queryResults = mysql_query($queryString);
            $UserID = null;
             if($queryResults){
                 
                 $UserID = mysql_insert_id();
                 
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
    
    
    
    public function getforgotPassword($Useremail){
    
        //scan usertable searching for matchin email addr,if found, get the username and password of User 
        $query = "SELECT Username, Userpassword FROM User WHERE Useremail = '$Useremail'";
        
        $queryRes = mysql_query($query);
        
        if($queryRes){
            
            if(mysql_num_rows($queryRes) >= 1){ //user with the email exists
             
                $found_user = mysql_fetch_array($queryRes);
              
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
    
    
}


?>
