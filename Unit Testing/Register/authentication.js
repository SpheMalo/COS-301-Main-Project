window.onload = function()
{


	$(document).ready(function(){
		$('#register-button').click(function(){
			//$('#register-button').attr('disabled', true);
			//$('#register-button').attr('value','..Processing..');
			 
			var pass1 = document.getElementById('password');
			var pass2 = document.getElementById('confirmpassword');
			
			if (pass1.value == "")
			{
				
				if (document.getElementById('incorrectVal') == null) {
					var form = document.getElementById("regDiv");
				
					var incorrectVal = document.createElement('p');
					incorrectVal.id = "incorrectVal";
					incorrectVal.innerHTML = "Password not filled in.";
					incorrectVal.style.color = "#F95050";
					incorrectVal.style.fontSize ="18pt";
					form.appendChild(incorrectVal);
				}
				else
				{	
					var incorrectVal = document.getElementById('incorrectVal');
					incorrectVal.innerHTML = "Password not filled in.";
				}
				
				
				
				
				pass2.value = '';
				pass1.value = '';
				pass2.style.backgroundColor = "#F95050";
				pass1.style.backgroundColor = "#F95050";
				
				pass1.onfocus = function (){pass1.style.backgroundColor = "white";};
				pass2.onfocus = function (){pass2.style.backgroundColor = "white";};
				
				pass1.onblur = function (){pass1.style.backgroundColor = "#ABD1BC";};
				pass2.onblur = function (){pass2.style.backgroundColor = "#ABD1BC";};
				
				event.preventDefault();
			}
			else if (pass2.value != pass1.value)
			{
				if (document.getElementById('incorrectVal') == null) {
					var form = document.getElementById("regDiv");
				
					var incorrectVal = document.createElement('p');
					incorrectVal.id = "incorrectVal";
					incorrectVal.innerHTML = "Passwords do not match.";
					incorrectVal.style.color = "#F95050";
					incorrectVal.style.fontSize ="18pt";
					form.appendChild(incorrectVal);
				}
				else
				{	
					var incorrectVal = document.getElementById('incorrectVal');
					incorrectVal.innerHTML = "Password not filled in.";
				}
				
				
				pass2.value = '';
				pass1.value = '';
				pass2.style.backgroundColor = "#F95050";
				pass1.style.backgroundColor = "#F95050";
				
				pass1.onfocus = function (){pass1.style.backgroundColor = "white";};
				pass2.onfocus = function (){pass2.style.backgroundColor = "white";};
				
				pass1.onblur = function (){pass1.style.backgroundColor = "#ABD1BC";};
				pass2.onblur = function (){pass2.style.backgroundColor = "#ABD1BC";};
				
				event.preventDefault();
			}
			else
			{
				event.preventDefault();
				var incorrectVal = document.getElementById('incorrectVal');
				//incorrectVal.innerHTML = "";
				
				var UserInfo = {
					"username" : document.getElementById("username").value,
					"password" : document.getElementById("password").value,
					"role" : document.getElementById("roleSelect").value,			
					"email" : document.getElementById("email").value,
					"action" : "register"
				}
				//alert(UserInfo.role);
				//var JSONstring = JSON.stringify(UserInfo);
				//ajaxRegisterFunction(JSONstring);
				
				wiki_createAccount(UserInfo.username,UserInfo.password,UserInfo.email);
				
				event.preventDefault();
			}
		});
		
		
		$( "#login-button" ).click(function() {
			var UserInfo = {
				"username" : document.getElementById("LoginUsername").value,
				"password" : document.getElementById("LoginPassword").value,
				"action" : "login"
			}
			var JSONstring = JSON.stringify(UserInfo);
			//alert(JSONstring);
			
			ajaxLoginFunction(UserInfo);
			
			event.preventDefault();
		});
		
		
		function ajaxRegisterFunction(JSONstring){
			$.ajax({
				url: 'scripts/FigbookActionHandler/actionHandler.php',
				
				data: 'json='+JSONstring,
				dataType: 'json',
				success: function(data){
					alert("This "+data);
					
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});
		}
		
		
		function ajaxLoginFunction(UserInfo){
			//alert("Function called ");
			
			wiki_auth(UserInfo.username,UserInfo.password,"inside.php");
			
			/*$.ajax({
				//url: 'scripts/FigbookActionHandler/actionHandler.php',
				url: 'scripts/mediawiki/api.php',
				data: 'json='+JSONstring,
				dataType: 'json',
				success: function(data){
					
					if(data == "correct")
					{
						alert("Logging in...");
						 event.preventDefault();					
						window.location.pathname = "FigbookHtml/inside.html";
					}
					else if(data == "incorrect")
					{
						
						var pass1 = document.getElementById('LoginUsername');
						var pass2 = document.getElementById('LoginPassword');
						
						//alert("Incorrect credentials");
						if (document.getElementById('incorrectVal') == null) {
						var form = document.getElementById("logDiv");
					
						var incorrectVal = document.createElement('p');
						incorrectVal.id = "incorrectVal";
						incorrectVal.innerHTML = "Incorrect credentials.";
						incorrectVal.style.color = "#F95050";
						incorrectVal.style.fontSize ="18pt";
						form.appendChild(incorrectVal);
						}
						
						
						
						pass2.value = '';
						pass1.value = '';
						pass2.style.backgroundColor = "#F95050";
						pass1.style.backgroundColor = "#F95050";
						
						pass1.onfocus = function (){pass1.style.backgroundColor = "white";};
						pass2.onfocus = function (){pass2.style.backgroundColor = "white";};
						
						pass1.onblur = function (){pass1.style.backgroundColor = "#ABD1BC";};
						pass2.onblur = function (){pass2.style.backgroundColor = "#ABD1BC";};
						
						event.preventDefault();
								
					}
					else if(data == "not_active"){
					    
						alert("User is Deactivated");
					}
					},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});*/
		}
		
		//This is the function that uses wikis create account api
		function wiki_createAccount(username, password, email)
			  {
				  						
				  //alert("I get here");
				$.post('scripts/mediawiki/api.php?action=createaccount&name=' + username + 
				    '&password=' + password +'&email='+email+'&format=json', function(data) {
					 
					    //alert(data.createaccount.token);
				if(data.createaccount.result == 'NeedToken') {
					
				    $.post('scripts/mediawiki/api.php?action=createaccount&name=' + username + '&email='+email +'&realname=test'+ 
					    '&password=' + password + '&token='+data.createaccount.token+'&format=json', 
					    function(data) {
					if(!data.error){
					   if (data.createaccount.result == "Success") { 
						   //alert(data.login.sessionid);
						   //document.location.href=ref; 
						   alert("You have successfully registered, you can now log in.");
						    window.location.href = "";
						   
						  console.log("Succesfully registered");
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
			}
		
		//This calls sends a POST to the api.php with the action being login
		//thus login executing the login API functionality of mediawiki.		
		function wiki_auth(login, pass, ref)
			  {
				  //alert("I get here");
				$.post('scripts/mediawiki/api.php?action=login&lgname=' + login + 
				    '&lgpassword=' + pass + '&format=json', function(data) {
					   // alert(data.login.token);
				if(data.login.result == 'NeedToken') {
					
				    $.post('scripts/mediawiki/api.php?action=login&lgname=' + login + 
					    '&lgpassword=' + pass + '&lgtoken='+data.login.token+'&format=json', 
					    function(data) {
					if(!data.error){
					   if (data.login.result == "Success") { 
						   //alert(data.login.sessionid);
						   document.location.href=ref; 
						
					   } else {
						console.log('Result: '+ data.login.result);
					   }
					} else {
					   console.log('Error: ' + data.error);
					}
				    });
				} else {
				    console.log('Result: ' + data.login.result);
				}
				if(data.error) {
				    console.log('Error: ' + data.error);
				}
			    });
			}
		
		
		$('#activate-button').click(function(){
			var UserInfo = {
				"action" : "activate"
			}
			var JSONstring = JSON.stringify(UserInfo);
			alert(JSONstring);
			ajaxAccountFunction(JSONstring);
			event.preventDefault();
		});
	
		$('#delete-button').click(function(){
			var UserInfo = {
				"action" : "delete"
			}
			var JSONstring = JSON.stringify(UserInfo);
			alert(JSONstring);
			ajaxAccountFunction(JSONstring);
			event.preventDefault();
		});
		
		$('#suspend-button').click(function(){
			var UserInfo = {
				"action" : "suspend"
			}
			var JSONstring = JSON.stringify(UserInfo);
			alert(JSONstring);
			ajaxAccountFunction(JSONstring);
			event.preventDefault();
		});
		
		function ajaxAccountFunction(JSONstring){
			$.ajax({
				url: 'scripts/FigbookActionHandler/actionHandler.php',
				data: 'json='+JSONstring,
				dataType: 'json',
				success: function(data){
					alert(data);
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});
		}
	});

}