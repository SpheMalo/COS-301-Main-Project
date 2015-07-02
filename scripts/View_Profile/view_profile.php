<?php

session_start();

	$_SESSION['userID'] = '1';

	public function view_profile($dbObject)
	{
		$userID = $SESSION['userID'];
		
		if ($userID != '')
		{
			$sql = "SELECT * FROM useraccount WHERE UserID = ".$userID;
			$result = $conn->query($sql);
		
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				echo json_encode($row);
			}
		}
	}
	
	private function getUserRole($dbObject, $userID)
	{
		
	}
?>