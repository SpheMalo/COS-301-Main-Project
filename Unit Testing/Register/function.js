function testRegister(){
		var UserInfo = {
			"username" : "Kim",
			"password" : "kimmy",
			"role" : "1",			
			"email" : "kimmy@gmail.org",
			"action" : "register"
		}

		//event.preventDefault();
		return wiki_createAccount(UserInfo.username,UserInfo.password,UserInfo.email);
}

function ajaxRegisterFunction(JSONstring){
			$.ajax({
				url: '../../scripts/FigbookActionHandler/actionHandler.php',
				
				data: 'json='+JSONstring,
				dataType: 'json',
				success: function(data){
					alert("This "+data);
					
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
	});
	return "";
}

function wiki_createAccount(username, password, email){
	$.post('../../scripts/mediawiki/api.php?action=createaccount&name=' + username + 
	    '&password=' + password +'&email='+email+'&format=json', function(data) {
		 
		    //alert(data.createaccount.token);
	if(data.createaccount.result == 'NeedToken') {
		
	    $.post('../../scripts/mediawiki/api.php?action=createaccount&name=' + username + '&email='+email +'&realname=test'+ 
		    '&password=' + password + '&token='+data.createaccount.token+'&format=json', 
		    function(data) {
		if(!data.error){
		   if (data.createaccount.result == "Success") { 
			   //alert(data.login.sessionid);
			   //document.location.href=ref; 
			   alert("You have successfully registered, you can now log in.");
			    //window.location.href = "";
			   
			  //console.log("Succesfully registered");
		   } else {
			console.log('Result: '+ data.createaccount.result);
		   }
		} else {
		   console.log('Error: ' + JSON.stringify(data.error));
		}
	    });
	} else {
	    console.log('Result: ' + data.createaccount.result);
	}
	if(data.error) {
	    console.log('Error: ' + data.error);
	}
    });
	return "";
}

function ajaxAccountFunction(JSONstring){
	$.ajax({
		url: '../../scripts/FigbookActionHandler/actionHandler.php',
		data: 'json='+JSONstring,
		dataType: 'json',
		success: function(data){
			console.log(data);
		},
		error: function(data){
			console.log("error :"+data.responseText);
		}		
	});
}