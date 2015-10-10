function editSection(section){
	var editTimeStamp;
	var title = "My_Page";
	var content = "";
	var sectionHeading = "Chapter 1";
	var actualContent = "egntiugh";
	
	$.ajax({
                    url: "scripts/FigbookActionHandler/actionHandler.php",
                    data: {
                        format: 'json',
                        action: 'getTimeStamp',
                        title: title,
                        section: section,
                    },
                    dataType: 'json',
                    type: 'POST',
                    success: function (data) {
                        alert(JSON.stringify(data));
                    },
                    error: function (data) {
                        console.log('Error: Request failed. ' + JSON.stringify(data));

                        //event.preventDefault();
                    }
                });
	/*$("#viewPage").hide(900);
	$("#pageList").hide(700);
	$("#createPage").hide(500);
	$("#Dummy").hide(400);
	$("#Page").hide(400);
	$("#editSection").css("visibility", "visible");
	$("#pageEditTitle").html($("#"+section+" .mw-headline").html());
	$("#editor").html("");
	var arr = $("#"+section).nextUntil("h1");
	str = "";
	for(var i = 0; i < arr.length; i++){
		if (arr[i].nodeName == "P") {
			
			str+= arr[i].innerHTML+"\n";
		}
	}
	
	var res = str.replace("<br>", "\n");
	$("#editor").html(res);
	$("#saveBtn").attr("name","" + section);*/
	return section;
}