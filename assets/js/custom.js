jQuery(document).ready(function() {
    "use strict";

    $("#keywords").keyup(function(){
    	var keywords = $("#keywords").val();
    	if(keywords.length >0)
    	{
    		$("#results").show();
    	}
    	else
    	{
    		$("#results").hide();
    	}
    	
    });
});

function selectSrc(name)
{
    $("#keywords").val(name);
    $("#results").hide();
}