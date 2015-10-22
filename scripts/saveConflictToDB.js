function saveConflict()
{
    var bookDetails = JSON.parse(localStorage.bookDetails);//Contains details about the book

    //Getting info to pass to the ajax function
    var sectionHeading = bookDetails.sectionHeading;
    var sectionNumber = bookDetails.section;
    var content =   $("#newContentTextArea").html();
    sectionNumber = parseInt(sectionNumber);

    //Replace all occurences of Span in the content
    var find = "<span class=\"otherUser\">";
  	var re = new RegExp(find, 'g');
  	content = content.replace(re,"");

    find = "<span class=\"meUser\">";
  	re = new RegExp(find, 'g');
  	content = content.replace(re,"");

    find = "</span>";
    re = new RegExp(find, 'g');
  	content = content.replace(re,"");

    //alert(content);

    var timeStamp = localStorage.getItem("tStamp");
	  var jsonString = {
					"format" : "json",
					"action": "verifyTimeStamp",
					"title": bookDetails.title,
					"section" : sectionNumber,
          "timestamp" : bookDetails.timestamp,
          "newContent" : content,
          "originalContent" : bookDetails.originalContent
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
            success: function (result) {//alert(JSON.stringify(result));
                if (result.message == "no_conflict")//No conflict occured so the text can be persisted to the database
                {
                    $.post("scripts/mediawiki/api.php?action=query&prop=info|revisions&meta=tokens&rvprop=timestamp&titles="+localStorage.bookTitle+"&format=json",function(data)
                    {
                        $.ajax({
                            url: "scripts/mediawiki/api.php",
                            data: {
                                    format: 'json',
                                    action: 'edit',
                                    title: bookDetails.title,
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
                                    alert("Section saved successfully");
                                    location.href = "content.html";

                                    localStorage.originalContent = result.mergedText;
                                    localStorage.tStamp = result.date_last_edited;
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
                  alert("Merge conflict occurred, please resolve again.");
                  var newBookDetails = {
                          "sectionHeading": sectionHeading,
                          "title": bookDetails.title,
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
            error: function (data) {
                console.log('Error: Request failed. ' + (data.responseText));

            }
			});
}
