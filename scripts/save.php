<?php
	require_once("connection.php")
	
	$getJSONObject = $_REQUEST['json'];
	$object = json_decode(stripslashes($getJSONObject));
	
	
	$username = $object->username;
	$email = $object->email;
	$password = $object->password;
	
	$returnString = $username.'*'.$email.'*'.$password.' json object created';
	echo json_encode($returnString);
	
	
	$sql = "INSERT INTO useraccount(Username, Password, EmailAddress, Status)
	VALUES ('$username','$password','$email',1)";
	
	if (mysqli_query($conn, $sql)) 
	{
	echo "New record created successfully";
	} 
	else
	{
	    echo "Error: something wrong " . $sql . mysqli_error($conn);
	}
		
?>