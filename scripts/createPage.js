function editSection(value)
{
	
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
	
	 
	$("#pageView").fadeOut("slow",function(){
		$('#editSection').fadeIn("slow",function(){});
	
	});
	
	
	var headings = document.getElementsByClassName("sectionHeading");
	var insideText = document.getElementsByClassName("insideText");
	var sectionDiv = document.getElementsByClassName("sectionDiv");
	var val = insideText[(value-1)].innerHTML;
	//var val = jQuery.extend(true, {}, insideText[(value-1)]);
		//alert(val.innerHTML);
		
		//the regex allows the replace to replace all occurrences..
		var find = '<br>';
		var re = new RegExp(find, 'g');
		val = val.replace(re,'\n');
		//alert(val); 
			
			
			

	
	$("#pageEditTitle").val(headings[(value-1)].getElementsByClassName("mw-headline")[0].innerHTML);
	$("#editor").html("");

	var page = document.getElementById("pageView").nextSibling;
		var links = page.childNodes;
		
		/*var num_links =1;
		for(var i=0; i<links.length; i++) {
			if(links[i].innerHTML === "edit")
			{
				links[i].setAttribute('href', "#");
				links[i].setAttribute('onclick', "editSection("+num_links+")");
				num_links++;
			}
		} */
	
	//alert(insideText[(value-1)].innerHTML + " "+value);
	
	
	
	
	
	//alert($("#"+section).nextUnitl().html());
	//$("#editor").html("");
	
	$("#editor").val(val);
	$("#saveBtn").attr("name","" + value);
	
	
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
		
    $(document).ready(function () {
		
		
		//Populates the list of books initially when page loads.
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
		
		$('#viewBooks').click(function(){
			$('#editSection').fadeOut("slow",function(){});
			$('#pageView').fadeOut("slow",function(){
					//$('#pageView').html("");
					
					$('#bookList').fadeIn("slow",function(){});
			});
			getBooks();
		});
		
		
		//This is the next button click event when creating a new manuscript.
		$('#next-button').click(function(){
			
			
			//Get the data from inputs
			info.title = $('#title').val();
			info.firstname = $('#firstname').val();
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
						//console.log(info.preface);
						
						//Todo call the create page function
						create_page(info);
						$('#inputs2').fadeOut("slow",function(){
								
							});
							$('#bookDiv').fadeOut("slow",function(){
								$('#infoBox').fadeIn("slow",function(){});
								$('#serviceBackground').fadeIn("slow",function(){});
								});
							
					}	
					else 
					{		
						$('#infoBox').fadeOut("slow",function(){
							//console.log(info.title+" "+info.firstname+" "+info.surname);
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
					event.preventDefault();
					
				}
				
			},
			error: function(data){
				console.log("error :"+data.responseText);
			}		
		});
	}
		
		
		//This is the test to see if the div was faded out... if value is null its faded...
		//Use it for the back button.
		$('#back-button').click(function(){
			event.preventDefault();
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
		function refreshBook()
		{
			var loadPageInfo = 
			{
							"title": localStorage.bookTitle
			};
			get_page(loadPageInfo);
		}
		
		function getBooks()
		{
			// clear this list before repopulating it
			$('#bookList').html("");
			
			$.post('scripts/mediawiki/api.php?action=query&list=allpages&aplimit=100&format=json',
                function (data) {
                    console.log(JSON.stringify(data));
					
                    var html = "";
                    //alert(JSON.stringify(data.query.allpages));
                    html += "Page List: <select placeholder='Select Page' id='pageSelect' >" +
                            "<option value='' disabled='disabled' selected='selected'>Page List</option>";
                    $.each(data.query.allpages, function (i, v) {
                        html += "<option value='" + data.query.allpages[i].title + "'>" + data.query.allpages[i].title + "</option>";				//alert("ishere");
						
						//This is where I load the book titles into block divs...
						$("#bookList").append("<div class='bookItem'>"+data.query.allpages[i].title+"</div>");
						
                    });
                    html += "< /select>";
                    //alert(html);
                    document.getElementById("pageList").innerHTML = html;
					
					 $('.bookItem').click(function(){
						//alert("book clicked : "+$(this).html());
						
						var loadPageInfo = {
							"title": $(this).html()
						};	
						//alert(loadPageInfo.title);
						localStorage.bookTitle = loadPageInfo.title;
						//alert(localStorage.bookTitle);
						//make sure it gets a title for a book to load
						if (loadPageInfo.title !== "")
						{
						 get_page(loadPageInfo);
						}
						
					});
                });
		}
		
		//call the function once on page load...
		
		 
		
		 
	
        //event.preventDefault();

        /*$('#pageList').on('change', 'select', function (event) {
            
            var selected = $(this).val();
            //alert(selected.val());
            var loadPageInfo = {
                "title": selected
            };
            get_page(loadPageInfo);
        });*/
        
       
       
		
        $("#load-button").click(function () {

            var loadPageInfo = {
                "title": document.getElementById("gettitle").value
            };
            get_page(loadPageInfo);
        });

        function create_page(params)
        {
            //alert("In here" + params.title);
            //alert(api.getEditToken());
            var stoken = "";
            $.post('scripts/mediawiki/api.php?action=tokens&type=edit&format=json',
                    function (data) {
                        stoken = data.tokens.edittoken;
                        //alert(stoken);
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
									localStorage.bookTitle = params.title;
									getBooks();//Repopulate list of books before loading page.
                                    //window.location.reload(); // reload page if edit was successful
                                    
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
                                //alert("Page: "+params.title+" created successfully");
                                //window.location.href = "/scripts/mediawiki/index.php/"+ params.title;

                                event.preventDefault();
                                get_page(params);
                            }
                        });
                    });
            event.preventDefault();
            
        }
        function get_page(params) {

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
            event.preventDefault();
        }


        

    });

