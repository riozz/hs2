    <!-- Page Content -->
       <!-- menu in header.php -->

            <div class="col-md-9">
	   	<div class="row">
    		  <div class="alert alert-info"><h3>Upgrade Management &nbsp;&nbsp;&nbsp
      		  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#upgradeinfo">Upgrade Info</button></h3>&nbsp;&nbsp;&nbsp;
      		  <!--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#upgradeinfo">Upgrade Info</button>&nbsp;&nbsp;&nbsp;
      		  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#tcassignmentinfo">TC Assignment Info</button>&nbsp;&nbsp;&nbsp;
      		  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#tccompletioninfo">TC Completion Info</button>-->
    		</div>


<!--
  	      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
//  -->
              <script src="<?php echo base_url("js/jquery.min.js"); ?>"></script>
              <script src="<?php echo base_url("js/jquery.validate.min.js"); ?>"></script>
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
	        var uiid = <?php echo $upgradeid ?>; 
		<?php
		  //get the warrantyid after update action
		  if (isset($result)) {
		    $actionupgradeid = $result['upgradeid'];
		    $actionmsg = $result['msg'];	
		  } else {
		    $actionupgradeid = 0;
		    $actionmsg = '';
		  }
		?>
		//var url = "faults/"+<?php echo $orderid; ?>;
		//get fault history
		//var wurl = "/dev/hs2/index.php/upgrades/index/" + "<?php echo '/'.$orderid; ?>";
		//var wiurl = "/dev/hs2/index.php/upgrades/view/" + "<?php echo $orderid; ?>/<?php echo $upgradeid; ?>";
		//get warranty history of orderid and action upgradeid
		//var wurl = "<?php echo base_url(); ?>" + "index.php/upgrades/index/" + "<?php echo '/'.$orderid; ?>";
		var actionmsg = "<?php echo $actionmsg; ?>";
		var uurl = "<?php echo base_url(); ?>" + "index.php/upgrades/index/" + "<?php echo '/'.$orderid; ?>/<?php echo $actionupgradeid; ?>";
		//get fault detail of orderid
		var uiurl = "<?php echo base_url(); ?>" + "index.php/upgrades/view/" + "<?php echo $orderid; ?>/<?php echo $upgradeid; ?>";
		//get fault detail
		alert ("uurl="+uurl);	
		alert ("uiurl="+uiurl);	
		$(document).ready(function(){
		    //alert("<?php echo "orderid=".$orderid; ?>");
		    //alert("href = "+window.location.href);
		    //alert("hrefpath = "+window.location.pathname);
		    //alert("url = "+wurl);
		    //alert ("wiurl="+wiurl);	

		    $('#history').html("<b><center>Loading ... </center></b>");
	 	    $.ajax({
		      type:'POST',
		      //url: 'faults',
		      url: uurl,
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
		    //upgradeinfo area
		    $('#upgradeinfo').html("<b><center>Loading ... </center></b>");
		    $.ajax({
		      type:'POST',
		      url: uiurl,
		      data: $(this).serialize()
		    })
		    .done(function(data) {
		      $('#upgradeinfo').html(data);
		    })
		    .fail(function() {
		      alert(" Loading error. ");
		    });
		    if (actionmsg.length>0) {
		      $("#actionmsg").collapse('show');
		      $("#upgradeinfo").collapse('hide');
		    }
		    return false;	
		});
	      </script>

<!-- upgrade info by ajax -->
		<div class="thumbnail" id="upgradeinfoarea">
		  <div class="caption-full"></div>
		    <div class="collapse in" id="upgradeinfo">
		    </div>
	 	</div>	
<!-- ^upgrade info by ajax -->
		 
<!-- action message -->
                <div class="collapse" id="actionmsg">
		  <div class="alert alert-success">
		    <label><center><?php echo "System Message: ".$actionmsg; ?></center></label>
		  </div>
		</div>
<!-- ^action message -->
 
<!-- history by ajax -->
                <div class="thumbnail">
		  <div class="alert alert-warning"><h3>Upgrade History</h3></div>
		    <div id="history">
		    </div>
		</div>
<!-- ^history by ajax -->

<!-- 
		<div class="thumbnail">
	      <?php
	         echo 'zzz[index]94:'.$result['upgradeid'];
	      ?>
		</div>
// -->

            </div>

        </div>

    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("js/bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("js/bootstrap-table.js"); ?>"></script>

