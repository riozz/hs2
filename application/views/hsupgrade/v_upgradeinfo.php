 <?php 
    echo validation_errors(); 
    //echo json_encode($faultsinfo); 
    if ($upgradesinfo['upgradeid']>0) {
      $qresult=true;
    } else {
      $qresult=false;
    }
 ?>
<script src="<?php echo base_url("js/jquery.min.js"); ?>"></script>
<script src="<?php echo base_url("js/jquery.validate.min.js"); ?>"></script>

<script>
  /*
  jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });
  */
  function showCustomAttr(attr) {
    var x = document.forms[0];
    alert("x = "+ x);
    var i;
    var txt = "";
    for (i=0; i< x.length; i++) {
      //txt = txt + x[i].id + ";";
      txt = txt + x[i].getAttribute("uid") + ";";
      alert("txt = "+txt);
    } 
    var s = document.getElementById("c_email");
    //alert("s = "+s);
    var cattr = s.getAttribute("uid");
    alert("uid = "+ cattr);
    s.setAttribute("readonly", true);
    //alert("wid = "+attr.innerHTML + " is a " + cattr + ".");
  };

  $(document).ready(function() {
    $('#upgradeForm').validate({
      rules: {
	/*
	c_name: { 
	  required: true,
	  minlength: 5
	},
	c_certtype: {
	  required: true
	},
	c_certno: {
	  required: true,
	  minlength: 3
	},
	c_contact: {
	  required: true,
	  digits: true
	},
	c_ndcontact: {
	  required: false,
	  digits: true
	},
	c_officetel: {
	  required: false,
	  digits: true
	},
        c_email: {
          required: true,
          email: true
        },
	f_faulttoid: {
	  required: true
	},
	f_transfertoid: {
	  required: true
	},
	f_symptomid: {
	  required: true
	},
	f_itemtypeid: {
	  required: true
	},
	f_model: {
	  required: true,
	  minlength: 3
	},
	f_quantity: {
	  required: true,
	  digits: true
	},
	f_serial: {
	  required: true,
	  minlength: 3
	},
	f_transfertoid: {
	  required: true
	},
	*/
	appointment: {
	  //var rurl = <?php echo base_url(); ?>+"index.php/faults/check_appointmentquota/"+document.getElementById("appointment").value;
	  required: true,
	  remote: {
	    url: "<?php echo base_url(); ?>"+"index.php/upgrades/check_appointmentquota/8",
	    type: "post",
	    data: {
	      o_appointment: function() {
		return $("#f_o_appointmentid").val();
	      }
	    }
	  }
	},
	f_details: {
	  required: true,
	  minlength: 3
	}
      }
    });

/*
    var id = document.getElementById("appointment_msg").id;
    showErrMsg(id,''); 

    $('#faultSubmit').click(function() {
      var appointmentid = document.getElementById("appointment").value;
      var id = document.getElementById("appointment_msg").id;
      if (appointmentid>0) {
        //alert("appointmentid="+appointmentid);
	$.get("<?php echo base_url(); ?>"+ "index.php/faults/check_appointmentquota/"+appointmentid, function(data, status) {
	  //alert("data="+data);
	  if (data <= 0) {
	    showErrMsg(id, "Please select / Quota Full");
	    //windows.location.hash = '#appointment';
	  } 
	});
      } else {
	showErrMsg(id, "Please select / Quota Full");
	//windows.location.hash = '#appointment';
      }
      //return false;
    });
*/
/*
    $('#faultSubmit').click(function() {
      showCustomAttr(this);
    });
*/ 
/*
    $('#faultForm').submit(function(e) {
      var submiturl = "<?php echo base_url(); ?>" + "index.php/faults/change/" + "<?php echo $upgradesinfo['orderid'] ?>";
      e.preventDefault();
      $.ajax({
        url: submiturl,
	type: 'POST',
	data: $(this).serialize()
      })
      .done(function(data) {
	$('#faultForm').fadeOut('slow', function() {
	  $('#faultForm').fadeIn('slow').html(data);
	});
      })
      .fail(function() {
	alert('Data Submission Failed');
      });
    }); 
*/
  });

  function showErrMsg(id, errmsg) {
    var s = document.getElementById(id);
    //alert("id="+id);
    s.innerHTML = errmsg;
    //$('#appointment_msg').text(errmsg);
    //$('#appointment_msg').css('color', 'red');
  }
</script>
<?php 
  echo form_open(base_url().'index.php/upgrades/change/'.$upgradesinfo['orderid'], 'class="form-horizontal" id="upgradeForm"');
