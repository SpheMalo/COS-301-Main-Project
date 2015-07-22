function saveText()
{
    
    //Getting info to pass to the ajax function
   
    var sectionHeading = $("#pageEditTitle").val();
    var sectionNumber = $("#saveBtn").attr("name");
    var content = document.getElementById("editor").value;
    sectionNumber = parseInt(sectionNumber);
    
    var timeStamp = localStorage.getItem("tStamp");
    console.log("Before saving: " + timeStamp);
	var jsonString = {
					"format" : "json",
					"action": "verifyTimeStamp",
					"title": localStorage.bookTitle,
					"section" : sectionNumber,
                    "timestamp" : timeStamp,
                    "content" : content
				    }
                    
        jsonString = JSON.stringify(jsonString);
	/**
    *  This call checks the timestamp retrieved once editing began, and compares it to the timestamp in the database currently.
    *  If the timestamps match, it means there was no conflict and "true" is returned.
    *  If the timestamps don't match it means there is a conflict. "false" is returned
    */
    $.ajax({
            url: "scripts/FigbookActionHandler/actionHandler.php",
            data: "json="+jsonString,
            dataType: 'json',
            type: 'POST',
            success: function (result) {
                if (result.message == "no_conflict")//No conflict occured so the text can be persisted to the database
                {
                    
                    $.post("scripts/mediawiki/api.php?action=query&prop=info|revisions&meta=tokens&rvprop=timestamp&titles="+localStorage.bookTitle+"&format=json",function(data){	
                    
                    $.ajax({	
                            url: "scripts/mediawiki/api.php",
                            data: {
                                    format: 'json',
                                    action: 'edit',
                                    title: localStorage.bookTitle,
                                    section: sectionNumber,
                                    text:"="+sectionHeading+"= \n" + content,
                                    token: data.query.tokens.csrftoken
                                  },
                            dataType: 'json',
                            type: 'POST',
                            success: function (data)
                            {
                                if (data && data.edit && data.edit.result === 'Success')
                                {
                                    alert("Section saved successfully");
                                    console.log(JSON.stringify(data));
                                    localStorage.tStamp = result.date_last_edited;
                                    console.log("After saving: " + localStorage.tStamp);
                                }
                                else if (data && data.error)
                                {
                                    alert('Error: API returned error code "' + data.error.code + '": ' + data.error.info);
                                }
                                else
                                {
                                    alert('Error: Unknown result from API.');
                                }
                            },
                            error: function (data)
                            {
                                console.log('Error: Request failed. ' + JSON.stringify(data));
                                $('#Page').append("<a href='/scripts/mediawiki/index.php/" + params.title + "'>Link to your book</a>");
                            }
                        });//end of ajax to send save to server
                    }); //end of post to retrieve edit token
                }//end of if data == true
                else if (result.message == "conflict")
                {
                    localStorage.conflictInfo = JSON.stringify(result);
                    localStorage.contentToAdd = content;
                    location.href = "scripts/me.html";
                }
            },
            error: function (data) {
                console.log('Error: Request failed. ' + (data.responseText));

            }
			});	
}

$("#addBefore").live('click', function(){
    alert("Add Before");
});

$("#addAfter").live('click', function(){
    alert("Add After");
});
function resolveConflict()
{
    var conflictData = JSON.parse(localStorage.conflictInfo);
    
    document.getElementById("userChanges").innerHTML += conflictData.last_edited_by;
    document.getElementById("newPar").innerHTML = localStorage.contentToAdd;
    document.getElementById("oldPar").innerHTML = conflictData.section_content;
}