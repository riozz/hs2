    <!-- Page Content -->
       <!-- menu in header.php -->

            <div class="col-md-9">
	   	<div class="row">
    			<div class="alert alert-info">
			<h3>
			<form action='<?php echo HS_V1.'/mainpage.php'; ?>' method='post'><input type='hidden' name='actions' value='V'><input type='hidden' name='order_id' value='<?php echo $orderid; ?>'>
			  <button type='submit' class='btn-info btn-lg'>
			    <span class="glyphicon glyphicon-arrow-left"></span>
			  </button>
			</form>

			&nbsp;Fault Management&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type="button" class="btn-info btn-lg glyphicon glyphicon-collapse-up" id="infotoggle" data-toggle="collapse" data-target="#faultinfo">&nbsp;Fault Detail</button>
			</h3>
			</div>
		</div>

<!--
  	      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
//  -->
              <script src="<?php echo base_url("js/jquery.min.js"); ?>"></script>
              <script src="<?php echo base_url("js/jquery.validate.min.js"); ?>"></script>
              <script type="text/javascript" charset="UTF-8" src="<?php echo base_url("js/bootstrap-datetimepicker.js"); ?>"></script>
              <script src="<?php echo base_url("js/bootstrap.min.js"); ?>"></script>

		<!--	
	      <script>
		/*
	        $.validator.setDefaults({
		  debug:true,
		  submitHandler: function() {
		    alert("submitted!");
		  }
		});
	      </script>
		// -->
	      <script>
	        var fiid = <?php echo $faultid ?>; 
		<?php
		  //get the faultid after update action
		  if (isset($result)) {
		    $actionfaultid = $result['faultid'];
		    $actionmsg = $result['msg'];	
		  } else {
		    $actionfaultid = 0;
		    $actionmsg = '';
		  }
		?>
		//var url = "faults/"+<?php echo $orderid; ?>;
		//get fault history
		//var furl = "/dev/hs2/index.php/faults/index/" + "<?php echo '/'.$orderid; ?>";
		//var fiurl = "/dev/hs2/index.php/faults/view/" + "<?php echo $orderid; ?>/<?php echo $faultid; ?>";
		//get fault history of orderid and action faultid
		//var furl = "<?php echo base_url(); ?>" + "index.php/faults/index/" + "<?php echo '/'.$orderid; ?>";
		var actionmsg = "<?php echo $actionmsg; ?>";
		var furl = "<?php echo base_url(); ?>" + "index.php/faults/index/" + "<?php echo '/'.$orderid; ?>/<?php echo $actionfaultid; ?>";
		//get fault detail of orderid
		var fiurl = "<?php echo base_url(); ?>" + "index.php/faults/view/" + "<?php echo $orderid; ?>/<?php echo $faultid; ?>";
		//get fault detail
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
		    if (actionmsg.length>0) {
		      $("#actionmsg").collapse('show');
		      $("#faultinfo").collapse('hide');
		      //$("#infotoggle").toggleClass('glyphicon-circle-arrow-up').toggleClass('glyphicon-circle-arrow-down');
		      $("#infotoggle").toggleClass('glyphicon-collapse-up').toggleClass('glyphicon-collapse-down');
		    }
		    return false;	
		});

		$('#infotoggle').click(function() {
		  $(this).toggleClass('glyphicon-collapse-up').toggleClass('glyphicon-collapse-down');
		});
	      </script>

<!-- fault info by ajax -->
		<div class="thumbnail" id="faultinfoarea">
		  <div class="caption-full"></div>
		    <div class="collapse in" id="faultinfo">
		    </div>
	 	</div>	
<!-- ^fault info by ajax -->
		 
<!-- action message -->
                <div class="collapse" id="actionmsg">
		  <div class="alert alert-success">
		    <label><center><?php echo "System Message: ".$actionmsg; ?></center></label>
		  </div>
		</div>
<!-- ^action message -->
 
<!-- history by ajax -->
                <div class="thumbnail">
		  <div class="alert alert-warning"><h3>Fault History</h3></div>
		    <div id="history">
		    </div>
		</div>
<!-- ^history by ajax -->

<!-- 
		<div class="thumbnail">
	      <?php
	         echo 'zzz[index]94:'.$result['faultid'];
	      ?>
		</div>
// -->

            </div>

        </div>

    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("js/bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("js/bootstrap-table.js"); ?>"></script>

