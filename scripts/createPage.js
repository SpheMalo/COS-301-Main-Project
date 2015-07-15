
    $(document).ready(function () {


        $.post('scripts/mediawiki/api.php?action=query&list=allpages&aplimit=100&format=json',
                function (data) {
                    var html = "";
                    //alert(JSON.stringify(data.query.allpages));
                    html += "Page List: <select placeholder='Select Page' id='pageSelect' >" +
                            "<option value='' disabled='disabled' selected='selected'>Page List</option>";
                    $.each(data.query.allpages, function (i, v) {
                        html += "<option value='" + data.query.allpages[i].title + "'>" + data.query.allpages[i].title + "</option>";
                    });
                    html += "< /select>";
                    //alert(html);
                    document.getElementById("pageList").innerHTML = html;
                });
        //event.preventDefault();

        $('#pageList').on('change', 'select', function (event) {
            
            var selected = $(this).val();
            //alert(selected.val());
            var loadPageInfo = {
                "title": selected
            };
            get_page(loadPageInfo);
        });
        
        $("#create-button").click(function () {

            var CreatePageInfo = {
                "title": document.getElementById("title").value,
                "text": document.getElementById("manuscriptArea").value,
                "action": "edit",
                "section": "0"
            };
//var JSONstring = JSON.stringify(CreatePageInfo);
//alert(CreatePageInfo.title);

//ajaxLoginFunction(UserInfo);
            create_page(CreatePageInfo);
            //event.preventDefault();
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
//$('#viewPage').html('scripts/mediawiki/api.php?action=parse&page=' + params.title);
            console.log('got into get_page');
            /*$.post('scripts/mediawiki/api.php?action=parse&page=' + params.title,
             function (data) {
             console.log ( JSON.stringify(data) );
             alert(JSON.stringify(data));
             //var someVal = document.getElementById('regDiv');
             //someVal.innerHTML = "abcd";//JSON.stringify(data);
             event.preventDefault();
             //$('#viewPage').append(JSON.stringify(data));
             });*/
            //event.preventDefault();
            // $('#viewPage').append("<p>Yellow days</p>");
            /*
             $.ajax({
             url: "scripts/mediawiki/api.php?action=query&prop=revisions&rvprop=content&format=json&titles=" + params.title,
             dataType: "json"
             }).success(function (data) {
             //alert(JSON.stringify(data));
             console.log ( JSON.stringify(data) );
             //var pageID = data.query.pages;
             $.each(data.query.pages, function(i, v){
             $('#viewPage').append("<h1>" +data.query.pages[i].title + "</h1><br>");
             
             });
             //$('#viewPage').append(JSON.stringify(data));
             });*/
            var title_ = params.title;
            var replaced = title_.split(' ').join('_');
            alert(replaced);
            $.ajax({
                url: "scripts/mediawiki/index.php/" + replaced,
                dataType: "html"
            }, 5000).success(function (data) {
                console.log(JSON.stringify(data));
                $('#createPage').hide();
                $('#viewPage').hide();
				$('#contentDiv').hide();
				//$('#bodyContent').hide();
				$('#Page').css('overflow-y','auto');
				$('#bookDiv').css('overflow','auto');
				
				//try parse and traverse the html feedback.
				 /*var nodeNames = [];
				 var val = $.parseHTML( data );
				 $.each( val, function( i, el ) {
					  nodeNames[ i ] = "<li>" + el.nodeName + "</li>";
					});
				 alert(nodeNames);*/
				 //try parse and traverse the html feedback.
				 
				 //For sito add page data here...
                document.getElementById('Page').innerHTML = data;
				
				//These are menu and side panel items that are generated
				//$("#mw-page-base").hide();
				//$("#mw-head").hide();
				//$('#mw-panel').hide();
				
				
                //$('#Page').append(data);
                //window.location.href = "/scripts/mediawiki/index.php/"+ params.title;

            }, 5000).error(function (data) {
                console.log(JSON.stringify(data));
                //window.location.href = "/scripts/mediawiki/index.php/"+ params.title;
            });
            event.preventDefault();
        }

    });
