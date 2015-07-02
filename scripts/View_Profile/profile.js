function view_profile()
{
    var action = {"action" : "view_profile"};
    var JSONstring = JSON.stringify(action);
    
     $.ajax({
            url: "view_profile.php", 
            type: "post", //can be post or get
            data: 'json='+JSONstring,
            dataType: 'json',
            success: function(returned)
            {
                alert(returned);
                //createProfile(returned);
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