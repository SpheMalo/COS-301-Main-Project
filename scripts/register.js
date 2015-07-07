$(document).ready(function(){
	$(':submit').live('click',function(event){
		//alert("Hello");
		//
		$('form').fadeOut(500);
	        $('.wrapperReg').addClass('form-success');
		$(':submit').attr('value','..Processing..');
		//$(':submit').attr('disabled', true);
		 

		//alert("help");
		var UserInfo = {			
			"username" : document.getElementById("username").value,
			"password" : document.getElementById("password").value,
			"email" : document.getElementById("email").value		
		}
		var JSONstring = JSON.stringify(UserInfo);
		alert(JSONstring);
		ajaxFunction(JSONstring);
		
		event.preventDefault();
	});
	
	function ajaxFunction(JSONstring){
		alert(window.location.pathname.split('/'));
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
				alert("error :"+data.responseText);
			}		
		});
		
	}
});

//function foo(){}