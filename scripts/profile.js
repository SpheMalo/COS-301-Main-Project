function view_profile()
{
    var action = {"action" : "view_profile"};
    var JSONstring = JSON.stringify(action);
    
     $.ajax({
            url: "test.php", 
            type: "post", //can be post or get
            data: 'json='+JSONstring,
            dataType: 'json',
            success: function(returned)
            {
                createProfile(returned);
            },
            error: function(val){
                alert("Error: " + val);
            }
        }); 
}

function createProfile(jsonObj)
{
    jsonObj = json_decode(jsonObj);
}