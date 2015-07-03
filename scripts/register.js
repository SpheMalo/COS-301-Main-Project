window.onload = function()
{


	$(document).ready(function(){
		$('#register-button').click(function(){
			//$('#register-button').attr('disabled', true);
			//$('#register-button').attr('value','..Processing..');
			
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
					else if(JSONstring == "incorrect")
					{
						alert("Incorrect credentials");
					}					
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});
		}
	});

}