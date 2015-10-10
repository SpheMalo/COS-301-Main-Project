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

    public function email($message, $subject, $from)
    {
        $to      = 'figbook.creativate@gmail.com';
        $headers = 'From:' . $from . "\r\n" .phpversion();

        mail($to, $subject, $message, $headers);

        return "success";
    }
    
    public function sendEditorialLetter($userId, $bookTitle, $message){
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
    
    function getEditorialLetters($bookTitle){
        $bookTitle = str_replace(" ","_",$bookTitle);
        $query="SELECT page_id FROM page WHERE page_title ='$bookTitle'";
        $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $title = "";
        if($queryResult){
            
            $row = mysqli_fetch_assoc($queryResult);
            $title = $row['page_id'];
           
        }
        
        $query="SELECT l.letter_id AS 'id',l.message, u.user_name FROM my_wiki.letter as l join my_wiki.user as u ON u.user_id = l.editor_id WHERE page_id ='$title'";
        $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $returnArray = array();
        if($queryResult){
            
            while ($row = mysqli_fetch_assoc($queryResult)) {

                $returnArray[] = $row;
            }
            
            $this->message = $returnArray;
           
        }
        else {
            $this->message = "Failed";
        }
        return $this->message;
    }
    
    function getEditorialLettersEditor($bookTitle,$userId){
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
        
        $query="SELECT letter_id AS 'id',message FROM my_wiki.letter WHERE page_id = $title AND editor_id = $uid;";
        $queryResult = mysqli_query($this->dbInstance, $query);//run query
        $returnArray = array();
        if($queryResult){
            
            while ($row = mysqli_fetch_assoc($queryResult)) {

                $returnArray[] = $row;
            }
            
            $this->message = $returnArray;
           
        }
        else {
            $this->message = "Failed";
        }
        return $this->message;
    }
    
    function updateEditorialLetter($bookTitle, $message){
        
        $bookTitle = str_replace(" ","_",$bookTitle);
        $queryString = "UPDATE letter SET message='$message' WHERE letter_id='$bookTitle'";
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