<?php

require("constants.php");
/**
 *Description of databaseHandler
 *handles db connections, from setting up to opening a connection
 * @author LabUser
 */


class databaseHandler {
    
    ///properties
    private $dbconnection;
    
    
    ///methods
    
    ///open a database connection and initialise connection object
    public function __construct(){
        $this->dbconnection = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
        
        if (!$this->dbconnection){
            die ("database connection failed ". mysql_error());
        }
        
    }
    
    ///close the database connection
    public function __destruct() {
        mysqli_close($this->dbconnection); 
    }
    
    ///returns the connection variable 
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
    
    /**
    * Just in case we have to explicitly close the db connection
    */
    public function closeConnection(){       
        mysqli_close($this->dbconnection);
        
        echo "\n"."connection succesfully closed";
    }
}

?>
