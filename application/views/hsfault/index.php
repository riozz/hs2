    <!-- Page Content -->
       <!-- menu in header.php -->

            <div class="col-md-9">
	   	<div class="row">
    			<div class="alert alert-info"><h3>Fault Management</h3></div>
		<?php echo "xxx orderid=".$orderid; ?>
		<?php echo "xxx faultid=".$faultid; ?>
		</div>


  	      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	      <script>
	        var fiid = <?php echo $faultid ?>; 
		//var url = "faults/"+<?php echo $orderid; ?>;
		//get fault history
		var furl = "/dev/hs2/index.php/faults/index/" + "<?php echo '/'.$orderid; ?>";
		//get fault detail
		var fiurl = "/dev/hs2/index.php/faults/view/" + "<?php echo $orderid; ?>/<?php echo $faultid; ?>";
		//alert ("furl="+furl);	
		//alert ("fiurl="+fiurl);	
		$(document).ready(function(){
		    //alert("<?php echo "orderid=".$orderid; ?>");
		    //alert("href = "+window.location.href);
		    //alert("hrefpath = "+window.location.pathname);
		    //alert("url = "+furl);
		    //alert ("fiurl="+fiurl);	
		    $('#history').html("<b><center>Loading ... </center></b>");
	 	    $.ajax({
		      type:'POST',
		      //url: 'faults',
		      url: furl,
		      data: $(this).serialize()
		    })
		    .done(function(data) {
		      //show result
	  	      $('#history').html(data);
		    })
		    .fail(function() {
		      alert(" Loading error.");
		    });
		    //return false;
		    //faultinfo area
		    $('#faultinfo').html("<b><center>Loading ... </center></b>");
		    $.ajax({
		      type:'POST',
		      url: fiurl,
		      data: $(this).serialize()
		    })
		    .done(function(data) {
		      $('#faultinfo').html(data);
		    })
		    .fail(function() {
		      alert(" Loading error. ");
		    });
		    return false;	
		});
	      </script>

<!-- fault info by ajax -->
		<div class="thumbnail">
		  <div class="caption-full"></div>
		    <div id="faultinfo">
		    </div>
	 	</div>	
<!-- ^fault info by ajax -->
		  
<!-- history by ajax -->
                <div class="thumbnail">
		  <div class="alert alert-warning"><h3>Fault History</h3></div>
		    <div id="history">
		    </div>
		</div>
<!-- ^history by ajax -->

            </div>

        </div>

    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-table.js"></script>

