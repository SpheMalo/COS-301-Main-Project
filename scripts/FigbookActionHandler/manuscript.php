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
	$title = str_replace(' ','_',$title);
        $queryString = "INSERT INTO user_page (user_name ,page_id ,user_role) VALUES ('$id', '$title', '$access')";
        $queryResults = mysqli_query($this->dbInstance, $queryString);
        $result = "userid: ".$id." linked to ".$title." with ".$access." access";
       return $result;
    }
    


    //go to systems database and check if the book title exists
     public function titleExists($title) {
        
        $query="SELECT * FROM page WHERE page_title= '$title'";
        $queryResult = mysqli_fetch_assoc(mysqli_query($this->dbInstance, $query));//run query
        $result = "false";
	if(($queryResult) > 0){
		$result = "true";
	}
	
       return $result;
    }
    
    public function lockBookToUser($userId, $bookTitle) {
        
        $bookTitle = str_replace(" ","_",$bookTitle);
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
        
        $queryString = "INSERT INTO user_page (user_name,page_id,user_role) VALUES('$uid','$bookTitle','Creator')";
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
        $bookTitle = str_replace(" ","_",$bookTitle);
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
        $bookTitle = str_replace(" ","_",$bookTitle);
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
    function getBooksFuzzy($filter="", $user_name){
        
        if($filter !== ""){
            $sql = "SELECT page_id, page_title FROM page where page_title LIKE \"%$filter%\"";
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
                $sql .= " OR page_title LIKE \"%$word%\"";
            }
        }
        else{
            $sql = "SELECT page_id, page_title FROM page";
        }
        $result = mysqli_query($this->dbInstance, $sql);
        $return=array();
        while($row=mysqli_fetch_array($result)) {
           //$return[]= $row;
            if($this->checkPagePermissions($user_name, $row["page_title"]) ==="success"){
                $return[]=array(
                    "id"=>$row["page_id"],
                    "label"=>$row["page_title"]
                );
            }
           
       }
       return $return;
    }
    function clean_delete($bookTitle){
        $queryString = "DELETE FROM user_page WHERE page_id ='$bookTitle'";
             $queryResults = mysqli_query($this->dbInstance, $queryString);
             if($queryResults){
                 
                 $this->message = "success";
                 
             }else if(!$queryResults){
                 $this->message = "Failed";
             }
            //send success message and current user details 
            return $this->message;
    }
}


?>
