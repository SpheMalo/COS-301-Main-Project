function editSection(value)
{
//	var editTimeStamp;
//	var title = $("#pageSelect :selected").html();
//	var content = document.getElementById("editor").value;
//	var sectionHeading = $("#pageEditTitle").html();
//	var actualContent = "="+sectionHeading+"= \n"+content;
	var jsonString = {
					"format": "json",
					"action": "getTimeStamp",
					"title": localStorage.bookTitle,
					"section": value
				    };
					
	jsonString = JSON.stringify(jsonString);				
					
					
					
	/*$.ajax({
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
			});*/
	
/*$.post("scripts/mediawiki/api.php?action=query&prop=revisions&titles="+title+"&rvprop=timestamp|content&rvsection="+section+"&format=json", function(data){
		//alert(JSON.stringify(data));
		
		var string = JSON.stringify(data);
        var tokens = string.split("\"");
        var index = tokens[5];
       editTimeStamp = data.query.pages[index].revisions[0].timestamp;
	   
	localStorage.setItem("tStamp", editTimeStamp);
	

	 });*/
	 
	$("#pageView").fadeOut("slow",function(){
		$('#editSection').fadeIn("slow",function(){});
	
	});
	
	//$("#pageList").hide(700);
	//$("#createPage").hide(500);
	//$("#Dummy").hide(400);
	//$("#Page").hide(400);
	
	var headings = document.getElementsByClassName("sectionHeading");
	var insideText = document.getElementsByClassName("insideText");
	
	
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
	$("#editor").val(insideText[(value-1)].innerHTML);
	$("#saveBtn").attr("name","" + value);
	
	
}

		
    $(document).ready(function () {
		
		
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
		
		$('#viewBooks').click(function(){
			$('#pageView').fadeOut("slow",function(){
					//$('#pageView').html("");
					$('#bookList').fadeIn("slow",function(){});
			});
			getBooks();
		});
		
		//This is the next button click event when creating a new manuscript.
		$('#next-button').click(function(){
			event.preventDefault();
			
			//Get the data from inputs
					info.title = $('#title').val();
					info.firstname = $('#firstname').val();
					info.surname = $('#surname').val();
						
			if ($('#infoBox').css('display') === "none") //this is when the book gets created...
			{
				info.preface = $('#preface').val();
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
			
		});
		
		
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
                                    alert("Successful");
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

            console.log('got into get_page');

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
											htmlValue = "<div class='sectionDiv' onclick='editSection("+linkNumber+")'><div class='sectionHeading'>"+childNodes[i].innerHTML+"</div><div class='insideText'>";
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
							var links = page.getElementsByTagName("a");
							
							var num_links =1;
							for(var i=0; i<links.length; i++) {
								if(links[i].innerHTML === "edit")
								{
									links[i].setAttribute('href', "#");
									links[i].setAttribute('onclick', "editSection("+num_links+")");
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
