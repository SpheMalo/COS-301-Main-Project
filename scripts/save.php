<?php
	$getJSONObject = $_REQUEST['json'];
	$object = json_decode(stripslashes($getJSONObject));
<<<<<<< HEAD
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
		
		if($username == "p" && $password == "u")
		{
			$returnString = 'correct';
			echo json_encode($returnString);
		}
		else
		{
			$returnString = 'incorrect';
			echo json_encode($returnString.'*'.$username.'*'.$password);
		}
	}
=======
	
	$username = $object->username;
	$email = $object->email;
	$password = $object->password;
	$action = $object->action;
	
	$returnString = $username.'*'.$email.'*'.$password.'*'.$action.' json object created';
	echo json_encode($returnString);
>>>>>>> origin/Interface
?>