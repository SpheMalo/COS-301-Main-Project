<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class communication {
 
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
    
    public function sendEditorialLetter($userId, $bookTitle, $message){
        
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
        
        $queryString = "INSERT INTO letter (editor_id,message,page_id) VALUES('$uid','$message', '$title')";
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