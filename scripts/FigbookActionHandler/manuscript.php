<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Manuscript
 * @author Kgomotso
 */

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

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
}


?>
