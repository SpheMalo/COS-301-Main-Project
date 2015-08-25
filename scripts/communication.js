$(document).ready(function () {
    
     
    
    $('#letter_saveBtn').click(function () {
        var letterInfo = {
            "text": document.getElementById("letter_editor").value,
            "action": "editorial_letter",
            "bookTitle": 'Bookkkk'//localStorage.bookTitle
        };
        alert(document.getElementById("letter_editor").value);
        
        var JSONstring = JSON.stringify(letterInfo);
	        $.ajax({
	            url: 'scripts/FigbookActionHandler/actionHandler.php',
	            data: 'json=' + JSONstring,
	            dataType: 'json',
	            success: function (data)
	            {
	                alert(JSON.stringify(data));
	            }
	            , error: function (data) {
	                alert(JSON.stringify(data));
	            }
	        });
	        event.preventDefault();
    });
    
});

