function hideSidemenu()
    {
    	var clas = $("#barIcon");
    	if(clas.hasClass("fa-bars"))
    	{
    		$("#sideMenus").animate({"left":"0px"}, "slow").show();
    		$("#barIcon").removeClass("fa-bars").addClass("fa-times");
    		$(".body-content").css("position","fixed");
    	}
    	else
    	{
    		$("#sideMenus").animate({"left":"-350px"}, "slow").show();
			$("#barIcon").removeClass("fa-times").addClass("fa-bars");
			$(".body-content").css("position","relative");
    	}
    	
    }
function hideSidemenudd()
{
	//$("#sideMenus").animate({"left":"-350px"}, "slow").show();
	//$("#barIcon").removeClass("fa-times").addClass("fa-bars");
}