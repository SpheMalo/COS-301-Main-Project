<?php
	include_once('databaseHandler.php');

	function populateDropDown($pageName){
		
		$db = new databaseHandler();		
		if($db->isConnected()){
			if($db->isConnected() != true){
				echo "Server Not Connected";
			}
			else{
				$dbconn = $db->getConnection();
				$selectQuery = "SELECT book_title FROM section_revisions WHERE book_title = '$pageName'";
				$comments = array();
				$selectQueryResult = mysqli_query($dbconn,$selectQuery);
				if($selectQueryResult->num_rows > 0){
					echo $selectQueryResult->num_rows;
				}
			}
		}
	}

	$getJSONObject = $_REQUEST['json'];
 	$object = json_decode(stripslashes($getJSONObject));
 	$pg_name = $object->page_name;
 	//echo $pg_name;
 	populateDropDown($pg_name);
?>