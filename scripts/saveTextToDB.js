function saveText()
{
    
    //Getting info to pass to the ajax function
   
    var sectionHeading = $("#pageEditTitle").val();
    var sectionNumber = $("#saveBtn").attr("name");
    var content = document.getElementById("editor").value;
    sectionNumber = parseInt(sectionNumber);
    
    var timeStamp = localStorage.getItem("tStamp");
    
	/*var jsonString = {
					format: "json",
					action: "verifyTimeStamp",
					title: localStorage.bookTitle,
					section: sectionNumber
				    };
	
    $.ajax({
				url: "scripts/FigbookActionHandler/actionHandler.php",
				data: "json="+jsonString,
				dataType: 'json',
				type: 'POST',
				success: function (data) {
                    
				},
				error: function (data) {
					console.log('Error: Request failed. ' + (data.responseText));
	
				}
			});
    */
			
	$.post("scripts/mediawiki/api.php?action=query&prop=info|revisions&meta=tokens&rvprop=timestamp&titles="+localStorage.bookTitle+"&format=json",function(data){	
    //if no conflict, send to api
		alert(data.query.tokens.csrftoken);
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
				success: function (data) {
				    if (data && data.edit && data.edit.result === 'Success') {
					alert("Successful");
				       alert(JSON.stringify(data));
				    } else if (data && data.error) {
					alert('Error: API returned error code "' + data.error.code + '": ' + data.error.info);
				    } else {
					alert('Error: Unknown result from API.');
				    }
				},
				error: function (data) {
				    console.log('Error: Request failed. ' + JSON.stringify(data));
				    $('#Page').append("<a href='/scripts/mediawiki/index.php/" + params.title + "'>Link to your book</a>");

				    event.preventDefault();
				   // get_page(params);
				}
			    });
	    
	    });	
}