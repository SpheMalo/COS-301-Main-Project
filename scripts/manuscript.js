
/**
 * Populates relevant text for edit 
 * @param {Number} value
 */

 


function loadBook()
{
	$("#pageView").fadeOut("slow",function(){
		$('#editSection').fadeIn("slow",function(){});
	
	});

	var headings = document.getElementsByClassName("sectionHeading");
	var insideText = document.getElementsByClassName("insideText");
	var sectionDiv = document.getElementsByClassName("sectionDiv");

	var val = [];
	var iframe = $("iframe").contents();
	var text = "";

	for (var i = 0; i < sectionDiv.length; i++) {
		val[i] = insideText[i].innerHTML;
		var find = '<br>';
		var re = new RegExp(find, 'g');
		val[i] = val[i].replace(re,'\n');
		text += "<h1 style='text-align: center;''>"+headings[i].innerHTML+"</h1>";
		text += val[i];
	};

	$("#pageEditTitle").val(localStorage.bookTitle);
	
	iframe = iframe.find("body").html(text);

}

function readCookie(name) {
		        var nameEQ = name + "=";
		        var ca = document.cookie.split(';');
		        for (var i = 0; i < ca.length; i++) {
		            var c = ca[i];
		            while (c.charAt(0) == ' ')
		                c = c.substring(1, c.length);
		            if (c.indexOf(nameEQ) == 0)
		                return c.substring(nameEQ.length, c.length);
		        }
            return null;
        }

function commentDropDown(page){
	var comment = {
		"page_name" : "",
		"user_name" : ""
	}
	comment.user_name = readCookie('username');
	comment.page_name = page;
	//alert(comment.user_name);
	//alert("called");
	//alert("commentDropDown");

	var JSONstring = JSON.stringify(comment);
	$.ajax({
		url: "scripts/FigbookActionHandler/commentDropDown.php",
		data: 'json=' + JSONstring,
		dataType: 'json',
		success: function (data){
			//alert(JSON.stringify(data));
			var sel = document.getElementById("chapterSelect");
			if(sel.length == 1){
				//alert("here");
				var i = 1;
				for(; i <= data; i+=1){
					var opt = document.createElement("option");
					opt.setAttribute("value", i);
					opt.innerHTML = i;
					sel.appendChild(opt);
				}
			}
			else{
				//alert("not here");
			}
		}
		, error: function (data){
			//alert(JSON.stringify(data));
			//alert("NOT");
		}
	});
}

function postComment(){
	var comment = {
	            "commentText": "",
	            "page_name": "",
	            "section_number":"",
	            "user_name" : readCookie('username')
	        }

	        comment.commentText = document.getElementById("commentText").value;
	        comment.page_name = localStorage.bookTitle;
	        comment.section_number = document.getElementById("chapterSelect").value;
	       // alert(comment.user_name);

	        //alert(comment.commentText);
	       // alert(comment.page_name);
	        var JSONstring = JSON.stringify(comment);
	        $.ajax({
	            url: 'scripts/FigbookActionHandler/postComment.php',
	            data: 'json=' + JSONstring,
	            dataType: 'json',
	            success: function (data)
	            {
	                //alert(JSON.stringify(data));
	            }
	            , error: function (data) {
	                //alert(JSON.stringify(data));
	            }
	        });
}

function populateComment(){
	var comment = {
	            "section_number":"",
	            "page_name": ""
	}

	//comment.user_name = readCookie('username');
	comment.page_name = localStorage.bookTitle;
	comment.section_number = document.getElementById("chapterSelect").value;

	var JSONstring = JSON.stringify(comment);

	$.ajax({
	            url: 'scripts/FigbookActionHandler/populateComments.php',
	            data: 'json=' + JSONstring,
	            dataType: 'json',
	            success: function (data)
	            {
	            	//alert(data);

	                document.getElementById("commentText").value = data.responseText;
	            }
	            , error: function (data) {
	                //alert(JSON.stringify(data));
	                document.getElementById("commentText").value = data.responseText;
	            }
    });
}


