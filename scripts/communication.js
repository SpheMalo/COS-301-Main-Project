$(document).ready(function () {

    setInterval(function () {
        var role = localStorage.userRole;
        var book = localStorage.bookTitle;
        //console.log(localStorage.reload + " role: " + role);
        if (localStorage.reload === "yes") {
            if (document.getElementById("updateLetter") !== null) {
                var element = document.getElementById("updateLetter");
                element.outerHTML = "";
                delete element;
            }
            if (document.getElementById("listLetters") !== null) {
                var element = document.getElementById("listLetters");
                element.outerHTML = "";
                delete element;
            }
            if (document.getElementById("letterError") !== null) {
                var element = document.getElementById("letterError");
                element.outerHTML = "";
                delete element;
            }

            if (role === "Creator") {
                localStorage.reload = "no";
                $('#letterText').css('display', 'none');
                $('#sendLetter').css('display', 'none');
                addErrorCode("Inbox", "letterArea", "#478B4D");
                loadLetters(book, "letterArea");

            }
            else if (role === "") {
                $('#letterText').css('display', 'block');
                $('#sendLetter').css('display', 'block');
            }
            else if (role === "Editor") {
                localStorage.reload = "no";
                $('#letterText').css('display', 'none');
                $('#sendLetter').css('display', 'none');
                addLink(" New", "letterTop", "#606CF5", "right", "20px", "newL", "new");
                addLink(" Outbox", "letterTop", "#606CF5", "right", "40px", "listL", "list");

            }
        }

    }, 1000);


    $('#sendLetter').click(function () {
        var letterInfo = {
            "text": document.getElementById("letterText").value,
            "action": "editorial_letter",
            "bookTitle": localStorage.bookTitle
        };
        var JSONstring = JSON.stringify(letterInfo);
        var myrole = localStorage.userRole;
        //alert("Book title: " + JSONstring.bookTitle + "role: " + myrole);
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
    function addLink(linkName, placeToAdd, color, float, margin, id, type) {

        if (document.getElementById(id) === null) {
            var div = document.getElementById(placeToAdd);
            var link = document.createElement('a');
            link.id = id;
            link.setAttribute('href', "#");
            link.className = "lettrLink";
            var att = document.createAttribute("value");       // Create a "value" attribute
            att.value = type;
            link.setAttributeNode(att);
            link.innerHTML = linkName;
            link.style.color = color;
            link.style.textDecoration = "none";
            link.style.cssFloat = float;
            link.style.marginRight = margin;
            link.style.fontSize = "14pt";
            div.appendChild(link);
        }
        else
        {

            var link = document.getElementById(id);
            link.id = id;
            link.setAttribute('href', "#");
            link.className = "lettrLink";
            var att = document.createAttribute("value");       // Create a "value" attribute
            att.value = type;
            link.setAttributeNode(att);
            link.innerHTML = linkName;
            link.style.color = color;
            link.style.textDecoration = "none";
            link.style.cssFloat = float;
            link.style.marginRight = margin;
            link.style.fontSize = "14pt";
        }
        $('.lettrLink').click(function () {
            localStorage.reload = "no";
            if (document.getElementById("updateLetter") !== null) {
                var element = document.getElementById("updateLetter");
                element.outerHTML = "";
                delete element;
            }
            if (document.getElementById("letterError") !== null) {
                var element = document.getElementById("letterError");
                element.outerHTML = "";
                delete element;
            }
            if (document.getElementById("listLetters") !== null) {
                var element = document.getElementById("listLetters");
                element.outerHTML = "";
                delete element;
            }

            if ($(this).attr('value') === "new") {
                document.getElementById("letterText").value = "";
                $('#letterText').css('display', 'block');
                $('#sendLetter').css('display', 'block');
            }
            else if ($(this).attr('value') === "list") {
                $('#letterText').css('display', 'none');
                $('#sendLetter').css('display', 'none');
                var book = localStorage.bookTitle;
                loadLettersEditor(book, "letterArea");
            }
        });
    }
    function loadLettersEditor(book, div) {

        localStorage.reload = "no";
        //alert(book);
        var letterInfo = {
            "action": "get_editorial_letter_editor",
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
                populateLetters(data, div, "editor");
            }
            , error: function (data) {
                addErrorCode("Error getting letters", div, "#E8F229");
            }
        });
        event.preventDefault();
    }
    function loadLetters(book, div) {

        localStorage.reload = "no";
        //alert(book);
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
                populateLetters(data, div, "author");
            }
            , error: function (data) {
                addErrorCode("Error getting letters", div, "#E8F229");
            }
        });
        event.preventDefault();
    }

    function populateLetters(data, div, userType) {
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
        if (userType === "author") {
            var count = 1;
            $.each(data, function (i, v) {

                var letter = document.createElement('a');
                var pb = document.createElement('br');
                letter.className = "lettr";
                letter.style.textDecoration = "none";
                letter.setAttribute('href', "#");
                letter.innerHTML = "Letter: " + count + " From: " + v.user_name;
                letter.style.fontSize = "12pt";
                letter.style.color = "#606CF5";
                var att = document.createAttribute("value");       // Create a "value" attribute
                att.value = v.message;                           // Set the value of the class attribute
                var att2 = document.createAttribute("from");       // Create a "value" attribute
                att2.value = v.user_name;
                letter.setAttributeNode(att);
                letter.setAttributeNode(att2);
                letters.appendChild(letter);
                letters.appendChild(pb);
                count = count + 1;

            });
            $('.lettr').click(function () {
                //localStorage.reload = "no";
                //console.log($(this).attr('value'));
                var generator = window.open('', 'name', 'height=400,width=500');
                var styleSheet = "<link rel='stylesheet' href='css/content.css'>  ";
                generator.document.write('<html><head><title>Editorial Letter</title>' + styleSheet + '</head><body>');
                generator.document.write('<h2>From: ' + $(this).attr('from') + '</h2><br>');
                var content = "<textarea id='letterText' cols='50' rows='20' >" + $(this).attr('value') + "</textarea>";
                generator.document.write(content);
                generator.document.write('</body></html>');
                generator.document.close();
                //document.getElementById("letterText").value = $(this).attr('value');
                //document.getElementById("letterText").value = data[key].message;
            });
        }
        else if (userType === "editor") {
            var count = 1;
            $.each(data, function (i, v) {

                var letter = document.createElement('a');
                var pb = document.createElement('br');
                letter.id = v.id;
                letter.style.textDecoration = "none";
                letter.setAttribute('href', "#");
                letter.className = "lettrE";
                letter.innerHTML = "Letter: " + count;
                letter.style.fontSize = "12pt";
                letter.style.color = "#606CF5";
                var att = document.createAttribute("value");       // Create a "value" attribute
                att.value = v.message;
                letter.setAttributeNode(att);
                letters.appendChild(letter);
                letters.appendChild(pb);
                count = count + 1;

            });
            $('.lettrE').click(function () {
                var element = document.getElementById("listLetters");
                element.outerHTML = "";
                delete element;
                $('#letterText').css('display', 'block');
                document.getElementById("letterText").value = $(this).attr('value');
                var btn = document.createElement("BUTTON");
                btn.id = 'updateLetter';
                btn.className = "updateLetter";
                var att = document.createAttribute("letter_id");       // Create a "value" attribute
                att.value = $(this).attr("id");
                btn.setAttributeNode(att);
                btn.style.cssFloat = 'center';
                var t = document.createTextNode("Update");
                btn.appendChild(t);
                div2.appendChild(btn);
                $('.updateLetter').click(function () {
                    //alert("clicked");
                    var letterInfo = {
                        "text": document.getElementById("letterText").value,
                        "action": "editorial_letter_update",
                        "letter": $(this).attr("letter_id")
                    };
                    var JSONstring = JSON.stringify(letterInfo);
                    //var myrole = localStorage.userRole;
                    //alert("Book title: " + JSONstring.bookTitle + "role: " + myrole);
                    var send = true;
                    //alert(document.getElementById("letterText").value);
                    if (send) {

                        $.ajax({
                            url: 'scripts/FigbookActionHandler/actionHandler.php',
                            data: 'json=' + JSONstring,
                            dataType: 'json',
                            success: function (data)
                            {
                                if (data === "success") {
                                    addErrorCode("Letter Updated!", "letterArea", "#29F251");
                                }
                                else {
                                    addErrorCode(data, "letterArea", "#F95050");
                                }
                            }
                            , error: function (data) {
                                addErrorCode("Letter Updated with a minor error!", "letterArea", "#E8F229");
                            }
                        });
                        event.preventDefault();
                    }
                });
            });

        }

    }

});

