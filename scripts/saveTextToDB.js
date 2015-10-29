
function saveText()
{
    addGif('Saving','loadingNew');
    //Getting info to pass to the ajax function
    var sectionHeading = $("#pageEditTitle").val();
    var sectionNumber = $("#saveBtn").attr("name");
    var iframe = $("iframe").contents();
    var content = iframe.find("body").html();
    sectionNumber = parseInt(sectionNumber);
	
    //alert("Before: "+content);
    //Escaping special characters
    content = escapeSpecial(content);
    localStorage.originalContent = escapeSpecial(localStorage.originalContent);
    
	
    var timeStamp = localStorage.getItem("tStamp");
    console.log("Before saving: " + timeStamp);
	var jsonString = {
					"format" : "json",
					"action": "verifyTimeStamp",
					"title": localStorage.bookTitle,
					"section" : sectionNumber,
                    "timestamp" : timeStamp,
                    "newContent" : content,
                    "originalContent" : localStorage.originalContent
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
                                    text:"="+sectionHeading+"= \n" + result.mergedText,
                                    token: data.query.tokens.csrftoken
                                  },
                            dataType: 'json',
                            type: 'POST',
                            success: function (data)
                            {
                                if (data && data.edit && data.edit.result === 'Success')
                                {
					//alert("After: "+JSON.stringify(data));
                                    removeGif();       
                                    alert("Section saved successfully");
									var inside = document.getElementsByClassName('insideText');
									var head = document.getElementsByClassName('sectionHeading');
                                    console.log(JSON.stringify(data));
                                    localStorage.originalContent = result.mergedText;
                                    localStorage.tStamp = result.date_last_edited;
                                    console.log("After saving: " + localStorage.tStamp);
                                }
                                else if (data && data.error)
                                {
                                    removeGif();
                                    alert('Error: API returned error code "' + data.error.code + '": ' + data.error.info);
                                }
                                else
                                {
                                    removeGif();
                                    alert('Error: Unknown result from API.');
                                }
                            },
                            error: function (data)
                            {
                                removeGif();
                                console.log('Error: Request failed. ' + JSON.stringify(data));
                                $('#Page').append("<a href='/scripts/mediawiki/index.php/" + params.title + "'>Link to your book</a>");
                            }
                        });//end of ajax to send save to server
                    }); //end of post to retrieve edit token
                }//end of if data == true
                else if (result.message == "conflict")
                {
                    removeGif(); 
                  alert("There was a merging conflict, you will be forwarded to a resolution page.");
                  var bookDetails = {
                          "sectionHeading": sectionHeading,
                          "title": localStorage.bookTitle,
                          "section" : sectionNumber,
                          "timestamp" : result.date_last_edited,
                          "originalContent" : result.section_content
                    }
                    localStorage.tStamp = result.date_last_edited;
                    localStorage.bookDetails = JSON.stringify(bookDetails);
                    localStorage.conflictInfo = JSON.stringify(result);
                    localStorage.contentToAdd = result.mergedText;
                    location.href = "conflictResolution.html";
                }
            },
            error: function (data) {alert(JSON.stringify(data));
                    removeGif();
                console.log('Error: Request failed. ' + (data.responseText));

            }
			});
            removeGif(); 
}

function escapeSpecial(text)
{
    var find = "\"";
  	var re = new RegExp(find, 'g');
  	text = text.replace(re,"<dQt>");
    
    var find = "'";
  	var re = new RegExp(find, 'g');
  	text = text.replace(re,"<sQt>");
    
    var find = "&nbsp;";
  	var re = new RegExp(find, 'g');
  	text = text.replace(re,"<nBl>");
    
    var find = "&lt;";
  	var re = new RegExp(find, 'g');
  	text = text.replace(re,"<LesThn>");
    
    var find = "&gt;";
  	var re = new RegExp(find, 'g');
  	text = text.replace(re,"<GreThn>");
    
    return text;
}

window.onload = function() {
    
    
//window.onload = function(){
    $("#addBefore").click(function(){
        var newContent = $("#newPar").html();
        newContent += "\n" + $("#oldPar").html();

        $("#newContentTextArea").val(newContent);
    });

    $("#addAfter").click(function(){
        var newContent = $("#oldPar").html();
        newContent += "\n" + $("#newPar").html();
        $("#newContentTextArea").html(newContent);
        //$("#newContentTextArea").val(newContent);
    });
};
//};
function resolveConflict()
{
    var conflictData = JSON.parse(localStorage.conflictInfo);
    var escapeTemp = conflictData.mergedText;
    
    alert(escapeTemp);
    var find = "<dQt>";
    var re = new RegExp(find, 'g');
    escapeTemp = escapeTemp.replace(re,"\"");
    
    var find = "<sQt>";
    var re = new RegExp(find, 'g');
    escapeTemp = escapeTemp.replace(re,"'");
    
    var find = "<nBl>";
    var re = new RegExp(find, 'g');
    escapeTemp = escapeTemp.replace(re,"&nbsp;");
    
    var find = "<LesThn>";
    var re = new RegExp(find, 'g');
    escapeTemp = escapeTemp.replace(re,"<");
    
    var find = "<GreThn>";
    var re = new RegExp(find, 'g');
    escapeTemp = escapeTemp.replace(re,">");
    alert(escapeTemp);
    var contentToParse = escapeTemp;
    var find = "<<<<<<<";
  	var re = new RegExp(find, 'g');
  	contentToParse = contentToParse.replace(re,"<span class='otherUser'>");

    find = "=======";
  	re = new RegExp(find, 'g');
  	contentToParse = contentToParse.replace(re,"</span><span class='meUser'>");

    find = ">>>>>>>";
    re = new RegExp(find, 'g');
  	contentToParse = contentToParse.replace(re,"</span>");

    
    $("#newContentTextArea").html(contentToParse);
    document.getElementById("last_edited_by").innerHTML = conflictData.last_edited_by;
}

//Adding lightbox effects
	

function addGif(statement,name)
{
	var obj = '<div id="loadingDiv" style="position:relative;width:220px;height:30px;">'
            +'<div style="height:30px;font-size:20px;font-weight:500;line-height:30px;float:left;color:white;">'+statement+'</div> '
            +'<img src="FeedBackIcons/'+name+'.gif" alt="Feedback Icon" '
            +'style="width:50px;height:30px;">'
            +'</div>';
		
		//var top = (window.innerHeight-30)/2;
		
		addLightbox(obj);
	
			
		var left = ($('#lightbox').width()-220)/2;
	
		$("#loadingDiv").css('left',left);
		$("#loadingDiv").css('top','200px');
}
function removeGif()
{
	$("#loadingDiv").fadeOut(600, function(){
		$(this).remove();
		closeLightbox();
	});
}


