<?php

session_start();

	

	public function view_profile($dbObject)
	{
		$userID = $SESSION['userID'];
		
		if ($userID != '')
		{
			$userRole = getUserRole($dbObject, $userID);
		
			if ($userRole == "author")
			{
				$sql = "SELECT * FROM author WHERE UserID = ".$userID;
				$result = $conn->query($sql);
				
				$rows = array();
				while($r = mysqli_fetch_assoc($sth))
				{
					$rows[] = $r;
				}
				return json_encode($rows);
			}	
		}
	}
	
	private function getUserRole($dbObject, $userID)
	{
		$sql = "SELECT userRole FROM useraccount WHERE UserID = ".$userID;
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			
			return $row['userRole'];
		}
	}
?>