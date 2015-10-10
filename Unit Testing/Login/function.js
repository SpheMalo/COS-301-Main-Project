var result = {};

function testLogin(){
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
}

function actualLoginTest(){
	var UserInfo = {
			"username" : "Mjimaro",
			"password" : "Ntate",
			"action" : "login"
	}

	var JSONstring = JSON.stringify(UserInfo);
	//alert(JSONstring);
			
	return ajaxLoginFunction(UserInfo);
}

function ajaxLoginFunction(UserInfo){
	return wiki_auth(UserInfo.username,UserInfo.password,"../../inside.php");
}

function wiki_auth(login, pass, ref)
 {
	  //alert(window.location.href);
	  var s = "Success";
	$.post('../../scripts/mediawiki/api.php?action=login&lgname=' + login + 
	    '&lgpassword=' + pass + '&format=json', function(data) {
		    //alert("1");
	if(data.login.result == 'NeedToken') {
			//alert("2");
	    $.post('../../scripts/mediawiki/api.php?action=login&lgname=' + login + 
		    '&lgpassword=' + pass + '&lgtoken='+data.login.token+'&format=json', 
		    function(data) {
		if(!data.error){
		   if (data.login.result == "Success") { 
			   //alert(data.login.result);
			   updateResult(data);
			   s = "Success";
			
		   } else {
		   	//alert("4");
			console.log('Result: '+ data.login.result);
		   }
		} else {
			//alert("5");
			return "";
		   console.log('Error: ' + data.error);
		}
	    });
	} else {
		//alert("6");
	    console.log('Result: ' + data.login.result);
	}
	if(data.error) {
		//alert("7");
	    console.log('Error: ' + data.error);
	}
	//alert(data);
    });
    //alert(JSON.stringify(result));
    //event.preventDefault();
    return s;
}

function updateResult(data){
	result = data;
}