?>
<div class="thumbnail" id="upgradeinfo_content">
  <div class="caption-full">
    <div class="form-group" id="key">
      <label class="col-sm-2 control-label">Order ID</label>
      <label class="col-sm-4 control-label">
	<input class="form-control" type="text" value="<?php echo $upgradesinfo['orderid'];?>" disabled></label>
      <?php echo ($upgradesinfo['upgradeid']>0)?'<label class="col-sm-2 control-label">Upgrade ID</label><label class="col-sm-4 control-label"><input class="form-control" type="text" value="'.$upgradesinfo['upgradeid'].'" disabled></label>':'';
      ?>
    </div>
  </div>
</div>
<div class="thumbnail" id="upgradeinfo_content">
  <div class="caption-full">
    <h4>Part I: Staff Profile </h4><br/>
      <div class="form-group" id="part1">
     	<label class="col-sm-2 control-label">Staff Number</label>
      	<div class="col-sm-4">
          <input class="form-control" id="disabledInput" type="text" name="staffid" value="<?php echo ($qresult)?$upgradesinfo['staffid']:$this->session->userdata('s_staffid'); ?>" placeholder="" readonly>
     	</div>
      	<label class="col-sm-2 control-label">Staff Name</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffname" value="<?php echo ($qresult)?$upgradesinfo['staffname']:$this->session->userdata('s_name'); ?>" placeholder="" readonly>
      	</div>
      </div>
      <div class="form-group">
     	<label class="col-sm-2 control-label">Staff Team Code</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffteamcode" value="<?php echo ($qresult)?$upgradesinfo['staffteamcode']:$this->session->userdata('s_teamcode'); ?>" placeholder="" readonly>
      	</div>
        <label class="col-sm-2 control-label">Channel</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffchannel" value="<?php echo ($qresult)?$upgradesinfo['staffchannel']:$this->session->userdata('s_channel'); ?>" placeholder="" readonly>
      	</div>
      </div>
  </div>
</div>

<!--
<div class="thumbnail">
  <div class="caption-full">
    <h4>Part II: Customer information </h4><br/>

//-->

<!---Part II -->
  <div class="thumbnail">
    <div class="caption-full">
      <h4>Part II: Smart Living Upgrade Item</h4><br/>
      <div class="form-group">
        <label class="col-sm-2 control-label">Upgrade Router Model: </label>
        <div class="col-sm-10 dropdown"> 
	  <select class="form-control" id="umodel" name="umodel" sid="5" rid="5">
	    <?php echo "<option value='' ".(($upgradesinfo['umodelid']==0)?'selected':'') .">Please select</option>";
	    foreach ($upgradesinfo['tab_model'] as $row) 
	    {
              echo "<option value='".$row['id']."' ".(($row['id']==$upgradesinfo['umodelid'])?'selected':'') . ">".$row['model']."</option>";
	    }
	    ?>
	  </select>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Upgrade Router Quantity: </label>
        <div class="col-sm-5"> 
	  <input class="form-control" id="uquantity" type="text" name="uquantity" wid="5" rid="5" value="<?php echo $upgradesinfo['uquantity']; ?>"> 
	</div>
        <label class="col-sm-5 control-label">&nbsp;&nbsp;</label>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Appointment Date/Time:</label>
        <div class="col-sm-6"> 
	  <input class="form-control" id="udate" type="text" name="udate" wid="5" rid="5" value="<?php echo $upgradesinfo['udate']; ?>"> 
	</div>
        <div class="col-sm-4"> 
	  <input class="form-control" id="utime" type="text" name="utime" wid="5" rid="5" value="<?php echo $upgradesinfo['utime']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Sales Memo Number:</label>
        <div class="col-sm-10"> 
	  <input class="form-control" id="usmno" type="text" name="usmno" wid="5" rid="5" value="<?php echo $upgradesinfo['usmno']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Salesman Remark:</label>
        <div class="col-sm-10"> <textarea class="form-control" row="5" id="uremark" name="uremark"  wid="5" rid="5"><?php echo $upgradesinfo['uremark']; ?></textarea></div>
      </div>

      <div class="form-group">
        <div class="col-sm-10">&nbsp;</div>
        <input type="hidden" name="upgradeid" value=<?php echo $upgradesinfo['upgradeid']; ?>>
        <input type="hidden" name="orderid" value=<?php echo $upgradesinfo['orderid']; ?>>
        <input type="hidden" name="action" value="addupgrade">
        <div class="col-sm-2"><button type="submit" class="btn btn-info" action="addupgrade" id="upgradeSubmit">Submit</button>
        </div>
      </div>

  </div>
