
function addGif(statement,name,wrap)
{
    var obj = '<div id="loadingDiv" style="position:relative;width:160px;height:30px;">'
            +'<div style="height:30px;font-size:20px;font-weight:500;line-height:30px;float:left;">'+statement+'</div> '
            +'<img src="FeedBackIcons/'+name+'.GIF" alt="Feedback Icon" '
            +'style="width:50px;height:30px;">'
            +'</div>';
	
    var left = ($(wrap).width()-100)/2;
    //var top = (window.innerHeight-30)/2;
   // alert($('.wrapper').html());
    //addLightbox(obj);
    $(wrap).append(obj);
   
    $("#loadingDiv").css('left',left);
    if (wrap === '.wrapper') {
        $("#loadingDiv").css('top','20px');
    }
    else if (wrap === '.wrapperReg') {
        $("#loadingDiv").css('top','80px');
        
    }
    
    
   
}
function removeGif()
{
    $("#loadingDiv").fadeOut(600, function(){
        $(this).remove();
        //closeLightbox();
    });
}



function addLightbox(insertContent) {
	// add lightbox/shadow <div/>'s if not previously added
		if($('#lightbox').size() == 0){
			var theLightbox = $('<div id="lightbox"/>');
			var theShadow = $('<div id="lightbox-shadow"/>');
			$(theShadow).click(function(e){
				closeLightbox();
			});
			$('body').append(theShadow);
			$('body').append(theLightbox);
		}
		
		// remove any previously added content
		//$('#lightbox').empty();
		
		//center the lightbox
		//alert(window.innerWidth+" "+$('#lightbox').width());
		var val = (window.innerWidth-$('#lightbox').width())/2;
		$('#lightbox').css("left",val);
		
		// insert HTML content
		if(insertContent != null){
			$('#lightbox').append(insertContent);
		}
		
		$('#lightbox').css('top', $(window).scrollTop() + 100 + 'px');
		
		// display the lightbox
		$('#lightbox').show();
		$('#lightbox-shadow').show();
		
}

