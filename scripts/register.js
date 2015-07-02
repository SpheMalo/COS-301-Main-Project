$(document).ready(function(){
	$('#register-button').live('click',function(event){
		$('#register-button').attr('disabled', true);
		$('#register-button').attr('value','..Processing..');
		
		var UserInfo = {
			"username" : document.getElementById("username").value,
			"password" : document.getElementById("password").value,
			"role" : document.getElementById("roleSelect").value,			
			"email" : document.getElementById("email").value,
			"action" : "register"
		}
		//alert(UserInfo.role);
		var JSONstring = JSON.stringify(UserInfo);
		ajaxFunction(JSONstring);
		
		event.preventDefault();
	});
	
	function ajaxFunction(JSONstring){
		$.ajax({
			url: 'scripts/FigbookActionHandler/actionHandler.php',
			data: 'json='+JSONstring,
			dataType: 'json',
			success: function(data){
				alert(data);
				$('#register-button').attr('disabled', false);
				$('#register-button').attr('value','SUBMIT');
				
			},
			error: function(data){
				alert("error :"+data.responseText);
			}		
		});
	}
});