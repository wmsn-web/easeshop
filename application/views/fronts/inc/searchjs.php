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
                $("#resContent").html(response);
            })
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
</script>