// close the lightbox
function closeLightbox(){
	
	// jQuery wrapper (optional, for compatibility only)
	(function($) {
		
		// hide lightbox/shadow <div/>'s
		$(".wrapper").fadeOut("slow",function(){});
		$(".wrapperReg").fadeOut("slow",function(){});
		$('#lightbox').hide();
		$('#lightbox-shadow').hide();
		
		// remove contents of lightbox in case a video or other content is actively playing
		//$('#lightbox').empty();
	
	})(jQuery); // end jQuery wrapper
	
}
window.onresize = function(){
	var val = (window.innerWidth-$('#lightbox').width())/2;
		$('#lightbox').css("left",val);
	
	
}
window.onload = function()
{
		
	$(document).ready(function(){
		
        //Clicking on the register example link
         $("#vidMenu div:nth-child(1)").click(function(){
                $("#vidPlayer").fadeOut(600,function(){
                        $(this).attr('src','videos/reg.mp4');                        
                        $("#vidPlayer").fadeIn(600);
                });  
               
        });
         
        //Clicking on the Login example link
        $("#vidMenu div:nth-child(2)").click(function(){
                
                $("#vidPlayer").fadeOut(600,function(){
                        $(this).attr('src','videos/login.mp4');
                        $("#vidPlayer").fadeIn(600);
                });              
        });
        
        //Play and Pause video when clicking on it
        $("#vidPlayer").click(function(){
                
              $(this).get(0).paused ? $(this).get(0).play() : $(this).get(0).pause(); 
        });
				
		$('#log').click(function(){
			addLightbox($(".wrapper"));
			$(".wrapper").fadeIn("slow",function(){/*finished*/});

		});
		
		
		$('#reg').click(function(){

			    addLightbox($(".wrapperReg"));
			    $(".wrapperReg").fadeIn("slow",function(){/*finished*/});

		});
		
		
		$('#register-button').click(function(event){
            
            //Remove error message if there is one
            if (document.getElementById("incorrectVal") != null) {
                
                document.getElementById("incorrectVal").innerHTML = "";
            }
            
            addGif('Registering...','loadingNew','.wrapperReg');
			var pass1 = document.getElementById('password');
			var pass2 = document.getElementById('confirmpassword');
			
			if (pass1.value == "" || pass2.value == "")
			{
                removeGif();
				addErrorCode("Passwords Do Not Match. Please try again", "password");
				event.preventDefault();
			}
			else if (pass2.value != pass1.value)
			{
                removeGif();
				addErrorCode("Passwords Do Not Match. Please try again", "password");
				
				event.preventDefault();
			}
            //Ensure password is atleast 8 characters
            else if (pass1.value.length < 8)
            {
                removeGif();
                addErrorCode("For your security, passwords must be atleast 8 characters", "password");
                
                event.preventDefault();
            }
			else
			{
				event.preventDefault();
				var incorrectVal = document.getElementById('incorrectVal');

				var UserInfo = {
					"username" : document.getElementById("username").value,
					"password" : document.getElementById("password").value,
					"role" : document.getElementById("roleSelect").value,			
					"email" : document.getElementById("email").value,
					"action" : "register"
				}
				
				var stat = 1;
				wiki_createAccount(UserInfo.username,UserInfo.password,UserInfo.email, UserInfo.role, stat);
				removeGif();
                event.preventDefault();
			}
		});
		
		/**
		 *@description This function inserts an error message at the bottom of the register box if registration failed.
		 *@param {String} errCode The error message to display
		 *@param {String} field Identifies which field the error came from
		 */
		function addErrorCode(errCode, field){
			
			if (field == "invalidemailaddress") {
				errCode = "Invalid email address. Please re-enter email address";
			}

			if (document.getElementById('incorrectVal') == null) {
				var form = document.getElementById("regDiv");
				var incorrectVal = document.createElement('p');
				incorrectVal.id = "incorrectVal";
				incorrectVal.innerHTML = errCode;
				incorrectVal.style.color = "#F95050";
				incorrectVal.style.fontSize ="18pt";
				form.appendChild(incorrectVal);
			}
			
			else
			{
                removeGif();
				var incorrectVal = document.getElementById('incorrectVal');
				incorrectVal.innerHTML = errCode;
			}
				
			if (field == "password" || field == "password-name-match")
			{
                removeGif();
				var pass1 = document.getElementById('password');
				var pass2 = document.getElementById('confirmpassword');
			
				pass2.value = '';
				pass1.value = '';
				pass2.style.backgroundColor = "#F95050";
				pass1.style.backgroundColor = "#F95050";
				
				pass1.onfocus = function (){pass1.style.backgroundColor = "white";};
				pass2.onfocus = function (){pass2.style.backgroundColor = "white";};
				
				pass1.onblur = function (){pass1.style.backgroundColor = "#ABD1BC";};
				pass2.onblur = function (){pass2.style.backgroundColor = "#ABD1BC";};
			}
			else if (field == "invalidemailaddress")
			{
                removeGif();
				var email = document.getElementById('email');
				
				email.value = '';
				email.style.backgroundColor = "#F95050";
				
				email.onfocus = function (){email.style.backgroundColor = "white";};
				
				email.onblur = function (){email.style.backgroundColor = "#ABD1BC";};
			}	
			else if (field == "userexists")
			{
                
                removeGif();
				var username = document.getElementById('username');
				
				username.value = '';
				username.style.backgroundColor = "#F95050";
				
				username.onfocus = function (){username.style.backgroundColor = "white";};
				
				username.onblur = function (){username.style.backgroundColor = "#ABD1BC";};
			}
			else if (field == "loginErr")
			{
                removeGif();
				if (document.getElementById('loginIncorrect') == null)
				{
					var form = document.getElementById("logDiv");
				
					var incorrectVal = document.createElement('p');
					incorrectVal.id = "loginIncorrect";
					incorrectVal.innerHTML = errCode;
					incorrectVal.style.color = "#F95050";
					incorrectVal.style.fontSize ="18pt";
					form.appendChild(incorrectVal);
				}
				else
				{
                        
					var incorrectVal = document.getElementById('loginIncorrect');
					incorrectVal.innerHTML = errCode;
				}
				
				var uname = document.getElementById('LoginUsername');
				var pword = document.getElementById('LoginPassword');
				
				uname.value = '';
				pword.value = '';
				
				uname.style.backgroundColor = "#F95050";
				pword.style.backgroundColor = "#F95050";
				
				uname.onfocus = function (){username.style.backgroundColor = "white";};
				pword.onfocus = function (){password.style.backgroundColor = "white";};
				
				uname.onblur = function (){username.style.backgroundColor = "#ABD1BC";};
				pword.onblur = function (){password.style.backgroundColor = "#ABD1BC";};
			}
		}
		
		$('#logoutDiv').click(function(){wiki_logout(); });
		
		$( "#login-button" ).click(function(event) {
                        
            //remove the error message if there is one.    
            if (document.getElementById('loginIncorrect') != null)
            {
                document.getElementById('loginIncorrect').innerHTML = "";    
            }
            
            if (document.getElementById("LoginUsername").value == "" || document.getElementById("LoginPassword").value == "") {
                removeGif();
                addErrorCode("Fields cannot be empty.", "loginErr");
                event.preventDefault();
            }
            
			addGif('Logging in...','loadingNew','.wrapper');
            var UserInfo = {
				"username" : document.getElementById("LoginUsername").value,
				"password" : document.getElementById("LoginPassword").value,
				"action" : "login"
			}
			var JSONstring = JSON.stringify(UserInfo);
			ajaxLoginFunction(UserInfo);
			event.preventDefault();
		});

		function ajaxLoginFunction(UserInfo){
			wiki_auth(UserInfo.username,UserInfo.password,"insideContent.php");
            removeGif();
		}

		/**
		 * Creates a new account using wikis api
		 * @param {String} username
		 * @param {String} password
		 * @param {String} email
		 * @param {String} role
		 * @param {Number} status
		 */
		function wiki_createAccount(username, password, email, role, status) {			
			$.post('scripts/mediawiki/api.php?action=createaccount&name=' + username + 
			    '&password=' + password + '&uRole='+ role + '&uStatus=' + status +'&email='+email+'&format=json', 
			    function(data) {	
					if(data.createaccount.result === 'NeedToken') {
						$.post('scripts/mediawiki/api.php?action=createaccount&name=' + username + '&email='+email +'&realname=test'+ 
						    '&password=' + password +'&uRole='+ role + '&uStatus=' +status+ '&token='+data.createaccount.token+'&format=json', 
						    function(data) {
								if(!data.error){
								   if (data.createaccount.result === "Success") { 
									   //alert(data.login.sessionid);
									   //document.location.href=ref; 
									  removeGif();
                                       alert("You have successfully registered, you can now log in.");
									    
                                        window.location.href = "";
									   
									  console.log("Succesfully registered");
								   } else {
									console.log('Result: '+ data.createaccount.result);
								   }
								} else {
									var err = JSON.stringify(data.error);
									err = JSON.parse(err);
									addErrorCode(err.info, err.code);
								   console.log('Error: ' + JSON.stringify(data.error));
								}
					    	}
					  	);
					} 
					else {
					    console.log('Result: ' + data.createaccount.result);
					}

					if(data.error) {
					    console.log('Error: ' + data.error);
					}
		    	}
		    );
		}

		/**
		 * This calls sends a POST to the api.php with the action being login thus login executing the login API functionality of mediawiki.	
		 * @param {String} login
		 * @param {String} pass
		 * @param {String} ref
		 */	
		function wiki_auth(login, pass, ref){
			$.post('scripts/mediawiki/api.php?action=login&lgname=' + login + 
			    '&lgpassword=' + pass + '&format=json', 
			    function(data) {
					if(data.login.result == 'NeedToken') {
			    		$.post('scripts/mediawiki/api.php?action=login&lgname=' + login + 
				    		'&lgpassword=' + pass + '&lgtoken='+data.login.token+'&format=json', 
				    		function(data) {
								if(!data.error){
								   if (data.login.result == "Success") { 
									   //alert(data.login.sessionid);
									  console.log(JSON.stringify(data));
                                                document.cookie="username="+data.login.lgusername;
                                                var UserInfo = {			
                                                  "action" : "getUserStatus"
                                                  }
                                                var JSONstring = JSON.stringify(UserInfo);
                                                $.ajax({
                                                      url: 'scripts/FigbookActionHandler/actionHandler.php',
                                                      data: 'json='+JSONstring,
                                                      dataType: 'json',
                                                      success: function(data1){
                                                              console.log(data1);
                                                              if(data1 === "1"){
                                                                  removeGif();
                                                                  document.location.href=ref;
                                                              
                                                                  
                                                                    
                                                                   
                                                              }
                                                              else if(data1 === "0"){
                                                                  removeGif();
                                                                  document.cookie = "username" + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                                                                  addErrorCode("Your account has been deleted, contact administrator", "loginErr");
                                                              }
                                                              else if(data1 === "2"){
                                                                      removeGif();
                                                                  document.cookie = "username" + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                                                                  addErrorCode("This account has been suspended, contact administrator", "loginErr");
                                                              }
                                                              //localStorage.setItem("lgusername", data.login.lgusername);
                                                              //document.location.href=ref; 
                                                      },
                                                      error: function(data1){
                                                              removeGif();
                                                              console.log("error :"+data1.responseText);
                                                      }		
                                                  });
            
									
								   } else {
                                        removeGif();
									addErrorCode("Invalid Credentials. Please check credentials, Register an account or click \"forgot password\" above.", "loginErr");
									console.log('Result: '+ data.login.result);
								   }
								} 
								else {
                                        removeGif();
					   				console.log('Error: ' + data.error);
								}
			   				 }
			   			);
					} else {
                        removeGif();
			    		console.log('Result: ' + data.login.result);
					}

					if(data.error) {
                        removeGif();
					    console.log('Error: ' + data.error);
					}
			    }
			);
		}
		
		$('#activate-button').click(function(event){
			var UserInfo = {
					"action" : "activate"
			}
			var JSONstring = JSON.stringify(UserInfo);
			console.log(JSONstring);
			ajaxAccountFunction(JSONstring);
			event.preventDefault();
		});
		
		$('#delete-button').click(function(event){
			alert("here");
			//console.log(document.cookie);
			var UserInfo = {				
				"action" : "delete"
			}
			var JSONstring = JSON.stringify(UserInfo);
			
			console.log(JSONstring);
			ajaxAccountFunction(JSONstring);
			event.preventDefault();
		});
		
		$('#suspend-button').click(function(){
			var UserInfo = {			
				"action" : "suspend"
			}
			var JSONstring = JSON.stringify(UserInfo);
			console.log(JSONstring);
			ajaxAccountFunction(JSONstring);
			event.preventDefault();
		});

		$('#getStatus-button').click(function(event){
            var UserInfo = {			
				"action" : "getUserStatus"
			}
			var JSONstring = JSON.stringify(UserInfo);
			console.log(JSONstring);
			ajaxAccountFunction(JSONstring);
			event.preventDefault();
            
        });

		function ajaxAccountFunction(JSONstring){
			$.ajax({
				url: 'scripts/FigbookActionHandler/actionHandler.php',
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
	});

	
};