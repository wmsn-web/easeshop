function hideSidemenu()
    {
    	var clas = $("#barIcon");
    	if(clas.hasClass("fa-bars"))
    	{
    		$("#sideMenus").animate({"left":"0px"}, "slow").show();
    		$("#barIcon").removeClass("fa-bars").addClass("fa-times");
    		$(".body-content").css("position","fixed");
            $(".footMenu").hide();
    	}
    	else
    	{
    		$("#sideMenus").animate({"left":"-350px"}, "slow").show();
			$("#barIcon").removeClass("fa-times").addClass("fa-bars");
			$(".body-content").css("position","relative");
            $(".footMenu").show();
    	}
    	
    }
function showMyAc()
{
	var clas = $("#Myac");
    if(clas.hasClass('fa-user'))
    {
        $("#subBtmMenuId").animate({"bottom":"63px"}, "slow").show();
        $("#Myac").removeClass("fa-user").addClass("fa-times");
    }
    else
    {
        $("#subBtmMenuId").animate({"bottom":"-280px"}, "slow").show();
        $("#Myac").removeClass("fa-times").addClass("fa-user");
    }
}