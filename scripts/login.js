$(document).ready(function(){
	$(':submit').live('click',function(event){
		$(':submit').attr('disabled', true);
		$(':submit').attr('value','..Processing..');
		
		var UserInfo = {
			"username" : document.getElementById("username").value,
			"password" : document.getElementById("password").value,
			"action" : "login"
		}
		var JSONstring = JSON.stringify(UserInfo);
		alert(JSONstring)
		ajaxFunction(JSONstring);
		
		event.preventDefault();
	});
	
	function ajaxFunction(JSONstring){
		$.ajax({
			url: 'scripts/save.php',
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