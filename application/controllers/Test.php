<?php 
/**
 * 
 */
class Test extends CI_controller
{
	
	function index()
	{ ?>
		<html>
   <head>
   </head>
   <body>
      <table id="myTable" class="table table-bordered table-striped table-fixed">
         <thead>
            <th>Key Account</th>
            <th>Key Account Code</th>
            <th>Potential Value</th>
            <th>Sales Value</th>
            <th>Penetration %</th>
            <th>Potential (H/M/L)</th>
            <th>Penetration (H/M/L)</th>
         </thead>
         <?php echo "Some data from database here";?>   
      </table>
      <button id="convert">
      Convert to image
      </button>
      <div id="result">
         <!-- Result will appear be here -->
      </div>
      <script type="text/javascript" src="https://github.com/niklasvh/html2canvas/releases/download/0.5.0-alpha1/html2canvas.js"></script>
      <script>
         //convert table to image            
         function convertToImage() {
            var resultDiv = document.getElementById("result");
            html2canvas(document.getElementById("myTable"), {
                onrendered: function(canvas) {
                    var img = canvas.toDataURL("image/png");
                    result.innerHTML = '<a download="test.jpeg" href="'+img+'">test</a>';
                    }
            });
         }        
         //click event
         var convertBtn = document.getElementById("convert");
         convertBtn.addEventListener('click', convertToImage);
      </script>
   </body>
</html>  
<?php	}
}