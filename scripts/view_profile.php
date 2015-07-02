<?php

	public function view_profile($dbObject, $userID)
	{
		$sql = "SELECT userRole FROM useraccount WHERE UserID = ".$userID;
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			
			if ()
		}
	}
	
	private function
?>