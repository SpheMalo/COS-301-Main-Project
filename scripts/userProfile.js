function goBack()
{
    location.href="insideContent.php";
}

function viewUserProfile(username){
    var action =
           {
               "action" : "viewUserProfile",
               "userToLookFor" : username
           }
           var JSONstring = JSON.stringify(action);
       
       $.ajax({
           url: 'scripts/FigbookActionHandler/actionHandler.php',
           data: 'json='+JSONstring,
           dataType: 'json',
           success: function(data){
               createNewUserProfile(data);
           },
           error: function(data){
               alert("error :"+JSON.stringify(data));
           }		
       });
}

function createNewUserProfile(jsonObj)
{
    //Filling the Portfolio page
    var profileArray = document.getElementsByClassName("profileInfo");
    
    profileArray[0].value = jsonObj['user_name'];
    profileArray[1].value = jsonObj['first_name'];
    profileArray[2].value = jsonObj['last_name'];
    profileArray[3].value = jsonObj['genres_of_interest'];
    //Filling the About Me page
    profileArray = document.getElementsByClassName("aboutMeInfo");
    
    profileArray[0].value = jsonObj['about_me'];
    
    //filling the contact details page
    profileArray = document.getElementsByClassName("contactInfo");
    
    profileArray[0].value = jsonObj['cell'];
    profileArray[1].value = jsonObj['home'];
    profileArray[2].value = jsonObj['work'];
    profileArray[3].value = jsonObj['email'];
    
    var books = "";
    for (var i=0; jsonObj.books[i] != null; i++)
    {
        jsonObj.books[i] = jsonObj.books[i].replace(/_/g, " ");   
        books += "<li>" + jsonObj.books[i] + "</li>";
    }
    
    document.getElementById("booklist").innerHTML = books;
    
}