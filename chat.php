<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<style type="text/css">
<!--
.chat_wrapper {
	width: 400px;
	height:300px;
	margin-right: auto;
	margin-left: auto;
	background: #CCCCCC;
	border: 1px solid #999999;
	padding: 10px;
	font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;
}
.chat_wrapper .message_box {
	background: #FFFFFF;
	height: 150px;
	overflow: auto;
	padding: 10px;
	border: 1px solid #999999;
}
.chat_wrapper .panel input{
	padding: 2px 2px 2px 5px;
}
.content{
	width:100%;min-width:100px;height:30px;
	text-align:center;
	border:1px solid rgb(100,100,100);
	background-color: rgb(200,200,200);
}

.system_msg{color: #BDBDBD;font-style: italic;}
.user_name{font-weight:bold;}
.user_message{color: #88B6E0;}
#message_box{height:200px;}
-->
</style>
</head>
<body>	
<?php 
$colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
$user_colour = array_rand($colours);
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script language="javascript" type="text/javascript">  
$(document).ready(function(){
	//create a new WebSocket object.
	var wsUri = "ws://localhost:9000/server.php"; 	
	websocket = new WebSocket(wsUri); 
	var myto = "Rainier";
	var nameList = Array();
	
	websocket.onopen = function(ev) { // connection is open 
		$('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
		var myname = $('#name').val();
		
		//prepare json data
		var msg = {
		message: "setName",
		name: myname,
		to: "Server",
		color : '<?php echo $colours[$user_colour]; ?>'
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
	}
	$('#send-btn').click(function(){ //use clicks message send button	
		var mymessage = $('#message').val(); //get message text
		var myname = $('#name').val(); //get user name		
		
		if(myname == ""){ //empty name?
			alert("Enter your Name please!");
			return;
		}
		if(mymessage == ""){ //emtpy message?
			alert("Enter Some message Please!");
			return;
		}
		
		//prepare json data
		var msg = {
		message: mymessage,
		name: myname,
		to: myto,
		color : '<?php echo $colours[$user_colour]; ?>'
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
		$('#message').val(''); //reset text
	});
	
	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
		
		if (msg.type == "nameList") {
			nameList = msg.nameList;
			$('#contacts').html("");
			for(var i = 0;i< nameList.length;i++)
			{
				//alert(nameList[i]);
				if (nameList[i] !== readCookie("username"))
				{				
				var newDiv = $('<div class="content">'+nameList[i]+'</div>');
				$('#contacts').append(newDiv);
				}
			}
			
		}
		else
		{		
			var type = msg.type; //message type
			var umsg = msg.message; //message text
			var uname = msg.name; //user name
			var ucolor = msg.color; //color
			if(type == 'usermsg') 
			{
				if (uname === null) {
					
				}
				else{
					$('#message_box').append("<div><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
					//document.getElementById("message_box").scrollTo(0,$('#message_box').scrollHeight);
					document.getElementById("message_box").scrollTop = document.getElementById("message_box").scrollHeight;
				}
				
			}
			if(type == 'system')
			{
				$('#message_box').append("<div class=\"system_msg\">"+umsg+"</div>");
				console.log("<div class=\"system_msg\">"+umsg+"</div>");
			}
		}
		//$('#message').val(''); //reset text
	};
	
	websocket.onerror	= function(ev){$('#message_box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");}; 
	websocket.onclose 	= function(ev){$('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");}; 
});
</script>
<div class="chat_wrapper">
<div class="message_box" id="message_box"></div>
<div class="panel">
<input class="chatName" readonly type="text" name="name" id="name" placeholder="Your Name" value="test" maxlength="10" style="width:35%;margin-top:3px;"  />
<input type="text" name="message" id="message" placeholder="Message" maxlength="256" style="width:100%;margin-top:3px;" />
<button id="send-btn" style="margin-top:3px;width:100%;height:28px;">Send</button>
</div>
</div>

</body>
</html>
