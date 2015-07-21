function saveText()
{
    var title = $("#pageSelect :selected").html();
    var sectionHeading = $("#pageEditTitle").html();
    var sectionNumber = $("#saveBtn").attr("name");
    var content = document.getElementById("editor").value;
    sectionNumber = parseInt(sectionNumber);
    

    
    $.post("scripts/mediawiki/api.php?action=query&prop=info|revisions&meta=tokens&rvprop=timestamp&titles="+title+"&format=json", function(data){
        var string = JSON.stringify(data);
        var tokens = string.split("\"");
        var index = tokens[5];
        var timeStamp = localStorage.getItem("tStamp");
        
        $.ajax({
                    url: "scripts/mediawiki/api.php",
                    data: {
                        format: 'json',
                        action: 'edit',
                        title: title,
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