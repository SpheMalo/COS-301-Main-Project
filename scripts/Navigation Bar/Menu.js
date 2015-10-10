var isShowing =false;
var activeMenuItem =null;
function show(id)
{
	hide();
	activeMenuItem =  document.getElementById(id);
	if(activeMenuItem!=null)
	{
		activeMenuItem.style.visibility ="visible";
		isShowing=true;
	}
}

function hide()
{
	if(isShowing)
	{
		activeMenuItem.style.visibility="hidden";
		isShowing=false;
	}
}
