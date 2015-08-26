function saveConflict()
{
    
    //Getting info to pass to the ajax function
    var bookInfo = localStorage.bookInformation;
    
    var sectionHeading = bookInfo.sectionHeading;
    var sectionNumber = bookInfo.section;
    
    var content = $("#newContentTextArea").html();
    sectionNumber = parseInt(sectionNumber);
	   
    var timeStamp = localStorage.getItem("tStamp");
    console.log("Before saving: " + timeStamp);
	var jsonString = {
					"format" : "json",
					"action": "verifyTimeStamp",
					"title": localStorage.bookTitle,
					"section" : sectionNumber,
                    "timestamp" : timeStamp,
                    "newContent" : content,
                    "originalContent" : content
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
									//This will display the actual page again. with updated values
                                    location.href = "content.html";
									var inside = document.getElementsByClassName('insideText'); 
									var head = document.getElementsByClassName('sectionHeading'); 
									$('#editSection').fadeOut("slow",function(){//$(inside[(sectionNumber-1)]).html(content);	
										//$(head[(sectionNumber-1)]).html(sectionHeading);								
										$('#pageView').fadeIn("slow",function(){
											$( "#viewBooks" ).trigger( "click" );
											
												/*var loadPageInfo = 
												{
																"title": localStorage.bookTitle
												};
												get_page(loadPageInfo);*/
											 //alert(document.getElementsByClassName("bookItem").length);
											});
										});
								
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
                }//end of if result.message == no_conflict
                else if (result.message == "conflict")
                {
                    localStorage.conflictInfo = JSON.stringify(result);
                    localStorage.contentToAdd = result.mergedText;
                    location.href = "conflictResolution.html";
                }
            },
            error: function (data) { //TODO: The diff function causes this to return as an error, even though the merging works. Look into that
                var responseText = data.responseText;
                var customJsonObj = "";
                
                //retrieving the json string from the response text.
                for (var i = 0; i<responseText.length; i++)
                {
                    if (responseText[i] == '{') {
                        while (responseText[i] != '}')
                        {
                            customJsonObj += responseText[i];
                            i++;
                        }
                        customJsonObj += '}';
                        break;
                    }
                }
                customJsonObj = JSON.parse(customJsonObj); //turn it into a json object so we can use the variables.
                
                if (customJsonObj.message == "no_conflict")//No conflict occured so the text can be persisted to the database
                {
                    $.post("scripts/mediawiki/api.php?action=query&prop=info|revisions&meta=tokens&rvprop=timestamp&titles="+localStorage.bookTitle+"&format=json",function(data){	
                    
                    $.ajax({	
                            url: "scripts/mediawiki/api.php",
                            data: {
                                    format: 'json',
                                    action: 'edit',
                                    title: localStorage.bookTitle,
                                    section: sectionNumber,
                                    text:"="+sectionHeading+"= \n" + customJsonObj.mergedText,
                                    token: data.query.tokens.csrftoken
                                  },
                            dataType: 'json',
                            type: 'POST',
                            success: function (data)
                            {
                                if (data && data.edit && data.edit.result === 'Success')
                                {
                                    alert("Section saved successfully");
									//This will display the actual page again. with updated values
									var inside = document.getElementsByClassName('insideText'); 
									var head = document.getElementsByClassName('sectionHeading'); 
									$('#editSection').fadeOut("slow",function(){//$(inside[(sectionNumber-1)]).html(content);	
										//$(head[(sectionNumber-1)]).html(sectionHeading);								
										$('#pageView').fadeIn("slow",function(){
											$( "#viewBooks" ).trigger( "click" );
											
												/*var loadPageInfo = 
												{
																"title": localStorage.bookTitle
												};
												get_page(loadPageInfo);*/
											 //alert(document.getElementsByClassName("bookItem").length);
											});
										});
								
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
                }//end of no conflict
                else if (customJsonObj.message == "conflict") {
                    localStorage.conflictInfo = JSON.stringify(customJsonObj);
                    localStorage.contentToAdd = customJsonObj.mergedText;
                    location.href = "conflictResolution.html";
                }

            }
			});
}


window.onload = function() {
    $("#addBefore").click(function(){
        var newContent = $("#newPar").html();
        newContent += "\n" + $("#oldPar").html();
        
        $("#newContentTextArea").val(newContent);
    });
    
    $("#addAfter").click(function(){
        var newContent = $("#oldPar").html();
        newContent += "\n" + $("#newPar").html();
        
        $("#newContentTextArea").val(newContent);
    });
};
function resolveConflict()
{
    var conflictData = JSON.parse(localStorage.conflictInfo);
    var myChanges = "", yourChanges = "";
    var yourChanges = localStorage.contentToAdd.split(",=======,")[0];
    var myChanges = localStorage.contentToAdd.split(",=======,")[1];
    
    
    document.getElementById("userChanges").innerHTML += conflictData.last_edited_by;
    document.getElementById("newPar").innerHTML = yourChanges;
    document.getElementById("oldPar").innerHTML = myChanges;
}
