<?php
	include_once('databaseHandler.php');
    
    function saveMessage($from, $to, $message, $seen)
    {
        $db = new databaseHandler();
		if($db->isConnected())
        {
			$insertQuery = "INSERT INTO instant_messaging (message_from, message_to, message, seen)".
            "VALUES ('$from', '$to', '$message', '$seen')";		
			
			$dbconn = $db->getConnection();
        	$insertQueryResult = mysqli_query($dbconn,$insertQuery);			

           	if(isset($insertQueryResult))
            {
        		echo "Message saved successfully." ;
        		//return "successful";
        	}
        	else
            {
        		echo "Failed, could not save message.";
        	}
		}
		else
        {
			echo "FAILED, not connected to database.";
		}
    }
    
    function loadMessages($from, $to)
    {
        $db = new databaseHandler();
		if($db->isConnected())
        {
            if ($from === "Global" || $to === "Global")
            {
                $selectQuery = "Select * from instant_messaging where message_from = 'Global' or message_to = 'Global' ".
               " ORDER BY time";                 
            }
            else
            {
                $selectQuery = "Select * from instant_messaging where message_from = '$from' and message_to = '$to' ".
                "or message_from = '$to' and message_to = '$from' ORDER BY time";
            }
			
			$dbconn = $db->getConnection();
        	$selectQueryResult = mysqli_query($dbconn,$selectQuery);			

           	if(isset($selectQueryResult))
            {
                $arr = [];
                $counter = 0;
                
        		while ($row = mysqli_fetch_assoc($selectQueryResult) )
                {
                    array_push($arr, $row);
                    $counter++;
                }
                
                echo json_encode($arr);
                
        	}
        	else
            {
        		echo "Failed, could not load message.";
        	}
		}
		else
        {
			echo "FAILED, not connected to database.";
		}
    }
    
    
    //Get the sent data and retrieve all data 
    $getJSONObject = $_REQUEST['json'];
    $object = json_decode(stripslashes($getJSONObject));
    //get the action flag
    $action = $object->action;
    
    if ($action == 'save')
    {   
        $from = $object->from;
        $to = $object->to;
        $message = $object->message;
        $seen = $object->seen;
        saveMessage($from, $to, $message, $seen);
    }
    else if ($action == 'load')
    {
        $from = $object->from;
        $to = $object->to;        
        loadMessages($from, $to);
    }
    
	
?>