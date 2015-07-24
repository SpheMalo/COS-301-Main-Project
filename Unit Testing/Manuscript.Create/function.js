 function pageinformation() {

            var CreatePageInfo = {
                "title": "My Book",
                "text": "Hello",
                "action": "edit",
                "section": "0"
            }
            return create_page(CreatePageInfo);
        }

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
                                //$('#Page').append("<a href='/scripts/mediawiki/index.php/" + params.title + "'>Link to your book</a>");
                                //alert("Page: "+params.title+" created successfully");
                                //window.location.href = "/scripts/mediawiki/index.php/"+ params.title;

                                //event.preventDefault();
                                get_page(params);
                            }
                        });
                    });
 			return "Success";
		}		