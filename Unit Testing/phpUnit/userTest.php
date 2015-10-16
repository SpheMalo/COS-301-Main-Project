<?php

	
	define("HOST", "localhost");
    define("USERNAME","root"); 
    define("PASSWORD","root");
    define("DATABASE","my_wiki"); 
    //require_once('actionHandler.php');

    set_include_path("/home/pear"); 

	class databaseHandler{
	    
	    //properties
	    private $dbconnection;
	    
	    
	    //methods
	    
	    //open a database connection and initialise connection object
	    public function __construct(){
	        
	        //$this->dbconnection = mysql_connect(HOST, USERNAME, PASSWORD);
	        $this->dbconnection = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
	        
	        if (!$this->dbconnection){
	            
	            die ("database connection failed ". mysql_error());
	        }
	        
	    }
	    
	    //close the database connection
	    public function __destruct() {
	        mysqli_close($this->dbconnection);
	        
	    }
	    
	    //returns the connection variable 
	    public function getConnection(){
	        
	        return $this->dbconnection;
	    }
	    
	    public function isConnected(){
	        
	        if ($this->dbconnection == null){
	            return false;
	        }else{
	            return true;
	        }
	    }
	    
	    //just in case we have to explicitly close the db connection
	    public function closeConnection(){       
	        mysqli_close($this->dbconnection);
	        
	        echo "\n"."connection succesfully closed";
	    }
	}

    class databaseHandlerTest extends PHPUnit_Framework_TestCase{

    	public function getUsers()
	    {
	    	$dbInstance = new databaseHandler();
	        $sql = "SELECT user_id, user_name FROM user";
	        $result = mysqli_query($dbInstance->getConnection(), $sql);

	        while($row=mysqli_fetch_array($result)) {
	           $return[]= $row;
	       }
	       return $return;
	    }

	    function testGetUsers(){
	    	$this->assertNotNull($this->getUsers());
	    }

	    public function getUsersFuzzy($filter="")
	    {
	    	$dbInstance = new databaseHandler();
	        if($filter !== ""){
	            $sql = "SELECT user_id, user_name FROM user where user_name LIKE \"%$filter%\"";
	            $words = array();
	            for ($i = 0; $i < strlen($filter); $i++) {
	                // insertions
	                $words[] = substr($filter, 0, $i) . '_' . substr($filter, $i);
	                // deletions
	                $words[] = substr($filter, 0, $i) . substr($filter, $i + 1);
	                // substitutions
	                $words[] = substr($filter, 0, $i) . '_' . substr($filter, $i + 1);
	            }
	            // last insertion
	            $words[] = $filter . '_';
	            foreach ($words as $word) {
	                $sql .= " OR user_name LIKE \"%$word%\"";
	            }
	        }
	        else{
	            $sql = "SELECT user_id, user_name FROM user";
	        }
	        $result = mysqli_query($dbInstance->getConnection(), $sql);
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

	    function testGetUsersFuzzy(){
	    	$this->assertNotNull($this->getUsersFuzzy('fakopeleha'));	
	    }
    	
    	public function loginUser($uemail,$upassword){
	    	$dbInstance = new databaseHandler();	
	        //handling sql injections
	        $upassword = substr(md5($upassword), 0, 25);
	        $upassword = stripslashes($upassword);
	        //$upassword = mysql_real_escape_string($upassword);

	        $upassword = mysqli_real_escape_string($dbInstance->getConnection(),$upassword);

	        $query="SELECT * FROM useraccount WHERE (Username='$uemail' OR  EmailAddress='$uemail') AND Password = '$upassword'";

		//$queryResult = mysql_query($query); //run query
	        $queryResult = mysqli_query($dbInstance->getConnection(),$query);
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

		function testLoginUser(){
			$str = "{\"serverResponse\":\""."success"."\",
	                                     \"Username\":\""."fakopeleha"."\",
	                                     \"Email\":\""."jimmypeleha@yahoo.com"."\",
	                                     \"UserID\":\""."61"."\"
	                                     }";

			$this->assertEquals($this->loginUser("fakopeleha", "Fakoatoro1"), null);
		}

	    public function getUserDetails($uname)
		{
			$dbInstance = new databaseHandler();
			$sql = "SELECT * FROM user where user_name = '$uname' ";

			$queryResults = mysqli_query($dbInstance->getConnection(), $sql);
			return $queryResults;
		}

		function testGetUserDetails(){
			$this->assertNotNull($this->getUserDetails("Fakopeleha"));
		}

		public function getforgotPassword($Useremail){
		$dbInstance = new databaseHandler();
        ///scan usertable searching for matchin email addr,if found, get the username and password of User
        $query = "SELECT Username, Userpassword FROM User WHERE Useremail = '$Useremail'";

        //$queryRes = mysql_query($query);
        $queryRes = mysqli_query($dbInstance->getConnection(), $query);

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

                    return $this->responseObject;

                }else{ //unsuccessfull

                    $this->message = "Unable to send mail to'$Useremail'!";

                    $this->responseObject = "{\"serverResponse\":\"".$this->message."\"}";

                    return $this->responseObject;
                }

            }else{ // the email does not exist

                $this->message = "Useremail Does not exist!";

                $this->responseObject = "{\"serverResponse\":\"".$this->message."\"}";

                return $this->responseObject;
            }
        }

    }

    function testGetForgotPassword(){
    	//$this->assertNotNull($this->getforgotPassword("jimmypeleha@yahoo.com"));
    }

	public function getOtherUserInfo($userID, $obj)
	{
		$dbInstance = new databaseHandler();
		$sql = "SELECT user_id, user_role, user_name, first_name, last_name, about_me, genres_of_interest, cell, home, email, work FROM user, personal_details WHERE user.user_name='$userID' AND personal_details.username='$userID'";
		$myResponse = (mysqli_fetch_assoc(mysqli_query($dbInstance->getConnection(), $sql)));
		$usersIdFromUserPage = $myResponse["user_id"];
		$query="SELECT page_id FROM user_page WHERE user_name='$usersIdFromUserPage' AND user_role='Creator'";

	    $queryResult = mysqli_query($dbInstance->getConnection(), $query);//run query
        $returnArray = array();
        $arryaofBookTitles = array();
		$count = 0;
		if($queryResult){
			//return 1;
            while ($row = mysqli_fetch_assoc($queryResult)) {

                $returnArray[] = $row;
            }

            $sql = "SELECT page_title, page_id FROM page";
			$bookTitles = ((mysqli_query($dbInstance->getConnection(), $sql)));

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

	function testGetOtherUserInfo(){
		$this->assertNotNull($this->getOtherUserInfo("Fakopeleha", new databaseHandler()));
		//$this->assertNotNull($this->you());
	}

	public function getUserInfo($userID)
	{
		$dbInstance = new databaseHandler();
		$sql = "SELECT user_id, user_profile_picture, user_role, user_name, first_name, last_name, about_me, genres_of_interest, cell, home, email, work FROM user, personal_details WHERE user.user_name='$userID' AND personal_details.username='$userID'";
		$myResponse = (mysqli_fetch_assoc(mysqli_query($dbInstance->getConnection(), $sql)));
		$usersIdFromUserPage = $myResponse["user_id"];
		$query="SELECT page_id FROM user_page WHERE user_name='$usersIdFromUserPage' AND user_role='Creator'";

	    $queryResult = mysqli_query($dbInstance->getConnection(), $query);//run query
        $returnArray = array();
        $arryaofBookTitles = array();
		$count = 0;
		if($queryResult){

            while ($row = mysqli_fetch_assoc($queryResult)) {

                $returnArray[] = $row;
            }

            $sql = "SELECT page_title, page_id FROM page";
			$bookTitles = ((mysqli_query($dbInstance->getConnection(), $sql)));

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
					
					else if ($returnArray[$i]["page_id"] == $row["page_title"])
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

	function testGetUserInfo(){
		$this->assertNotNull($this->getUserInfo("Fakopeleha"));
		//$this->assertNotNull($this->you());
	}

	public function updateAboutMe($uID, $jsonObj)
	{
		$dbInstance = new databaseHandler();
		$sql = "UPDATE personal_details SET about_me='hello' WHERE username='$uID'";

		$myResponse = mysqli_query($dbInstance->getConnection(), $sql);
		return $myResponse;
	}

	function testUpdateAboutMe(){
		$item = array('aboutme' => 'Hello');
		$json = json_encode($item);
		$this->assertNotNull($this->updateAboutMe("Fakopeleha", $json));
	}


    }
?>