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
				
				//To do: Some save function will be called to persist the changes to database.
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
				
				//To do: Some save function will be called to persist the changes to database.
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
				
				//To do: Some save function will be called to persist the changes to database.
			}
			
			
		});
	
	
});

};
