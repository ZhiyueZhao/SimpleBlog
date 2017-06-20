/*
    This javascript is used to count the characters inserted and warning the user when it is longer than 40 and 500.

    Author: Zhiyue Zhao
    Date: February 13, 2016
    */
function CountWords(){
	var titleCharCount = document.getElementById("title").value.length;
    var contentCharCount = document.getElementById("content").value.length;
	if (titleCharCount>40) 
	{
		if(!confirm('The title you entered is longer than 40 character, it will be cut out！'))
		{
			return false;
		}
    }
	else if (contentCharCount>500)
	{
		if(!confirm('The content you entered is longer than 500 character, it will be cut out！'))
		{
			return false;
		}
    }
}