function link()
{
	
    //var e = document.getElementById("user_id").value;
    var strUser = $("#link_user_id").val();
    //alert(strUser);
    var d = document.getElementById("access");
    var access = d.options[d.selectedIndex].value;

    var jsonString = {
        "action": "link",
        "title": localStorage.bookTitle,
        "user_id": strUser,
        "access": access
    };
    jsonString = JSON.stringify(jsonString);                

    $.ajax({
        url: "scripts/FigbookActionHandler/actionHandler.php",
        data: "json="+jsonString,
        dataType: 'json',
        type: 'POST',
        success: function (data) {
            var jsonString = JSON.stringify(data);  
            alert(jsonString);
			closeLightbox();
        },
        error: function (data) {
            console.log('Error1: Request failed. ' + (data.responseText));
        }
    });
}


function sendManuscript()
{
    var jsonString = {
        "action": "getUsers",
    };
    jsonString = JSON.stringify(jsonString);                
    

    $.ajax({
        url: "scripts/FigbookActionHandler/actionHandler.php",
        data: "json="+jsonString,
        dataType: 'json',
        type: 'POST',
        success: function (data) {

            var html = "";

            var i = 0;
            var textnode2 = document.getElementById("users");
            while(i <data.length)
            {
                var op = new Option();
                op.value = data[i].user_id;
                op.text = data[i].user_name;
                textnode2.options.add(op); 
                i++;
            }
        },
        error: function (data) {
            var jsonString = JSON.stringify(data);  
            alert(jsonString);
            console.log('Error2: Request failed. ' + jsonString + (data.responseText));
        }
    });
}


/*
function postComment(){
	var comment = {
	            "commentText": "",
	            "page_name": "",
	            "section_number":""

	        }
	        	alert("Its here");
	        comment.commentText = document.getElementById("commentText").value;
	        comment.page_name = localStorage.bookTitle;
	        //comment.page_name = "Comment_Test";
	        comment.section_number = 1;

	        alert(comment.commentText);
	        alert(comment.page_name);
	        var JSONstring = JSON.stringify(comment);
	        $.ajax({
	            url: 'scripts/FigbookActionHandler/postComment.php',
	            data: 'json=' + JSONstring,
	            dataType: 'json',
	            success: function (data)
	            {
	                alert(JSON.stringify(data));
	            }
	            , error: function (data) {
	                alert(JSON.stringify(data));
	            }
	        });
}
*/
function editSection(value)
{
    //alert(localStorage.userRole);
    if(localStorage.userRole === "Creator" || localStorage.userRole === "WRITE"){
	var jsonString = {
		"format": "json",
		"action": "getTimeStamp",
		"title": localStorage.bookTitle,
		"section": value
	};
	jsonString = JSON.stringify(jsonString);				
	
	$.ajax({
		url: "scripts/FigbookActionHandler/actionHandler.php",
		data: "json="+jsonString,
		dataType: 'json',
		type: 'POST',
		success: function (data) {
			localStorage.setItem("tStamp", data.date_last_edited);
		},
		error: function (data) {
			console.log('Error: Request failed. ' + (data.responseText));
		}
	});
	
	 
	$("#pageView").fadeOut("fast",function(){
		$('#editSection').fadeIn("slow",function(){});
	
	});
	
                    var headings = document.getElementsByClassName("sectionHeading");
	var insideText = document.getElementsByClassName("insideText");
	var sectionDiv = document.getElementsByClassName("sectionDiv");
	var val = insideText[(value-1)].innerHTML;
	
	//the regex allows the replace to replace all occurrences..
	var find = '<br>';
	var re = new RegExp(find, 'g');
	val = val.replace(re,'\n');

	$("#pageEditTitle").val(headings[(value-1)].getElementsByClassName("mw-headline")[0].innerHTML);
	var iframe = $("iframe").contents();
	iframe = iframe.find("body").html(val);
	var page = document.getElementById("pageView").nextSibling;
	var links = page.childNodes;
	$(".cke_editable").html(val);
	$("#saveBtn").attr("name","" + value);
	localStorage.originalContent = val;
    }
    else{
        alert("You can only read this book");
    }
}

