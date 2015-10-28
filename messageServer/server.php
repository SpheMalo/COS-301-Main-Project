<?php
$host = 'localhost'; //host
$port = '9000'; //port
$null = NULL; //null var
//Create TCP/IP sream socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
//reuseable port
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
//bind socket to specified host
socket_bind($socket, 0, $port);
//listen to port
socket_listen($socket);
//create & add listning socket to the list
$clients = array($socket);

//create user names list.
$clientsName = array();

//start endless loop, so that our script doesn't stop
while (true) {
	//manage multipal connections
	//$changed = $clients;
	$changed = array_values($clients);
	//print_r($changed);
	//returns the socket resources in $changed array
	socket_select($changed, $null, $null, 0, 10);
	
	//check for new socket
	if (in_array($socket, $changed)) {
		$socket_new = socket_accept($socket); //accpet new socket
		$clients[] = $socket_new; //add socket to client array
		$clients = array_values($clients);
		print "Changing clients: ";print_r($clients);
		
		$header = socket_read($socket_new, 1024); //read data sent by the socket
		perform_handshaking($header, $socket_new, $host, $port); //perform websocket handshake
		
		socket_getpeername($socket_new, $ip); //get ip address of connected socket
		$response = mask(json_encode(array('type'=>'system', 'message'=>$ip.' connected'))); //prepare json data
		send_message($response); //notify all users about new connection
		
		//make room for new socket
		$found_socket = array_search($socket, $changed);
		//unset($clientsName[$found_socket]); //added this to remove a name if the socket is removed.
		unset($changed[$found_socket]);
		
	}
	
	//loop through all connected sockets
	$changed = array_values($changed);
	foreach ($changed as $changed_socket) {	
		
		//check for any incomming data
		if(isset($changed_socket))
		{
			
			while(socket_recv($changed_socket, $buf, 1024, 0) >= 1)
			{
				//print "Received buffer: ".$buf.PHP_EOL;
				$received_text = unmask($buf); //unmask data
				//print "Received text: ".$received_text.PHP_EOL;
				$tst_msg = json_decode($received_text); //json decode
				//print "Received decoded: ".$tst_msg->message.PHP_EOL;
				
				if (isset($tst_msg))
				{
					$user_name = $tst_msg->name; //sender name
					$user_message = $tst_msg->message; //message text
					$user_to = $tst_msg->to;
					$user_color = $tst_msg->color; //color
				
					if ($user_message === "setName" &&  $user_to === "Server")
					{
						$length = count($clientsName);
						print "Length before adding: ". count($clientsName).PHP_EOL;
						
						
						for ($i = 0; $i<count($clientsName);$i++)
						{						
							if ($clientsName[$i] === $user_name)
							{
								print "Unsetting user: ". $user_name.PHP_EOL;
								unset($clientsName[$i]);
								unset($clients[$i+1]);							
								$clientsName = array_values($clientsName);
								$clients = array_values($clients);
								print_r(array_values($clients));
								print_r(array_values($clientsName));
							}						
						}
						
						$length = count($clientsName);
						$clientsName[$length] = $user_name; //adds new user's name to the list.
						print "Setting name: ".$user_name.PHP_EOL;
						$length = count($clientsName);
						print "Length after adding: ". count($clientsName).PHP_EOL;
						
						$clientsName = array_values($clientsName);
						print_r($clientsName);
						foreach ($clientsName as $cn)
						{
							print "Names: ".$cn.", Size: ".count($clientsName).PHP_EOL;						
						}
						//sending through the name list to each user.
						$nameMessage = mask(json_encode(array('type'=>'nameList', 'nameList'=>$clientsName)));
						send_message($nameMessage);
					}
					else
					{
						//prepare data to be sent to client
						$response_text = mask(json_encode(array('type'=>'usermsg', 'name'=>$user_name, 'message'=>$user_message,'to'=>$user_to, 'color'=>$user_color)));
						send_message($response_text); //send data
					}
				}
				break 2; //exits this loop
			}
			
			$buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
			if ($buf === false) { // check disconnected client
				// remove client for $clients array
				$found_socket = array_search($changed_socket, $clients);
				socket_getpeername($changed_socket, $ip);
				
				unset($clients[$found_socket]);
				unset($clientsName[$found_socket-1]);			
				$clients = array_values($clients);
				$clientsName = array_values($clientsName);
				//print_r($clients);
				//print_r($clientsName);
				
				//notify all users about disconnected connection
				$response = mask(json_encode(array('type'=>'system', 'message'=>$ip.' disconnected')));
				//send_message($response);
			}
		}
	}
}
// close the listening socket
socket_close($sock);
function send_message($msg)
{
	global $clients;
	$count =0;
	global $clientsName;// using the global $clientName
	
	$pos = strpos($msg,"{");
	$txt = json_decode(substr($msg,$pos) ); //remove weird symbols in front of json object before decoding.
	if(isset($txt->message)) 
	{print "Decoded Message: ".$txt->message.PHP_EOL;}
	
	//$txt->{'message'} = 'Hello:';
	if (isset($txt->to))
	{
		print 'Message from: '.$txt->name.PHP_EOL;
		print 'Message to: '.$txt->to.PHP_EOL;
	}
	
		if (isset($txt->to) ) //check if this is a user message
		{
			if ($txt->to === "Global")
			{
				foreach($clients as $changed_socket)
				{	
					@socket_write($changed_socket,$msg,strlen($msg));
				}
			}			
			else 
			{
				//if there is that one socket at the start which still lives but is not occupied.
				for ($i = 1; $i<count($clients);$i++)
				{	
					if (count($clients) != count($clientsName))
					{					
						if ($txt->to === $clientsName[$i-1])					
						{
							print "Socket: ".$clients[$i].", Name: ".$clientsName[$i-1].PHP_EOL;
							@socket_write($clients[$i],$msg,strlen($msg));
						}
						else if ($txt->name === $clientsName[$i-1])
						{
							print "Socket: ".$clients[$i].", Name: ".$clientsName[$i-1].PHP_EOL;
							@socket_write($clients[$i],$msg,strlen($msg));							
						}
					}
					//else there is just the same amount of client sockets than there are names.
					else if (count($clients) == count($clientsName))
					{					
						if ($txt->to === $clientsName[$i])					
						{
							print "Socket: ".$clients[$i].", Name: ".$clientsName[$i].PHP_EOL;
							@socket_write($clients[$i],$msg,strlen($msg));
						}
					}
				}
			}
		}
		else if ( $txt->type === "system" || $txt->type === "nameList")
		{			
			foreach($clients as $changed_socket)
			{	
				@socket_write($changed_socket,$msg,strlen($msg));
			}
		}
		
	
	return true;
}
//Unmask incoming framed message
function unmask($text) {
	$length = ord($text[1]) & 127;
	if($length == 126) {
		$masks = substr($text, 4, 4);
		$data = substr($text, 8);
	}
	elseif($length == 127) {
		$masks = substr($text, 10, 4);
		$data = substr($text, 14);
	}
	else {
		$masks = substr($text, 2, 4);
		$data = substr($text, 6);
	}
	$text = "";
	for ($i = 0; $i < strlen($data); ++$i) {
		$text .= $data[$i] ^ $masks[$i%4];
	}
	return $text;
}
//Encode message for transfer to client.
function mask($text)
{
	$b1 = 0x80 | (0x1 & 0x0f);
	$length = strlen($text);
	
	if($length <= 125)
		$header = pack('CC', $b1, $length);
	elseif($length > 125 && $length < 65536)
		$header = pack('CCn', $b1, 126, $length);
	elseif($length >= 65536)
		$header = pack('CCNN', $b1, 127, $length);
	return $header.$text;
}
//handshake new client.
function perform_handshaking($receved_header,$client_conn, $host, $port)
{
	$headers = array();
	$lines = preg_split("/\r\n/", $receved_header);
	foreach($lines as $line)
	{
		$line = chop($line);
		if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
		{
			$headers[$matches[1]] = $matches[2];
		}
	}
	$secKey = $headers['Sec-WebSocket-Key'];
	$secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
	//hand shaking header
	$upgrade  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
	"Upgrade: websocket\r\n" .
	"Connection: Upgrade\r\n" .
	"WebSocket-Origin: $host\r\n" .
	"WebSocket-Location: ws://$host:$port/server.php\r\n".
	"Sec-WebSocket-Accept:$secAccept\r\n\r\n";
	socket_write($client_conn,$upgrade,strlen($upgrade));
}