</div>

<!---Part III -->
  <div class="thumbnail">
    <div class="caption-full">
      <h4>Part III: Technical Consultant Assignment</h4><br/>
      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tcstaffid" type="text" name="tcstaffid" wid="5" rid="5" value="<?php echo $upgradesinfo['tcstaffid']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tcname" type="text" name="tcname" wid="5" rid="5" value="<?php echo $upgradesinfo['tcname']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tcteamcode" type="text" name="tcteamcode" wid="5" rid="5" value="<?php echo $upgradesinfo['tcteamcode']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Channel:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tcchannel" type="text" name="tcchannel" wid="5" rid="5" value="<?php echo $upgradesinfo['tcchannel']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Phone No.:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tctelno" type="text" name="tctelno" wid="5" rid="5" value="<?php echo $upgradesinfo['tctelno']; ?>"> 
	</div>
        <label class="col-sm-6 control-label">&nbsp;</label>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Appointment Date/Time:</label>
        <div class="col-sm-5"> 
	  <input class="form-control" id="udate" type="text" name="udate" wid="5" rid="5" value="<?php echo $upgradesinfo['udate']; ?>"> 
	</div>
        <div class="col-sm-4"> 
	  <input class="form-control" id="utime" type="text" name="utime" wid="5" rid="5" value="<?php echo $upgradesinfo['utime']; ?>"> 
	<!--
	  <select class="form-control" id="tctime" name="tctime" sid="5" rid="5">
	  <option value="0900">0900</option>
	  <option value="1000">1000</option>
	  <option value="1100">1100</option>
	  <option value="1200">1200</option>
	  <option value="1300">1300</option>
	  <option value="1400">1400</option>
	  <option value="1500">1500</option>
	  <option value="1600">1600</option>
	  <option value="1700">1700</option>
	  <option value="1800">1800</option>
	  <option value="1900">1900</option>
	  <option value="2000">2000</option>
	  </select>
	//-->
	</div>
      </div>

      <div class="form-group">
        <div class="col-sm-10">&nbsp;</div>
        <input type="hidden" name="upgradeid" value=<?php echo $upgradesinfo['upgradeid']; ?>>
        <input type="hidden" name="orderid" value=<?php echo $upgradesinfo['orderid']; ?>>
        <input type="hidden" name="action" value="assign">
        <div class="col-sm-2"><button type="submit" class="btn btn-info" action="assign" id="upgradeAssign">Assign</button>
	</div>
      </div>
    </div>
  </div>

<!---Part IV -->
  <div class="thumbnail">
    <div class="caption-full">
      <h4>Part IV: Technical Consultant Task Completion</h4><br/>
      <div class="form-group">
        <label class="col-sm-3 control-label">Completion Date:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="completeddate" type="text" name="completeddate" wid="5" rid="5" value="<?php echo $upgradesinfo['completeddate']; ?>"> 
	</div>
	<label class="col-sm-6 control-label">&nbsp;</label>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="comstaffid" type="text" name="comstaffid" wid="5" rid="5" value="<?php echo $upgradesinfo['comstaffid']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="comname" type="text" name="comname" wid="5" rid="5" value="<?php echo $upgradesinfo['comname']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="comteamcode" type="text" name="comteamcode" wid="5" rid="5" value="<?php echo $upgradesinfo['comteamcode']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Channel:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="comchannel" type="text" name="comchannel" wid="5" rid="5" value="<?php echo $upgradesinfo['comchannel']; ?>"> 
	</div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">TC Remark:</label>
        <div class="col-sm-9"> <textarea class="form-control" row="5" id="uremark" name="uremark"  wid="5" rid="5"><?php echo $upgradesinfo['uremark']; ?></textarea></div>
      </div>
      <div class="form-group">
        <div class="col-sm-10">&nbsp;</div>
        <input type="hidden" name="upgradeid" value=<?php echo $upgradesinfo['upgradeid']; ?>>
        <input type="hidden" name="orderid" value=<?php echo $upgradesinfo['orderid']; ?>>
        <input type="hidden" name="action" value="complete">
        <div class="col-sm-2"><button type="submit" class="btn btn-info" action="complete" id="upgradeComplete">Complete</button>
	</div>
      </div>
  </div>

</div>
</form>
