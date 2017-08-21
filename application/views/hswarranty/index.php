    <!-- Page Content -->
       <!-- menu in header.php -->

            <div class="col-md-9">
	   	<div class="row">
    		  <div class="alert alert-info"><h3>Warranty Management &nbsp;&nbsp;&nbsp
      		  <button type="button" class="btn-info btn-lg glyphicon glyphicon-circle-arrow-up" id="infotoggle" data-toggle="collapse" data-target="#warrantyinfo">&nbsp;Warranty Info</button></h3>&nbsp;&nbsp;&nbsp;
      		  <!--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#upgradeinfo">Upgrade Info</button>&nbsp;&nbsp;&nbsp;
      		  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#tcassignmentinfo">TC Assignment Info</button>&nbsp;&nbsp;&nbsp;
      		  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#tccompletioninfo">TC Completion Info</button>-->
    		</div>


<!--
  	      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
//  -->
              <script src="<?php echo base_url("js/jquery.min.js"); ?>"></script>
              <script src="<?php echo base_url("js/jquery.validate.min.js"); ?>"></script>
    	      <script type="text/javascript" charset="UTF-8" src="<?php echo base_url("js/bootstrap-datetimepicker.js"); ?>"></script>
    	      <!-- Bootstrap Core JavaScript  
    	      <script src="<?php echo base_url("js/bootstrap-table.js"); ?>"></script>
	      // -->
    	      <script src="<?php echo base_url("js/bootstrap.min.js"); ?>"></script>
	      <script>
		/*
	        $.validator.setDefaults({
		  debug:true,
		  submitHandler: function() {
		    alert("submitted!");
		  }
		});
		*/
	      </script>
	      <script>
	        var wiid = <?php echo $id ?>;  //warrantyid
		<?php
		  //get the warrantyid after update action
		  if (isset($result)) {
		    $actionwarrantyid = $result['id']; //warrantyid
		    $actionmsg = $result['msg'];	
		  } else {
		    $actionwarrantyid = 0;
		    $actionmsg = '';
		  }
		?>
		//var url = "warrantys/"+<?php echo $fullorder_id; ?>;
		//get fault history
		//var wurl = "/dev/hs2/index.php/warrantys/index/" + "<?php echo '/'.$fullorder_id; ?>";
		//var wiurl = "/dev/hs2/index.php/warrantys/view/" + "<?php echo $fullorder_id; ?>/<?php echo $id; ?>";
		//get warranty history of orderid and action warrantyid
		//var wurl = "<?php echo base_url(); ?>" + "index.php/warrantys/index/" + "<?php echo '/'.$fullorder_id; ?>";
		var actionmsg = "<?php echo $actionmsg; ?>";
		//alert('[ZZZ53]actionmsg='+actionmsg);
		var wurl = "<?php echo base_url(); ?>" + "index.php/warrantys/index/" + "<?php echo '/'.$fullorder_id; ?>/<?php echo $actionwarrantyid; ?>";
		//get fault detail of orderid
		var wiurl = "<?php echo base_url(); ?>" + "index.php/warrantys/view/" + "<?php echo $fullorder_id; ?>/<?php echo $id; ?>";
		//get fault detail
		//alert ("wurl="+wurl);	
		//alert ("wiurl="+wiurl);	
		$(document).ready(function(){
		    //alert("<?php echo "fullorderid=".$fullorder_id; ?>");
		    //alert("href = "+window.location.href);
		    //alert("hrefpath = "+window.location.pathname);
		    //alert("url = "+wurl);
		    //alert ("wiurl="+wiurl);	

		    $('#history').html("<b><center>Loading ... </center></b>");
	 	    $.ajax({
		      type:'POST',
		      //url: 'faults',
		      url: wurl,
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
		    //warrantyinfo area
		    $('#warrantyinfo').html("<b><center>Loading ... </center></b>");
		    $.ajax({
		      type:'POST',
		      url: wiurl,
		      data: $(this).serialize()
		    })
		    .done(function(data) {
		      $('#warrantyinfo').html(data);
		    })
		    .fail(function() {
		      alert(" Loading error. ");
		    });
		    if (actionmsg.length>0) {
		      $("#actionmsg").collapse('show');
		      $("#warrantyinfo").collapse('hide');
		      $("#infotoggle").toggleClass('glyphicon-circle-arrow-up').toggleClass('glyphicon-circle-arrow-down');
		    }
		    return false;	
		});

                $('#infotoggle').click(function() {
                  $(this).toggleClass('glyphicon-circle-arrow-up').toggleClass('glyphicon-circle-arrow-down');
                });
	      </script>

<!-- warranty info by ajax -->
		<div class="thumbnail" id="warrantyinfoarea">
		  <div class="caption-full"></div>
		    <div class="collapse in" id="warrantyinfo">
		    </div>
	 	</div>	
<!-- ^warranty info by ajax -->
		 
<!-- action message -->
                <div class="collapse" id="actionmsg">
		  <div class="alert alert-success">
		    <label><center><?php echo "System Message: ".$actionmsg; ?></center></label>
		  </div>
		</div>
<!-- ^action message -->
 
<!-- history by ajax -->
                <div class="thumbnail">
		  <div class="alert alert-warning"><h3>Warranty History</h3></div>
		    <div id="history">
		    </div>
		</div>
<!-- ^history by ajax -->


            </div>

        </div>

    </div>

