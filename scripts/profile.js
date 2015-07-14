window.onload = function(){
	
$(document).ready(function() {
	
	
	//This is the edit and save button for the users profile/portfolio.
	//It has two states: Save and Edit.
	
	$("#profileEditButton").click(function(){
			
			//This click starts the editing state.
			if ($(".profileInfo").attr("readonly"))
			{
				//The input boxes are now editable.
				this.innerHTML = "Save Details";
				$(".profileInfo").attr("readonly", false);
				
			}
			//This click starts the Saving state.
			else
			{
				//The input boxes are now uneditable.
				this.innerHTML = "Edit Details";
				//document.getElementById("profileEditButton").innnerHTML="Edit account";
				$(".profileInfo").attr("readonly", true);
				
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
						alert("successfully updated");
						
					}
					else{
						alert("update failed. Try again");
					}
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});
			}
			
			
		});
	
	
		//This is the edit and save button for the users profile/about me.
	//It has two states: Save and Edit.
	$("#editAboutMe").click(function(){
			
			//This click starts the editing state.
			if ($(".aboutMeInfo").attr("readonly"))
			{
				//The input boxes are now editable.
				this.innerHTML = "Save Details";
				$(".aboutMeInfo").attr("readonly", false);
				
			}
			//This click starts the Saving state.
			else
			{
				//The input boxes are now uneditable.
				this.innerHTML = "Edit Details";
				
				$(".aboutMeInfo").attr("readonly", true);
				
				//Persist changes to the database
				var aboutArray = document.getElementsByClassName("aboutMeInfo");
				var action =
                {
					"aboutme": aboutArray[0].value,
					"addInfo":aboutArray[1].value,
                    "action" : "updateAboutMe"
                }
              	var JSONstring = JSON.stringify(action);
			
			$.ajax({
				url: 'scripts/FigbookActionHandler/actionHandler.php',
				data: 'json='+JSONstring,
				dataType: 'json',
				success: function(data){
					if (data == true) {
						alert("successfully updated");
						
					}
					else{
						alert("update failed. Try again");
					}
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});
			}
			
			
		});
		
	//This is the edit and save button for the users profile/Contact info.
	//It has two states: Save and Edit.
	$("#editContactInfo").click(function(){
			
			//This click starts the editing state.
			if ($(".contactInfo").attr("readonly"))
			{
				//The input boxes are now editable.
				this.innerHTML = "Save Details";
				$(".contactInfo").attr("readonly", false);
				
			}
			//This click starts the Saving state.
			else
			{
				//The input boxes are now uneditable.
				this.innerHTML = "Edit Details";
				
				$(".contactInfo").attr("readonly", true);
				
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
						alert("successfully updated");
						
					}
					else{
						alert("update failed. Try again");
					}
				},
				error: function(data){
					alert("error :"+data.responseText);
				}		
			});
			}
			
			
		});
	
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
		
    }
});

};
