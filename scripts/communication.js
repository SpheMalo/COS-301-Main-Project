$(document).ready(function () {

    setInterval(function () {
        var role = localStorage.userRole;
        var book = localStorage.bookTitle;
        if (role === "Creator" && localStorage.reload === "yes") {

            $('#letterText').css('display', 'none');
            $('#sendLetter').css('display', 'none');
            addErrorCode("You have the following letters:", "letterArea", "#478B4D");
            loadLetters(book, "letterArea");

        }
        else if (role === "" && localStorage.reload === "yes") {
            var element = document.getElementById("listLetters");
            element.outerHTML = "";
            delete element;

            var element = document.getElementById("letterError");
            element.outerHTML = "";
            delete element;
            $('#letterText').css('display', 'block');
            $('#sendLetter').css('display', 'block');
        }

    }, 5000);

    $('#sendLetter').click(function () {
        var letterInfo = {
            "text": document.getElementById("letterText").value,
            "action": "editorial_letter",
            "bookTitle": localStorage.bookTitle
        };
        var JSONstring = JSON.stringify(letterInfo);
        var myrole = localStorage.userRole;
        alert("Book title: " + JSONstring.bookTitle + "role: " + myrole);
        var send = true;

        if (letterInfo.bookTitle === "" || myrole === "") {
            addErrorCode("Please select book for letter", "letterArea", "#F95050");
            send = false;
        }
        else if (myrole !== "Editor") {
            addErrorCode("You are not an editor!", "letterArea", "#F95050");
            send = false;
        }
        //alert(document.getElementById("letterText").value);
        if (send) {
            
            $.ajax({
                url: 'scripts/FigbookActionHandler/actionHandler.php',
                data: 'json=' + JSONstring,
                dataType: 'json',
                success: function (data)
                {
                    if (data === "success") {
                        addErrorCode("Letter Sent!", "letterArea", "#29F251");
                    }
                    else {
                        addErrorCode(data, "letterArea", "#F95050");
                    }
                }
                , error: function (data) {
                    addErrorCode("Letter Sent with a minor error!", "letterArea", "#E8F229");
                }
            });
            event.preventDefault();
        }
    });

    function addErrorCode(errCode, field, color) {

        if (document.getElementById("letterError") === null) {
            var div = document.getElementById(field);
            var error_place = document.createElement('p');
            error_place.id = "letterError";
            error_place.innerHTML = errCode;
            error_place.style.color = color;
            error_place.style.fontSize = "14pt";
            div.appendChild(error_place);
        }
        else
        {

            var error_place = document.getElementById("letterError");
            error_place.id = "letterError";
            error_place.innerHTML = errCode;
            error_place.style.color = color;
            error_place.style.fontSize = "14pt";
        }

    }
    function loadLetters(book, div) {

        localStorage.reload = "no";
        alert(book);
        var letterInfo = {
            "action": "get_editorial_letter",
            "bookTitle": book
        };
        var JSONstring = JSON.stringify(letterInfo);
        $.ajax({
            url: 'scripts/FigbookActionHandler/actionHandler.php',
            data: 'json=' + JSONstring,
            dataType: 'json',
            success: function (data)
            {
                //alert(JSON.stringify(data));
                populateLetters(data, div);
            }
            , error: function (data) {
                addErrorCode("Error getting letters", div, "#E8F229");
            }
        });
        event.preventDefault();
    }

    function populateLetters(data, div) {
        //data = JSON.stringify(data);
        var div2 = document.getElementById(div);
        //alert("Pop   " +data);
        if (document.getElementById("listLetters") === null) {
            var letters = document.createElement('div');
            letters.id = "listLetters";
        }
        else {
            letters = document.getElementById("listLetters");
        }
        div2.appendChild(letters);
        $.each(data, function (i, v) {

            var letter = document.createElement('p');
            var pb = document.createElement('br');
            letter.className = "lettr";
            letter.innerHTML = "Letter: " + v.id + " From: " + v.user_name;
            letter.style.fontSize = "12pt";
            letter.style.color = "#61C6B5";
            var att = document.createAttribute("value");       // Create a "value" attribute
            att.value = v.message;                           // Set the value of the class attribute
            var att2 = document.createAttribute("from");       // Create a "value" attribute
            att2.value = v.user_name;
            letter.setAttributeNode(att);
            letter.setAttributeNode(att2);
            letters.appendChild(letter);
            

        });
        $('.lettr').click(function () {
            //localStorage.reload = "no";
            //console.log($(this).attr('value'));
            var generator = window.open('', 'name', 'height=400,width=500');
            var styleSheet = "<link rel='stylesheet' href='css/content.css'>  ";
            generator.document.write('<html><head><title>Editorial Letter</title>'+styleSheet+'</head><body>');
            generator.document.write('<h2>From: '+$(this).attr('from')+'</h2><br>');
            var content = "<textarea id='letterText' cols='50' rows='20' >"+$(this).attr('value')+"</textarea>";
            generator.document.write(content);
            generator.document.write('</body></html>');
            generator.document.close();
            //document.getElementById("letterText").value = $(this).attr('value');
            //document.getElementById("letterText").value = data[key].message;
        });

    }

});

