<?php
 	include_once('databaseHandler.php');

 	function populateComment($sectNum, $pg_name){
 	
 	$db = new databaseHandler();

	 	if($db->isConnected()){
	 		$selectQuery = "SELECT comment FROM page_comment WHERE section_number = '$sectNum' and page_name = '$pg_name'";
	 		$dbconn = $db->getConnection();

	 		$selectQueryResult = mysqli_query($dbconn,$selectQuery);
	 		$resultString = "";
	 		if($selectQueryResult){
	 			while($row = $selectQueryResult->fetch_assoc()){
	 				$resultString = $row["comment"];
	 			}
	 		}
	 		echo $resultString;
	 	}
	 	else{
	 		echo "failed";
	 	}
 	}

 	$getJSONObject = $_REQUEST['json'];
 	$object = json_decode(stripslashes($getJSONObject));
 	$sectNum = $object->section_number;
 	$pg_name = $object->page_name;
 	//echo json_encode($sectNum);
 	populateComment($sectNum, $pg_name);
?>