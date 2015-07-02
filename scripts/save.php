<?php
	$getJSONObject = $_REQUEST['json'];
	$object = json_decode(stripslashes($getJSONObject));
	$action = $object->action;
	if($action == "register"){
		$username = $object->username;
		$email = $object->email;
		$password = $object->password;
		
		$returnString = $username.'*'.$email.'*'.$password.'*'.$action.' json object created';
		echo json_encode($returnString);
	}
	else if($action == "login"){
		$username = $object->username;
		$password = $object->password;
		
		if($username == "u" && $password == "p")
		{
			$returnString = 'logged in';
			echo json_encode($returnString);
		}
		else
		{
			$returnString = 'incorrect credentials';
			echo json_encode($returnString.'*'.$username.'*'.$password);
		}
	}
?>