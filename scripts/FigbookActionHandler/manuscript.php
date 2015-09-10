<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Manuscript
 * @author Kgomotso
 */

//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
error_reporting(0);

	//require("dataBaseHandler.php");
//$dbHandler = new databaseHandler();
//$temp = new manuscript($dbHandler->getConnection());
//echo "Reason = ".$temp->titleExists("Demo_Book2");

class manuscript {

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

    public function link($id,$title, $access) {
        $queryString = "INSERT INTO user_page (user_name ,page_id ,user_role) VALUES ('$id', '$title', '$access')";
        $queryResults = mysqli_query($this->dbInstance, $queryString);
        $result = "userid: ".$id." linked to ".$title." with ".$access." access";
       return $result;
    }

    //go to systems database and check if the book title exists
     public function titleExists($title) {
        $title = str_replace(" ","_",$title);
        $query="SELECT * FROM page WHERE page_title= '$title'";
        $queryResult = mysqli_fetch_assoc(mysqli_query($this->dbInstance, $query));//run query
        $result = "false";
	if(($queryResult) > 0){
		$result = "true";
	}

       return $result;
    }

    public function lockBookToUser($userId, $bookTitle) {

        $query="SELECT page_id FROM page WHERE page_title ='$bookTitle'";
        $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $title = "";
        if($queryResult){

            $row = mysqli_fetch_assoc($queryResult);
            $title = $row['page_id'];

        }

        $query="SELECT user_id FROM user WHERE user_name ='$userId'";
        $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $uid = "";
        if($queryResult){

            $row = mysqli_fetch_assoc($queryResult);
            $uid = $row['user_id'];

        }
        $queryString = "INSERT INTO user_page (user_name,page_id,user_role) VALUES('$uid','$title','Creator')";

             $queryResults = mysqli_query($this->dbInstance, $queryString);
             if($queryResults){

                 $this->message = "success";

             }else if(!$queryResults){
                 $this->message = "Failed";
             }
            //send success message and current user details
            return $this->message;
    }

    public function checkPagePermissions($userId, $bookTitle) {

        $query="SELECT page_id FROM page WHERE page_title ='$bookTitle'";
        $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $title = "";
        if($queryResult){

            $row = mysqli_fetch_assoc($queryResult);
            $title = $row['page_id'];

        }

        $query="SELECT user_id FROM user WHERE user_name ='$userId'";
        $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $uid = "";
        if($queryResult){

            $row = mysqli_fetch_assoc($queryResult);
            $uid = $row['user_id'];

        }
        //echo "UserId ". $uid;
        //echo "BookID ". $title;
        $queryString = "SELECT * FROM user_page WHERE user_name= '$uid' AND (page_id= '$title' OR page_id='$bookTitle')";
             $queryResults = mysqli_query($this->dbInstance, $queryString);
             if($queryResults){

                 if(mysqli_num_rows($queryResults) > 0){
                    $this->message = "success";
                }
                 else{
                     $this->message = "Failed";
                 }

             }else if(!$queryResults){
                 $this->message = "Failed";
             }
            //send success message and current user details
            return $this->message;
    }

    public function getUserRole($userId, $bookTitle){
        $query="SELECT page_id FROM page WHERE page_title ='$bookTitle'";
        $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $title = "";
        if($queryResult){

            $row = mysqli_fetch_assoc($queryResult);
            $title = $row['page_id'];

        }

        $query="SELECT user_id FROM user WHERE user_name ='$userId'";
        $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $uid = "";
        if($queryResult){

            $row = mysqli_fetch_assoc($queryResult);
            $uid = $row['user_id'];

        }
        $queryString = "SELECT * FROM user_page WHERE user_name= '$uid' AND (page_id= '$title' OR page_id='$bookTitle')";

             $queryResults = mysqli_query($this->dbInstance, $queryString);
             if($queryResults){

                 if(mysqli_num_rows($queryResults) > 0){
                     $row = mysqli_fetch_assoc($queryResults);
                    $this->message = $row['user_role'];
                }
                 else{
                     $this->message = "Failed";
                 }

             }else if(!$queryResults){
                 $this->message = "Failed";
             }
            //send success message and current user details
            return $this->message;
    }
}


?>
