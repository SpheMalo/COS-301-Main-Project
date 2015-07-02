$(document).ready(function(){
	$(':submit').live('click',function(event){
		$(':submit').attr('disabled', true);
		$(':submit').attr('value','..Processing..');
		
		var UserInfo = {
			"username" : document.getElementById("LoginUsername").value,
			"password" : document.getElementById("LoginPassword").value,
			"action" : "login"
		}
		var JSONstring = JSON.stringify(UserInfo);
		//alert(JSONstring);
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