function delete_page(){
            var book_title = $("#delete_book_title").val();
            book_title = book_title.split('_').join(' ');
            //alert(book_title);
            var stoken = "";
            $.post('scripts/mediawiki/api.php?action=query&meta=tokens&type=csrf&format=json',
                    function (data) {
                        stoken = data.query.tokens.csrftoken;
                        console.log(stoken);
                        $.ajax({
                            url: "scripts/mediawiki/api.php",
                            data: {
                                format: 'json',
                                action: 'delete',
                                title: book_title,
                                token: stoken
                            },
                            dataType: 'json',
                            type: 'POST',
                            success: function (data) {
                                if (data && data.delete ) {
                                    //alert("Successful");
                                    $('#DelBookDiv').append("<br>"+ book_title + " Deleted");
                                    cleanDelete(book_title);
                                    setTimeout(function(){
                                        window.location.reload()
                                    }, 1000);
                                    //$.wait(2000).then(window.location.reload());
                                } else if (data && data.error) {
                                    alert('Error: API returned error code "' + data.error.code + '": ' + data.error.info);
                                } else {
                                    alert('Error: Unknown result from API.');
                                }
                            },
                            error: function (data) {
                                console.log('Error: Request failed. ' + JSON.stringify(data));
                               
                            }
                        });
                    });
            event.preventDefault();
        }
function cleanDelete(bookTitle) {
	        var replaced = bookTitle.split(' ').join('_');
	        var UserInfo = {
	            "action": "clean_delete",
	            "bookTitle": replaced
	        }
	        var JSONstring = JSON.stringify(UserInfo);
	        $.ajax({
	            url: 'scripts/FigbookActionHandler/actionHandler.php',
	            data: 'json=' + JSONstring,
	            dataType: 'json',
	            success: function (data)
	            {
	                //alert(JSON.stringify(data));
	            }
	            , error: function (data) {
	                //alert(JSON.stringify(data));
	            }
	        });
	        event.preventDefault();
	    }
