$(document).ready(function(){
	$(':submit').live('click',function(event){
		$(':submit').attr('disabled', true);
		$(':submit').attr('value','..Processing..');
		
		var UserInfo = {
			"username" : document.getElementById("username").value,
			"password" : document.getElementById("password").value,
			"email" : document.getElementById("email").value,
			"action" : "register"
		}
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
				$(':submit').attr('disabled', false);
				$(':submit').attr('value','SUBMIT');
				
			},
			error: function(data){
				alert("error :"+data);
			}		
		});
	}
});