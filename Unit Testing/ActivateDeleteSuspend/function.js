function testActivate(){
	var UserInfo = {
		"action" : "activate"
	}
	var JSONstring = JSON.stringify(UserInfo);
	//console.log(JSONstring);
	ajaxAccountFunction(JSONstring);
	return "activated";
	//event.preventDefault();
}
	
function testDelete(){
	var UserInfo = {
		"action" : "delete"
	}
	var JSONstring = JSON.stringify(UserInfo);
	//console.log(JSONstring);
	ajaxAccountFunction(JSONstring);
	return "deleted";
	//event.preventDefault();
}
		
function testSuspend(){
	var UserInfo = {
		"action" : "suspend"
	}
	var JSONstring = JSON.stringify(UserInfo);
	//console.log(JSONstring);
	ajaxAccountFunction(JSONstring);
	return "suspended";
	//event.preventDefault();
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