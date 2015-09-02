<?php
	include_once('databaseHandler.php');

	/**
	* Defends input against special character corruption (eg. sql injections)
	* @param $data	Text passed through
	*/
	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}

	/**
	* Persists comment passed into the database
	* @param $page_id	ID of the page in the database
	*/
	function postComment($page_id){
		$com = test_input($_POST["commentText"]);
		$db = new databaseHandler();
		if($db->isConnected()){
			$insertQuery = "INSERT INTO page_comment (comment, page_id) VALUES ('" . $com . "', '$page_id')";
			$dbconn = $db->getConnection();
        	$insertQueryResult = mysqli_query($dbconn,$insertQuery);

        	if($insertQueryResult){
        		echo "successful";
        	}
        	else{
        		echo "failed";
        	}
		}
		else{
			echo "Failed";
		}
	}
	//postComment(25);
?>