window.onload = function()
{


	$(document).ready(function(){
		$('#register-button').click(function(){
			//$('#register-button').attr('disabled', true);
			//$('#register-button').attr('value','..Processing..');
			
			var pass1 = document.getElementById('password');
			var pass2 = document.getElementById('confirmpassword');
			
			if (pass2.value != pass1.value)
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
				var incorrectVal = document.getElementById('incorrectVal');
				incorrectVal.innerHTML = "";
				
				var UserInfo = {
					"username" : document.getElementById("username").value,
					"password" : document.getElementById("password").value,
					"role" : document.getElementById("roleSelect").value,			
					"email" : document.getElementById("email").value,
					"action" : "register"
				}
				//alert(UserInfo.role);
				var JSONstring = JSON.stringify(UserInfo);
				ajaxRegisterFunction(JSONstring);
				
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
			alert(JSONstring);
			
			ajaxLoginFunction(JSONstring);
			
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
		
		
		function ajaxLoginFunction(JSONstring){
			$.ajax({
				url: 'scripts/FigbookActionHandler/actionHandler.php',
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
						alert("Incorrect credentials");
					}
                                        else if(data == "not_active"){
                                            
                                                alert("User is Deactivated");
                                        }
				},
				error: function(data){
					alert("error :"+data.responseText);
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