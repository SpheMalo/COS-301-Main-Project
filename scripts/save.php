<?php
	$getJSONObject = $_REQUEST['json'];
	$object = json_decode(stripslashes($getJSONObject));
	
	$username = $object->username;
	$email = $object->email;
	$password = $object->password;
	$action = $object->action;
	
	$returnString = $username.'*'.$email.'*'.$password.'*'.$action.' json object created';
	echo json_encode($returnString);
?>