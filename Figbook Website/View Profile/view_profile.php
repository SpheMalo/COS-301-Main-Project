<?php

	session_start();
		
	public function viewProfile($dbobject, $username)
	{
		//check if the user is logged in
		if (isset($_SESSION['username']) && $_SESSION['username'] == $username)
		{
			
		} 
		else
		{
			echo "Please log in first to see this page.";
		}
	
	}
?>