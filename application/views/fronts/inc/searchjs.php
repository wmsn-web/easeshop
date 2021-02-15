<script type="text/javascript">
	jQuery(document).ready(function() {
    "use strict";

    $("#keywords").keyup(function(){
    	var keywords = $("#keywords").val();
    	if(keywords.length >0)
    	{
            $.post("<?= base_url('SearchController/search'); ?>",
            {
                keywords: keywords
            },function(response){
                if(response=="NotFound")
                {
                    $("#results").hide();
                }
                else
                {
                    $("#results").show();
                    $("#resContent").html(response);
                }
            })
    		
    	}
    	else
    	{
    		$("#results").hide();
    	}
    	
    });

    $("#keywords2").keyup(function(){
        var keywords = $("#keywords2").val();
        if(keywords.length >0)
        {
            $.post("<?= base_url('SearchController/search2'); ?>",
            {
                keywords: keywords
            },function(response){
                if(response=="NotFound")
                {
                    $("#results2").hide();
                }
                else
                {
                    $("#results2").show();
                    $("#resContent2").html(response);
                }
                
            })
            
        }
        else
        {
            $("#results2").hide();
        }
        
    });
});

function selectSrc(name)
{
    $("#keywords").val(name);
    $("#results").hide();
}
function selectSrc2(name)
{
    $("#keywords2").val(name);
    $("#results2").hide();
}
</script>