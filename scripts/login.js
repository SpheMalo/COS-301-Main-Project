$(document).ready(function(){
	$('#login-button').live('click',function(event){
		$('#login-button').attr('disabled', true);
		$('#login-button').attr('value','..Processing..');
		
		var UserInfo = {
			"username" : document.getElementById("LoginUsername").value,
			"password" : document.getElementById("LoginPassword").value,
			"action" : "login"
		}
		var JSONstring = JSON.stringify(UserInfo);
		alert(JSONstring);
		ajaxFunction(JSONstring);
		document.getElementById("loginform").reset();
		event.preventDefault();
	});
	
	function ajaxFunction(JSONstring){
		$.ajax({
			url: 'scripts/FigbookActionHandler/actionHandler.php',
			data: 'json='+JSONstring,
			dataType: 'json',
			success: function(data){

				if(data == "correct")
				{
					alert("Logging in...");
					 event.preventDefault();
	 
					 $('form').fadeOut(500);
					 $('.wrapper').addClass('form-success');
					window.location.pathname = "FigbookHtml/inside.html";
				}
				else if(JSONstring == "incorrect")
				{
					alert("Incorrect credentials");
				}
				
				$('#login-button').attr('disabled', false);
				$('#login-button').attr('value','SUBMIT');
				
				
			},
			error: function(data){
				alert("error :"+data.responseText);
			}		
		});
	}
});