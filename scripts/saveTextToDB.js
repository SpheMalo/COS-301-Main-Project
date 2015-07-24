
function saveText()
{
    
    //Getting info to pass to the ajax function
   
    var sectionHeading = $("#pageEditTitle").val();
    var sectionNumber = $("#saveBtn").attr("name");
    var content = document.getElementById("editor").value;
    sectionNumber = parseInt(sectionNumber);
	
	//the regex allows the replace to replace all occurrences..
		/*var find = '\n';
		var re = new RegExp(find, 'g');
    content = content.replace(re,'<br/>');*/
	//alert(content);
	
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
                                    //localStorage.tStamp = result.date_last_edited;
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
                    location.href = "conflictResolution.html";
                }
            },
            error: function (data) {
                console.log('Error: Request failed. ' + (data.responseText));

            }
			});	
}

/*function get_page(params) {

            //console.log('got into get_page');

            var title_ = params.title;
            var replaced = title_.split(' ').join('_');
           // alert(replaced);
            $.ajax({
                url: "scripts/mediawiki/index.php/" + replaced,
                dataType: "html"
            }, 5000).success(function (data) {
                //alert(JSON.stringify(data));
                $('#bookList').fadeOut("slow",function(){
					$('#pageView').fadeIn("slow",function(){
							
						    document.getElementById('pageView').innerHTML = data;
							var div = document.getElementById('mw-content-text');
									var childNodes = div.childNodes;
									
							
								$("#scrollDiv").append($('#editSection').fadeOut("fast",function(){
									
									}));
						
							document.getElementById('pageView').innerHTML = "";
							//alert(childNodes.length);
								
								var htmlValue = "";
								var linkNumber = 1;
								for(var i=0; i<childNodes.length; i++)
								{	
									//console.log(childNodes[i].innerHTML);
									
									if (childNodes[i].innerHTML !== "" && typeof childNodes[i].innerHTML !== "undefined")
									{	
										
										if(childNodes[i].innerHTML.indexOf('mw-headline') !== -1 )
										{	
											//not if it is the first section
											if (linkNumber !== 1){
											$( "#pageView" ).append(htmlValue+"</div></div></div>");
											}
											// add section div
											htmlValue = "<div class='sectionDiv' onclick='editSection("+linkNumber+")'><div class='sectionHeading' >"+childNodes[i].innerHTML+"</div><div class='insideText'  >";
											linkNumber++;
										}
										else{
										htmlValue += childNodes[i].innerHTML;
										}
									}
								}
								$( "#pageView" ).append(htmlValue+"</div></div></div>");
								
							//$( "#pageView" ).append(childNodes);
							var headings = document.getElementsByClassName("mw-headline"); 
								console.log("headings: "+headings[0].innerHTML);
							
							
							var page = document.getElementById("pageView");
							console.log(page);
							var links = page.getElementsByClassName("mw-editsection");
							$(links).remove();
							var num_links =1;
							for(var i=0; i<links.length; i++) {
								if(links[i].innerHTML === "edit")
								{
									links[i].setAttribute('href', "#");
									
									num_links++;
								}
							}
							
							var paragraphs = page.getElementsByTagName("h1");
							var num_par = 1;
							for( i=0; i<paragraphs.length; i++) {
								paragraphs[i].setAttribute('id', num_par);
								num_par++;
							}
						
						});
					
				});
                
		    
        
		
		

		
		
                //$('#Page').append(data);
                //window.location.href = "/scripts/mediawiki/index.php/"+ params.title;

            }, 5000).error(function (data) {
                console.log(JSON.stringify(data));
                //window.location.href = "/scripts/mediawiki/index.php/"+ params.title;
            });
           // event.preventDefault();
        }*/


jQuery(window).load(function () {
//window.onload = function(){
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
});
//};
function resolveConflict()
{
    var conflictData = JSON.parse(localStorage.conflictInfo);
    
    document.getElementById("userChanges").innerHTML += conflictData.last_edited_by;
    document.getElementById("newPar").innerHTML = localStorage.contentToAdd;
    document.getElementById("oldPar").innerHTML = conflictData.section_content;
}
