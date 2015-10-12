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
	function postComment($page_name, $section_number, $com, $uName){
		$db = new databaseHandler();
		if($db->isConnected()){

			$insertQuery = "INSERT INTO page_comment (comment, page_name, section_number, last_edited_by) VALUES ('$com', '$page_name', '$section_number', '$uName')";
			$updateQuery = "UPDATE page_comment SET comment = '$com', last_edited_by = '$uName' WHERE section_number = '$section_number' And WHERE page_name= '$page_name' ";
			
			$selectQuery = "SELECT * FROM page_comment WHERE section_number = '$section_number' AND page_name = '$page_name' ";
			
			$dbconn = $db->getConnection();
        	$selectQueryResult = mysqli_query($dbconn,$selectQuery);

			if($selectQueryResult->num_rows > 0){
				$updateQueryResult = mysqli_query($dbconn,$updateQuery);
				echo "Updating section " . $section_number;
			}
			else{
				$insertQueryResult = mysqli_query($dbconn,$insertQuery);
				echo "Inserting at section " . $section_number;
			}

           	if(isset($insertQueryResult) || isset($updateQueryResult)){
        		echo $uName;
        		//return "successful";
        	}
        	else{
        		echo "failed";
        	}
		}
		else{
			echo "FAILED";
		}
	}

	//get json string
$getJSONObject = $_REQUEST['json'];

$object = json_decode(stripslashes($getJSONObject));
//get the action flag	
$pg_name = $object->page_name;
$sect = $object->section_number;
$com = $object->commentText;
$uName = $object->user_name;
    //echo "Name:".$sect;
	postComment($pg_name, $sect, $com, $uName);
?>