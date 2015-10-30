window.onload = function(){
	
$(document).ready(function() {
	
	$('#footList span:nth-child(1)').click(function(){
			location.replace('http://www.figtory.com');       
	});
	
	$('#footList span:nth-child(3)').click(function(){
			window.location.href = 'tutorials.html';       
	});
	
	$('#figbookLogo').click(function(){
		window.location.href = 'insideContent.php';	
	});	

	
$('#portImage').click(function(){
	
	//open the file upload dialog by clicking on the image.
	//and then when done upload it.
		$( "#fileToUpload" ).trigger( "click");
		var counter = 0;
			
	
});

$( "#fileToUpload" ).change(function() {		  
             addGif('Uploading Picture','loadingNew');
		  	 $( "#submitFile" ).trigger("click");	
});


var form = document.getElementById('uploadForm');
var fileSelect = document.getElementById('fileToUpload');

//this will use ajax to upload files.
form.onsubmit = function(event)
{
	event.preventDefault();
	
	
	// The rest of the code will go here...
	var files = fileSelect.files;
	// Create a new FormData object.
	var formData = new FormData();
	
	// Loop through each of the selected files.
	for (var i = 0; i < files.length; i++) {
	  var file = files[i];
	
	  // Check the file type.
	  if (!file.type.match('image.*')) {
		removeGif();
		alert("Wrong file type");
		continue;
		
	  }
	
	  // Add the file to the request.
	  formData.append('fileToUpload', file, file.name);

	}
	// Set up the request.
		var xhr = new XMLHttpRequest();
	  // Open the connection.
		xhr.open('POST', 'scripts/upload.php', true);
		// Set up a handler for when the request finishes.
		xhr.onload = function () {
		  if (xhr.status === 200) {
			// File(s) uploaded.
			//alert(xhr.responseText);
			$("#profileLink").trigger("click");
			removeGif();
			//uploadButton.innerHTML = 'Upload';
		  } else {
			removeGif();
			alert('An error occurred!');
		  }
		};
	
	// Send the Data.
	xhr.send(formData);
	
}


	
function addLightbox(insertContent) {
	$('.options').removeClass('pullDown');
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
		$('#lightbox').empty();
		
		//center the lightbox
		//alert(window.innerWidth+" "+$('#lightbox').width());
		var val = (window.innerWidth-$('#lightbox').width())/2;
		$('#lightbox').css("left",val);
		
		// insert HTML content
		if(insertContent != null){
			$('#lightbox').append(insertContent);
		}
		
		//$('#lightbox').css('top', $(window).scrollTop() + 100 + 'px');
		
		//display the lightbox
		
		
		$('#lightbox').show();
		$('#lightbox-shadow').show();
	}	

	// close the lightbox
	function closeLightbox(){
		
		// jQuery wrapper (optional, for compatibility only)
		(function($) {
			
			// hide lightbox/shadow <div/>'s
			$("#addChapterArea").fadeOut("slow",function(){});
			$("#sendManuscriptContainer").fadeOut("slow",function(){});
                        $("#DelBookDiv").fadeOut("slow",function(){});
			$("#bookDiv").fadeOut("slow",function(){});
			$('#lightbox').hide();
			$('#lightbox-shadow').hide();
			
			// remove contents of lightbox in case a video or other content is actively playing
			//$('#lightbox').empty();
		
		})(jQuery); // end jQuery wrapper
		
	}
	
	
	
	
	 var action =
                {
                    "action" : "viewprofile"
                }
              	var JSONstring = JSON.stringify(action);
			
			$.ajax({
				url: 'scripts/FigbookActionHandler/actionHandler.php',
				data: 'json='+JSONstring,
				dataType: 'json',
				success: function(data){
                    //createProfile(data);
                                //console.log(JSON.stringify(data));
								
                                localStorage.genericUserRole = data.user_role;
                                localStorage.userName = data.user_name;
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});
	
	//This is the edit and save button for the users profile/portfolio.
	//It has two states: Save and Edit.
	
	function addGif(statement,name)
	{
    var obj = '<div id="loadingDiv" style="position:relative;width:160px;height:30px;">'
            +'<div style="height:30px;font-size:20px;font-weight:500;line-height:30px;float:left;color:white;">'+statement+'</div> '
            +'<img src="FeedBackIcons/'+name+'.GIF" alt="Feedback Icon" '
            +'style="width:50px;height:30px;">'
            +'</div>';
			
		var left = (window.innerWidth-100)/2;
		//var top = (window.innerHeight-30)/2;
		
		addLightbox(obj);
		$("#loadingDiv").css('left',left);
		$("#loadingDiv").css('top','200px');
	}
	function removeGif()
	{
		$("#loadingDiv").delay(1000).fadeOut(600, function(){
			$(this).remove();
			closeLightbox();
		});
	}
	
	$("#profileEditButton").click(function(){			
				
				addGif('Saving...','loadingNew');
				
				//Persisting to the database
				var profileArray = document.getElementsByClassName("profileInfo");
				var action =
                {
					"username": profileArray[0].value,
					"firstname":profileArray[1].value,
					"surname":profileArray[2].value,
					"genres":profileArray[3].value,
                    "action" : "updatePortfolioInfo"
                }
              	var JSONstring = JSON.stringify(action);
			
			$.ajax({
				url: 'scripts/FigbookActionHandler/actionHandler.php',
				data: 'json='+JSONstring,
				dataType: 'json',
				success: function(data){
					if (data == true) {
						console.log("successfully updated");
						
					}
					else{
						alert("update failed. Try again");
					}
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});
			
			
				//Persist changes to the database
				var aboutArray = document.getElementsByClassName("aboutMeInfo");
				var action =
                {
					"aboutme": aboutArray[0].value,
					//"addInfo":aboutArray[1].value,
                    "action" : "updateAboutMe"
                }
              	var JSONstring = JSON.stringify(action);
			
			$.ajax({
				url: 'scripts/FigbookActionHandler/actionHandler.php',
				data: 'json='+JSONstring,
				dataType: 'json',
				success: function(data){
					if (data == true) {
						console.log("successfully updated");
						
					}
					else{
						alert("update failed. Try again");
					}
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});
			
			//Persisting changes to the database
				var profileArray = document.getElementsByClassName("contactInfo");
				var action =
                {
					"cell": profileArray[0].value,
					"home":profileArray[1].value,
					"work":profileArray[2].value,
					"email":profileArray[3].value,
                    "action" : "updateContactInfo"
                }
              	var JSONstring = JSON.stringify(action);
			
			$.ajax({
				url: 'scripts/FigbookActionHandler/actionHandler.php',
				data: 'json='+JSONstring,
				dataType: 'json',
				success: function(data){
					if (data == true) {
						console.log("successfully updated");
					
						//this function removes the loading,saving gif's with small 1s delay
						removeGif();				
					}
					else{
						alert("update failed. Try again");
					}
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});
			
		}); // END of profile edit button.
	
				
			
		

	
	$("#profileLink").click(function(){
		 var action =
                {
                    "action" : "viewprofile"
                }
              	var JSONstring = JSON.stringify(action);
			
			$.ajax({
				url: 'scripts/FigbookActionHandler/actionHandler.php',
				data: 'json='+JSONstring,
				dataType: 'json',
				success: function(data){
                    createProfile(data);
                    loadBookList(data.books);
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});
	});
	
	/**
	 *@description populates the profile tabs with info from the database
	 *@param {JSON} jsonObj json object with data from database
	 */
	function createProfile(jsonObj)
    {
		//Filling the Portfolio page
		var profileArray = document.getElementsByClassName("profileInfo");
		
		profileArray[0].value = jsonObj['user_name'];
		profileArray[1].value = jsonObj['first_name'];
		profileArray[2].value = jsonObj['last_name'];
		profileArray[3].value = jsonObj['genres_of_interest'];
		//Filling the About Me page
		profileArray = document.getElementsByClassName("aboutMeInfo");
		
		profileArray[0].value = jsonObj['about_me'];
		
		//filling the contact details page
		profileArray = document.getElementsByClassName("contactInfo");
		
		profileArray[0].value = jsonObj['cell'];
		profileArray[1].value = jsonObj['home'];
		profileArray[2].value = jsonObj['work'];
		profileArray[3].value = jsonObj['email'];
		$('#portImage').attr("src", "images/profilePictures/"+jsonObj.user_profile_picture);
    }
});
   
   function loadBookList(books)
   {
		var bookList = "";
		 for (var i=0; books[i] != null; i++)
		 {
				 books[i] = books[i].replace(/_/g, " ");
				 bookList += "<li>" + books[i] + "</li>";
		 }

		 document.getElementById("booklist").innerHTML = bookList;
   }
  
};

//Clicks the "send email" button on forgot password page when enter is pressed
$("#emailInput").keyup(function(event)
{
	 if(event.keyCode == 13)
	 {
			 $("#sendEmailBtn").click();
	 }
});

//Sends email to user with tokenised link
function verifyAndSendRecoveryLink()
{
	var jsonObj = {
		"action" : "forgotPassword",
		"email" : document.getElementById("emailInput").value
	}

	jsonObj = JSON.stringify(jsonObj);

	$.ajax({
		url: 'scripts/FigbookActionHandler/actionHandler.php',
		data: 'json='+jsonObj,
		dataType: 'json',
		success: function(data){
			if (data.message == "invalid email")
			{
				alert( JSON.parse(jsonObj).email + " doesn't have a Figbook account. Please try again.");
			}
			else
			{
				alert("Email sent successfully to " + JSON.parse(jsonObj).email);
			}
		},
		error: function(data){
			alert("error :"+JSON.stringify(data));
		}
	});
}

function updatePassword()
{
  var jsonObj = {
                "action" : "setNewPassword",
                "email" : document.getElementById("emailInput").value,
    "token" : document.getElementById("passwordToken").value,
    "password" : document.getElementById("newPass").value
    }

        jsonObj = JSON.stringify(jsonObj);

    $.ajax({
                url: 'scripts/FigbookActionHandler/actionHandler.php',
                data: 'json='+jsonObj,
                dataType: 'json',
                success: function(data){
                        if (data.message === "invalid token")
                        {
                                alert("Invalid Token. Check that you entered the complete token or request another");
                        }
                        else if (data.message === "expired token")
                        {
                                alert("Expired Token. Check that you entered the complete token or request another");
                        }
                        else if(data.message === "success")
                        {
          //TODO: use mediawiki api to set new password for user
                            alert("Successful, Please login with the new password");
                            window.location.href = "index.php";
                        }
                        else if(data.message === "failedToUpdatePassword"){
                            alert("Failed, Please contact systems administrator at sysadmin@figbooks.cloudapp.net");
                        }
                        else{
                            alert(data.message);
                            window.location.href = "index.php";
                        }
                },
                error: function(data){
                        alert("error :"+JSON.stringify(data));
                }
        });
}