$(document).ready(function () {
    $("#delBtn").click(function(){
        $.post("scripts/mediawiki/api.php?action=query&prop=info|revisions&meta=tokens&rvprop=timestamp&titles="+localStorage.bookTitle+"&format=json",function(data){	
    
    $.ajax({	
            url: "scripts/mediawiki/api.php",
            data: {
                    format: 'json',
                    action: 'edit',
                    title: localStorage.bookTitle,
                    section:$("#saveBtn").attr("name"),
                    text: "",
                    token: data.query.tokens.csrftoken
                  },
            dataType: 'json',
            type: 'POST',

            success: function (data)
            {

                if (data && data.edit && data.edit.result === 'Success')
                {
                    alert("Section deleted successfully");
					closeLightbox();
                                        refreshBook();
					//This will display the actual page again. with updated values
					
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
	//document.getElementById("editSection").remove();
        
    });
	$("#addSectionButton").click(function(){
  
	/**
    *  This call checks the timestamp retrieved once editing began, and compares it to the timestamp in the database currently.
    *  If the timestamps match, it means there was no conflict and "true" is returned.
    *  If the timestamps don't match it means there is a conflict. "false" is returned
    */
    $.post("scripts/mediawiki/api.php?action=query&prop=info|revisions&meta=tokens&rvprop=timestamp&titles="+localStorage.bookTitle+"&format=json",function(data){	
    
    $.ajax({	
            url: "scripts/mediawiki/api.php",
            data: {
                    format: 'json',
                    action: 'edit',
                    title: localStorage.bookTitle,
                    section: 'new',
                    text: "="+ document.getElementById('sectionName').value + "=",
                    token: data.query.tokens.csrftoken
                  },
            dataType: 'json',
            type: 'POST',
            success: function (data)
            {

                if (data && data.edit && data.edit.result === 'Success')
                {
                    //alert("Section saved successfully");
                    $('#addChapterArea').append("<br><p id='successMess'>Section saved successfully</p>");
                    setTimeout(function(){
                                    if (document.getElementById("successMess") !== null) {
                                    var element = document.getElementById("successMess");
                                    element.outerHTML = "";
                                    delete element;
                                    }
                                        closeLightbox();
                                        refreshBook();
                                        
                                    }, 1000);
					
					//This will display the actual page again. with updated values
					
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
});
        $("#messageArea").load("chat.php",function(){//this is where the chat client is loaded into the site.
				$(".chatName").val(readCookie("username"));
			});
			
        var jSonInfo = { action:"getUsersFuzzy"
                };
                var JSONstring = JSON.stringify(jSonInfo);
                        
                $('#fuzzyText').autocomplete( {
                    source: "scripts/FigbookActionHandler/actionHandler.php?json="+JSONstring,
                    //source: "fuzzytest.php",
                minLength: 2,
                appentTo: "#user_id",

                change: function( event, ui ) {
                        if ( !ui.item ) {

                              $("#fuzzyText" ).val($("#link_user_name").val());
                        }
                  },


                select: function( event, ui ) {
                    //alert(JSON.stringify(ui));
                    $("#fuzzyText" ).val( ui.item.label );
                    $("#link_user_id").val(ui.item.id);
                    $("#link_user_name").val(ui.item.label);

                }
                    
                });

                     //delete book selection. autocomplete
                jSonInfo = { action:"getBooksFuzzy"
                };
                JSONstring = JSON.stringify(jSonInfo);
                        
                $('#fuzzyText_deleteTitle').autocomplete( {
                    source: "scripts/FigbookActionHandler/actionHandler.php?json="+JSONstring,
                    //source: "fuzzytest.php",
                minLength: 0,
                appentTo: "#delete_book_id",

                change: function( event, ui ) {
                        if ( !ui.item ) {

                              $("#fuzzyText_deleteTitle" ).val($("#delete_book_title").val());
                        }
                  },


                select: function( event, ui ) {
                    //alert(JSON.stringify(ui));
                    $("#fuzzyText_deleteTitle" ).val( ui.item.label );
                    $("#delete_book_id").val(ui.item.id);
                    $("#delete_book_title").val(ui.item.label);

                }
                    
                });
	//Populates the list of books initially when page loads.		
	getBooks(); 
		
	//data for Creating a manuscript:
	var info = 
		{ 
			title:"",
			firstname:"",
			surname:"",
			preface:"",
			action:"edit",
			section:"0",
			text:""
	};
	
	
	///Loading/opening the editorial letter panel.
	$("#writeEditorial").click(function(){
		$( "#letterHide" ).trigger( "click" );
		
			//hides the options menu
			$('.optionsSlide').removeClass('pullDown');
			$('.optionsSlide').css('visibility','hidden');
			//hides the options menu
		
		
			//alert($('#serviceBackground').css('margin-left'));
		if($('#serviceBackground').css('margin-left') != '20px'){
			$("#serviceBackground").animate({
				marginLeft: '20'
			},500)
			
			$('#editorialLetter').css('display','block');
			$('#letterHide').css('display','block');
			
		}
           //$('#serviceBackground').slideToggle(500)         
                   
	});
	
	
		
	$('#viewBooks').click(function(){
		
		//Make the comment area dissapear
		$("#commentSide").css('display','none');
		$("#commentHide").css('display','none');
		//Make the editorial letter dissappear
		
		$('#editorialLetter').css('display','none');
		$('#letterHide').css('display','none');
		
		//hides the options menu
			$('.optionsSlide').removeClass('pullDown');
			$('.optionsSlide').css('visibility','hidden');
		//hides the options menu
		
		$('#editSection').fadeOut("slow",function(){
				$('#pageView').fadeOut("slow",function(){
					$('#bookList').fadeIn("slow",function(){});
				});
			});
		
		getBooks();
	});
		
		
	//This is the next button click event when creating a new manuscript.
	$('#next-button').click(function(){
		//Get the data from inputs
		info.title = $('#title').val();
		info.firstname = readCookie('username');
		info.surname = $('#surname').val();
		
		var UserInfo = {
			"action" : "checkTitle",
			"title" : info.title
		}
		
		var JSONstring = JSON.stringify(UserInfo);
		ajaxFunction(JSONstring);
		event.preventDefault();
		
		
	});
		
	function ajaxFunction(JSONstring){
		
		$.ajax({
			url: 'scripts/FigbookActionHandler/actionHandler.php',
			data: 'json='+JSONstring,
			dataType: 'json',
			success: function(data)
			{
				
				if(data == "false"){
					if (document.getElementById('error_par') != null)
					{
						document.getElementById('error_par').innerHTML = "";
					}
					if ($('#infoBox').css('display') === "none") //this is when the book gets created...
					{
						info.preface = "=Preface= \n"+$('#preface').val();
						info.text = info.preface;
						$('#preface').val("");
						//Todo call the create page function
						create_page(info);
						$('#inputs2').fadeOut("slow",function(){});
						$('#bookDiv').fadeOut("slow",function(){
							$('#infoBox').fadeIn("slow",function(){});
							$('#serviceBackground').fadeIn("slow",function(){});
						});
					}	
					else 
					{						
						$('#infoBox').fadeOut("slow",function(){
							$('#scriptMenuBar').html("Please Write a short preface.");
							$('#inputs2').fadeIn("slow",function(){});
						});
					}
				}
				else if(data == "true"){
					
					var form = document.getElementById("contentDiv");
					var incorrectVal = document.createElement('p');
					incorrectVal.id = "error_par";
					incorrectVal.innerHTML = "Title exist: Choose a different title";
					incorrectVal.style.color = "#F95050";
					incorrectVal.style.fontSize ="18pt";
					form.appendChild(incorrectVal);
					
					var title = document.getElementById("title");
					title.value = '';
					
					title.style.backgroundColor = "#F95050";
					
					title.onfocus = function (){title.style.backgroundColor = "white";};
					title.onblur = function (){title.style.backgroundColor = "#ABD1BC";};
					//event.preventDefault();
					
				}
			},
			error: function(data){
				alert(data.responseText);
				console.log("error :"+data.responseText);
			}		
		});
	}
	
	//This is the test to see if the div was faded out... if value is null its faded...
	//Use it for the back button.
	$('#back-button').click(function(){
		//event.preventDefault();
		if ($('#infoBox').css('display') === "none")
		{
			$('#scriptMenuBar').html("Please fill in author details.");
			$('#inputs2').fadeOut("slow",function(){
				$('#infoBox').fadeIn("slow",function(){});
			});
		}
		else
		{
			$('#bookDiv').fadeOut("slow",function(){
				$('#serviceBackground').fadeIn("slow",function(){});
			});
		}
	});
		
	//this is a function that finds all the books that exist
	//needs to be refined to only find books by that user
        $('#backToBook').click(function(){
            //$('#editSection').fadeOut("fast",function(){});
		refreshBook();
	});
	function refreshBook(){
		var loadPageInfo = 
		{
			"title": localStorage.bookTitle
		};
                $('#editSection').fadeOut("fast",function(){});
		get_page(loadPageInfo);
	}
		
	function getBooks(){
		// clear this list before repopulating it
                localStorage.userRole = "";
                localStorage.reload = "yes";
		$('#bookList').html("");
			
		$.post('scripts/mediawiki/api.php?action=query&list=allpages&aplimit=100&format=json',
		function (data) {
			console.log(JSON.stringify(data));
			
			var html = "";
			html += "Page List: <select placeholder='Select Page' id='pageSelect' >" +
				"<option value='' disabled='disabled' selected='selected'>Page List</option>";
			
			$.each(data.query.allpages, function (i, v) {
				html += "<option value='" + data.query.allpages[i].title + "'>" + data.query.allpages[i].title + "</option>";				//alert("ishere");
						
					var pageTitle = data.query.allpages[i].title;
	                        var replaced = pageTitle.split(' ').join('_');
	                        var loadPageInfo = {
	                            "action": "checkPagePermissions",
	                            "bookTitle": replaced
	                        };
	
	                        var JSONstring = JSON.stringify(loadPageInfo);
	                        $.post('scripts/FigbookActionHandler/actionHandler.php?json=' + JSONstring, function (data)
	                        {
	                            // console.log(JSON.stringify(data));
	                            if (data === "\"success\"") {
	                                html += "<option value='" + pageTitle + "'>" + pageTitle + "</option>";
	                               
	                                //div.off('click');
	                                //div.onclick=onClickBook(pageTitle, div);
	
	                                $("#bookList").append("<div class='bookItem'>"+pageTitle+"</div>");
                                        localStorage.bookTitle = "";
                                        
	                                $('.bookItem').click(function () {
	                                    //alert("book clicked : "+$(this).html());
										
										
										
	                                    var loadPageInfo = {
	                                        "title": $(this).html()
	                                    };
	                                    //alert(loadPageInfo.title);
	                                    localStorage.bookTitle = loadPageInfo.title;
	                                    var Inf = {
                                                "action": "getUserRole",
                                                "bookTitle": localStorage.bookTitle
                                            };
                                            var JSONstring = JSON.stringify(Inf);
                                            $.ajax({
                                                        url: 'scripts/FigbookActionHandler/actionHandler.php',
                                                        data: 'json=' + JSONstring,
                                                        dataType: 'json',
                                                        success: function (data1)
                                                        {
                                                            //alert(JSON.stringify(data1));
                                                            localStorage.userRole = data1;
															
                                                        }
                                                        , error: function (data1) {
                                                            //alert(JSON.stringify(data1));
                                                        }
                                                    });
                                                    //event.preventDefault();
	                                    //make sure it gets a title for a book to load
	                                    if (loadPageInfo.title !== "")
	                                    {
	                                        get_page(loadPageInfo);
															
	                                    }
	
	                                });
	                            }
	                            else {
	                                //localStorage.permission = "false";
	                            }
	                        });
			});
			html += "< /select>";
			
			document.getElementById("pageList").innerHTML = html;
			 
        });
	}
		
    $("#load-button").click(function () {

        var loadPageInfo = {
            "title": document.getElementById("gettitle").value
        };
        get_page(loadPageInfo);
    });

    function create_page(params){
        var stoken = "";
        $.post('scripts/mediawiki/api.php?action=tokens&type=edit&format=json',
        	function (data) {
        		stoken = data.tokens.edittoken;
                $.ajax({
                    url: "scripts/mediawiki/api.php",
                    data: {
                        format: 'json',
                        action: params.action,
                        title: params.title,
                        section: params.section,
                        text: params.text,
                        token: stoken
                    },
                    dataType: 'json',
                    type: 'POST',
                    success: function (data) {
                        if (data && data.edit && data.edit.result === 'Success') {
                            alert("Successfully created: "+params.title);
							
                                                        lockBook(params.title);
							getBooks();//Repopulate list of books before loading page
                                                        localStorage.userRole = "Creator";
                                                        localStorage.bookTitle = params.title;
                            get_page(params);
                        } else if (data && data.error) {
                            alert('Error: API returned error code "' + data.error.code + '": ' + data.error.info);
                        } else {
                            alert('Error: Unknown result from API.');
                        }
                    },
                    error: function (data) {
                        console.log('Error: Request failed. ' + JSON.stringify(data));
                        $('#Page').append("<a href='/scripts/mediawiki/index.php/" + params.title + "'>Link to your book</a>");

                       // event.preventDefault();
                        get_page(params);
                    }
                });
            }
        );
        //event.preventDefault();
    }
    function lockBook(bookTitle) {
	        var replaced = bookTitle.split(' ').join('_');
	        var UserInfo = {
	            "action": "lockBook",
	            "bookTitle": replaced
	        }
	        var JSONstring = JSON.stringify(UserInfo);
	        $.ajax({
	            url: 'scripts/FigbookActionHandler/actionHandler.php',
	            data: 'json=' + JSONstring,
	            dataType: 'json',
	            success: function (data)
	            {
	                //alert(JSON.stringify(data));
	            }
	            , error: function (data) {
	                //alert(JSON.stringify(data));
	            }
	        });
	        event.preventDefault();
	    }
    function get_page(params) {
        var title_ = params.title;
        var replaced = title_.split(' ').join('_');
        $.ajax({
            url: "scripts/mediawiki/index.php/" + replaced,
            dataType: "html"
        }, 5000).success(function (data) {

			//Takes you to the page content where reading and editing is done.
			//window.location.href = "content.html";

            $('#bookList').fadeOut("slow",function(){
				$('#pageView').fadeIn("slow",function(){
				  	document.getElementById('pageView').innerHTML = data;
				   	var div = document.getElementById('mw-content-text');
					var childNodes = div.childNodes;

					//$("#scrollDiv").append($('#editSection').fadeOut("fast",function(){
					//}));

					document.getElementById('pageView').innerHTML = "";
                                        $( "#pageView" ).append("<div id='bookTitleDiv'><span id='bookTitle'>"+title_+"</span></div>")
					var htmlValue = "";
					var linkNumber = 1;
					for(var i=0; i<childNodes.length; i++)
					{
						if (childNodes[i].innerHTML !== "" && typeof childNodes[i].innerHTML !== "undefined")
						{
							//alert(childNodes[i])
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
							htmlValue += "<p>"+childNodes[i].innerHTML+"</p>";
							}
						}
					}

					$( "#pageView" ).append(htmlValue+"</div></div></div>");
					var headings = document.getElementsByClassName("mw-headline");
					console.log("headings: "+headings[0].innerHTML); //?

					var page = document.getElementById("pageView");
					console.log(page);//?
					var links = page.getElementsByClassName("mw-editsection");
					$(links).remove();

					//Make the comment area visible
					$("#commentSide").css('display','block');
					$("#commentHide").css('display','block');

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
					
					//Populating comment dropdown and  comments for each chapter.
					commentDropDown(localStorage.bookTitle);
				});
			});

        }, 5000).error(function (data) {
            console.log(JSON.stringify(data));
            //window.location.href = "/scripts/mediawiki/index.php/"+ params.title;
        });
        //event.preventDefault();
    }
});


