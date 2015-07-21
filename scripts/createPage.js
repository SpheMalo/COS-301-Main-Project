function editSection(value)
{
	alert(value);
	
}

		
    $(document).ready(function () {

		
		
		
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
					$('#pageView').html("");
					$('#bookList').fadeIn("slow",function(){});
			});
			
		});
		
		//This is the next button click event when creating a new manuscript.
		$('#next-button').click(function(){
			event.preventDefault();
			
			//Get the data from inputs
					info.title = $('#title').val();
					info.firstname = $('#firstname').val();
					info.surname = $('#surname').val();
						
			if ($('#infoBox').css('display') === "none")
			{
				info.preface = "<preface>"+$('#preface').val()+"</preface>";
				info.text = info.preface;
				//console.log(info.preface);
				
				//Todo call the create page function
				create_page(info);
				$('#inputs2').fadeOut("slow",function(){
						
					});
					$('#bookDiv').fadeOut("slow",function(){
						
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
						
						//make sure it gets a title for a book to load
						if (loadPageInfo.title !== "")
						{
						 get_page(loadPageInfo);
						}
						
					});
                });
		}
		
		//call the function once on page load...
		getBooks();
		 
		
		 
	
        //event.preventDefault();

        $('#pageList').on('change', 'select', function (event) {
            
            var selected = $(this).val();
            //alert(selected.val());
            var loadPageInfo = {
                "title": selected
            };
            get_page(loadPageInfo);
        });
        
       
       
		
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
                                    //$('#Page').append("<a href='/scripts/mediawiki/index.php/"+params.title+"'>Link to your book</a>");
                                    //window.location.href = "/scripts/mediawiki/index.php/"+ params.title;
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
            //alert(stoken);

            //alert("In here3");

            /*api.postWithToken({action: params.action, title: params.title,
             section: params.section, text: params.text})
             .done(function (result, jqXHR) {
             
             mw.log("Created successfully");
             alert("Created successfully");
             alert(result);
             //window.location.reload();
             })
             .fail(function (code, result) {
             alert("in error mode");
             if (code == "http") {
             mw.log("HTTP error " + result.textStatus);
             alert("HTTP error " + result.textStatus);
             }
             else if (code == "ok-but-empty") {
             mw.log("empty response from server ");
             alert("empty response from server ");
             }
             else {
             mw.log("API error" + code);
             alert("API error" + code);
             }
             });
             */
            //});
            /*alert("I get here " + params.title);
             $.post('scripts/mediawiki/api.php?action='+params.action+'&text=' + params.text + 
             '&title=' + params.title + '&format=json&section='+params.section, function(data) {
             //alert(data.edit.token);
             alert(data.edit.result);
             if(data.edit.result == 'NeedToken') {
             
             $.post('scripts/mediawiki/api.php?action='+params.action+'&text=' + params.text + 
             '&title=' + params.title + '&format=json&section='+params.section, '&token='+data.edit.token, 
             function(data) {
             if(!data.error){
             if (data.edit.result == "Success") { 
             //alert(data.login.sessionid);
             document.location.reload(); 
             
             } else {
             console.log('Result: '+ data.edit.result);
             alert('Result: '+ data.edit.result);
             }
             } else {
             console.log('Error: ' + data.error);
             alert('Error: ' + data.error);
             }
             });
             } else {
             console.log('Result: ' + data.edit.result);
             alert('Result: ' + data.edit.result);
             }
             if(data.error) {
             console.log('Error: ' + data.error);
             alert('Error: ' + data.error);
             }
             });
             
             */
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
							
							$( "#pageView" ).append(childNodes);
								
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
