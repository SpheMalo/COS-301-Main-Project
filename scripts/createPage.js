window.onload = function ()
{
    $(document).ready(function () {



        $("#create-button").click(function () {

            var CreatePageInfo = {
                "title": document.getElementById("title").value,
                "text": document.getElementById("text").value,
                "action": "edit",
                "section": "0"
            }
            //var JSONstring = JSON.stringify(CreatePageInfo);
            //alert(CreatePageInfo.title);

            //ajaxLoginFunction(UserInfo);
            create_page(CreatePageInfo);
            //event.preventDefault();
        });
        $("#load-button").click(function () {

            var loadPageInfo = {
                "title": document.getElementById("gettitle").value,
            }
            //var JSONstring = JSON.stringify(CreatePageInfo);
            //alert(loadPageInfo.title);

            //ajaxLoginFunction(UserInfo);
            get_page(loadPageInfo);
            //event.preventDefault();
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
                                if (data && data.edit && data.edit.result == 'Success') {
                                    alert("Successful");
                                    window.location.reload(); // reload page if edit was successful

                                } else if (data && data.error) {
                                    alert('Error: API returned error code "' + data.error.code + '": ' + data.error.info);
                                } else {
                                    alert('Error: Unknown result from API.');
                                }
                            },
                            error: function (data) {
                                console.log('Error: Request failed. ' + JSON.stringify(data));
                                alert("Page: "+params.title+" created successfully");
                                window.location.href = "/scripts/mediawiki/index.php/"+ params.title;
                                get_page(params);

                            }
                        });
                    });
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
            }).success(function (data) {
                console.log(JSON.stringify(data));
                $('#createPage').hide();
                $('#viewPage').hide();
                $('#Page').append(data);
                window.location.href = "/scripts/mediawiki/index.php/"+ params.title;

            }).error(function (data){
                console.log(JSON.stringify(data));
                window.location.href = "/scripts/mediawiki/index.php/"+ params.title;
            });
        }


    });

}