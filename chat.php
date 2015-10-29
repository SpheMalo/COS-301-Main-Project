<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<style type="text/css">
<!--

-->
</style>
</head>
<body>	
<?php 
$colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
$user_colour = array_rand($colours);
?>

<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>-->

<script language="javascript" type="text/javascript">
	//function onkey(event){ if(event.keyCode==13){ alert('hello') ; } }
	
$(document).ready(function(){
	//create a new WebSocket object.
	var wsUri = "ws://10.0.0.14:9000/server.php"; 	
	websocket = new WebSocket(wsUri); 
	var myto = "Global";
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
					var newDiv = $('<div class="contact">'+nameList[i]+'</div>');
					$('#contacts').append(newDiv);
				}
							
			}
			
			var newDiv = $('<div class="contact">Global</div>');
			$('#contacts').append(newDiv);
			
			for (var i = 1;i<$('.contact').length;i++)
			{
				for (var k = i;k<=$('.contact').length;k++)
				{
					if ($('.contact:nth-child('+i+')').html() > $('.contact:nth-child('+k+')').html())
					{
						var temp = $('.contact:nth-child('+i+')').html();
						$('.contact:nth-child('+i+')').html($('.contact:nth-child('+k+')').html());
						$('.contact:nth-child('+k+')').html(temp);
					}
				}		
			}
			
			$('.contact').click(function(){
					
					
					var name = $(this).html();
					
					
					
					if ($('.contact').css('background-color') != 'rgb(233, 201, 197)')
					{
						$('.contact').css('background-color','rgb(215, 236, 213)');
					}
					
					$(this).css('background-color','rgb(190, 222, 224)');
					
					if ($(this).html() === "Global")
					{
						myto = "Global";
					}
					else
					{
						myto = $(this).html();
					}
					
					
					$('#nameTo').html(name);
					
					loadMessages($('#nameTo').html(),$('#name').val());
					
					//alert(name);
			});
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
					//alert(msg.name+" "+$('#name').val());
					
					//if Sender is me
					if (msg.name === $('#name').val() && msg.to !== "Global")
					{
						$('#message_box').append("<div><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
						document.getElementById("message_box").scrollTop = document.getElementById("message_box").scrollHeight;
					}
					//if Sender is not me and it's sent to me and i'm in his chat
					else if (msg.name === $('#nameTo').html() && msg.to !== "Global" )
					{
						$('#message_box').append("<div><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
						document.getElementById("message_box").scrollTop = document.getElementById("message_box").scrollHeight;
						saveMessage(msg.message,msg.name,msg.to,1);
					}
					//if Sender is not me and it's sent to me and i'm not in his chat
					else if (msg.name !== $('#nameTo').html() && msg.to !== "Global" )
					{
						saveMessage(msg.message,msg.name,msg.to,0); //save the message and show unread.
						
						//check if not in the tab of this person then change to red to show new msg.
						for (var i = 1;i<=$('.contact').length;i++)
						{
							//alert($('.contact:nth-child('+i+')').css('background-color'));
							if ($('.contact:nth-child('+i+')').css('background-color') != 'rgb(190, 222, 224)' && $('.contact:nth-child('+i+')').html() === msg.name ) {
								$('.contact:nth-child('+i+')').css('background-color','rgb(233, 201, 197)');
							}
						}
						
						
					}					
					//if Sender is me and it's sent to all(broadcast) 
					else if (msg.to === "Global" && msg.name === $('#name').val() && $('#nameTo').html() === "Global")
					{
						$('#message_box').append("<div><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
						saveMessage(msg.message,msg.name,msg.to,1);
						document.getElementById("message_box").scrollTop = document.getElementById("message_box").scrollHeight;
					}
					//if Sender is not me and it's sent to all(broadcast) and i'm in global chat
					else if (msg.to === "Global" && $('#nameTo').html() === "Global" && msg.name !== $('#name').val()) 					
					{
						$('#message_box').append("<div><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
						document.getElementById("message_box").scrollTop = document.getElementById("message_box").scrollHeight;
					}					
					
				}
				
			}
			if(type == 'system')
			{
				//$('#message_box').append("<div class=\"system_msg\">"+umsg+"</div>");
				//console.log("<div class=\"system_msg\">"+umsg+"</div>");
			}
		}
		//$('#message').val(''); //reset text
	};
	$('#message').bind('keypress',function(e){
		if (e.keyCode == 13)
		{
			$('#send-btn').trigger('click');
		}
	})
	websocket.onerror	= function(ev){$('#message_box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");}; 
	websocket.onclose 	= function(ev){$('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");}; 

	function saveMessage(message,from,to,seen)
	{
		
		var obj = {
	            "action":"save",
				"from": from,
	            "to": to,
	            "message":message,
	            "seen" : seen
	        }

		//alert(obj.message);
	  
		var JSONstring = JSON.stringify(obj);
		$.ajax({
			url: 'scripts/FigbookActionHandler/instantMessaging.php',
			data: 'json=' + JSONstring,
			dataType: 'json',
			success: function (data)
			{				
				//alert(JSON.stringify(data));
			}
			, error: function (data)
			{				
				//alert(JSON.stringify(data));
			}
		});
		
	} //end of saveMessage function	

	//Loading the messages on contact click
	function loadMessages(from,me)
	{
		var obj = {
	            "action":"load",
				"from": from,
	            "to": me	            
	        }

		//alert(obj.message);
	  
		var JSONstring = JSON.stringify(obj);
		$.ajax({
			url: 'scripts/FigbookActionHandler/instantMessaging.php',
			data: 'json=' + JSONstring,
			dataType: 'json',
			success: function (data)
			{				
				//alert(JSON.stringify(data));
				
				//clear the messagebox before adding all msgs
				$('#message_box').html("");
				//alert(data.length);
				for (var i =0;i<data.length;i++)
				{
					if (data[i].message_from === $('#name').val())
					{
						$('#message_box').append("<div><span class=\"user_name\" style=\"color:rgb(36, 227, 2)\">"+data[i].message_from+"</span>"+
						" : <span class=\"user_message\">"+data[i].message+"</span></div>");
					}
					else
					{
						$('#message_box').append("<div><span class=\"user_name\" style=\"color:rgb(244, 143, 6)\">"+data[i].message_from+"</span>"+
						" : <span class=\"user_message\">"+data[i].message+"</span></div>");
					}
					
				}
				document.getElementById("message_box").scrollTop = document.getElementById("message_box").scrollHeight;
				
			}
			, error: function (data)
			{				
				alert(JSON.stringify(data));
			}
		});
	}

});


</script>
<div class="chat_wrapper">
<div id="nameTo">Global</div>
<div class="message_box" id="message_box"></div>
<div class="panel">
<input class="chatName" readonly type="text" name="name" id="name" placeholder="Your Name" value="test" maxlength="10" style="width:35%;margin-top:3px;"  />
<input type="text" name="message" id="message" placeholder="Message" maxlength="256" style="width:100%;margin-top:3px;" />
<button id="send-btn" style="margin-top:3px;width:100%;height:28px;">Send</button>
</div>
</div>

</body>
</html>
