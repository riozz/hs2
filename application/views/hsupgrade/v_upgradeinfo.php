 <?php 
    echo validation_errors(); 
    //echo json_encode($faultsinfo); 
    if ($upgradesinfo['id']>0) {
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
  echo form_open(base_url().'index.php/upgrades/change/'.$upgradesinfo['fullorder_id'], 'class="form-horizontal" id="upgradeForm"');
?>
<div class="thumbnail" id="upgradeinfo_content">
  <div class="caption-full">
    <div class="form-group" id="key">
      <label class="col-sm-2 control-label">Order ID</label>
      <label class="col-sm-4 control-label">
	<input class="form-control" type="text" value="<?php echo $upgradesinfo['fullorder_id'];?>" disabled></label>	
	<!-- display upgrade id -->
      <?php echo ($upgradesinfo['id']>0)?'<label class="col-sm-2 control-label">Upgrade ID</label><label class="col-sm-4 control-label"><input class="form-control" type="text" value="'.$upgradesinfo['id'].'" disabled></label>':'';
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
          <input class="form-control" id="disabledInput" type="text" name="staff_id" value="<?php echo ($qresult)?$upgradesinfo['staff_id']:$this->session->userdata('s_staffid'); ?>" placeholder="" readonly>
     	</div>
      	<label class="col-sm-2 control-label">Staff Name</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staff_name" value="<?php echo ($qresult)?$upgradesinfo['staff_name']:$this->session->userdata('s_name'); ?>" placeholder="" readonly>
      	</div>
      </div>
      <div class="form-group">
     	<label class="col-sm-2 control-label">Staff Team Code</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staff_teamcode" value="<?php echo ($qresult)?$upgradesinfo['staff_teamcode']:$this->session->userdata('s_teamcode'); ?>" placeholder="" readonly>
      	</div>
        <label class="col-sm-2 control-label">Channel</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staff_channel" value="<?php echo ($qresult)?$upgradesinfo['staff_channel']:$this->session->userdata('s_channel'); ?>" placeholder="" readonly>
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
	  <select class="form-control" id="u_model" name="u_model" sid="5" rid="5">
	    <?php echo "<option value='' ".(($upgradesinfo['u_model']==0)?'selected':'') .">Please select</option>";
	    foreach ($upgradesinfo['tab_model'] as $row) 
	    {
              echo "<option value='".$row['id']."' ".(($row['id']==$upgradesinfo['u_model'])?'selected':'') . ">".$row['model']."</option>";
	    }
	    ?>
	  </select>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Upgrade Router Quantity: </label>
        <div class="col-sm-5"> 
	  <input class="form-control" id="u_quantity" type="text" name="u_quantity" wid="5" rid="5" value="<?php echo $upgradesinfo['u_quantity']; ?>"> 
	</div>
        <label class="col-sm-5 control-label">&nbsp;&nbsp;</label>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Appointment Date/Time:</label>
        <div class="col-sm-6"> 
	  <input class="form-control" id="u_appointmentdate" type="text" name="u_appointmentdate" wid="5" rid="5" value="<?php echo $upgradesinfo['u_appointmentdate']; ?>"> 
	</div>
        <div class="col-sm-4"> 
	  <input class="form-control" id="u_appointmenttime" type="text" name="u_appointmenttime" wid="5" rid="5" value="<?php echo $upgradesinfo['u_appointmenttime']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Sales Memo Number:</label>
        <div class="col-sm-10"> 
	  <input class="form-control" id="u_smno" type="text" name="u_smno" wid="5" rid="5" value="<?php echo $upgradesinfo['u_smno']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Salesman Remark:</label>
        <div class="col-sm-10"> <textarea class="form-control" row="5" id="u_remark" name="u_remark"  wid="5" rid="5"><?php echo $upgradesinfo['u_remark']; ?></textarea></div>
      </div>

      <div class="form-group">
        <div class="col-sm-10">&nbsp;</div>
        <input type="hidden" name="id" value=<?php echo $upgradesinfo['id']; ?>>
        <input type="hidden" name="fullorder_id" value=<?php echo $upgradesinfo['fullorder_id']; ?>>
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
	  <input class="form-control" id="tc_staff_id" type="text" name="tc_staff_id" wid="5" rid="5" value="<?php echo $upgradesinfo['tc_staff_id']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tc_staff_name" type="text" name="tc_staff_name" wid="5" rid="5" value="<?php echo $upgradesinfo['tc_staff_name']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tc_staff_teamcode" type="text" name="tc_staff_teamcode" wid="5" rid="5" value="<?php echo $upgradesinfo['tc_staff_teamcode']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Channel:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tc_staff_channel" type="text" name="tc_staff_channel" wid="5" rid="5" value="<?php echo $upgradesinfo['tc_staff_channel']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Phone No.:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tc_staff_telno" type="text" name="tc_staff_telno" wid="5" rid="5" value="<?php echo $upgradesinfo['tc_staff_telno']; ?>"> 
	</div>
        <label class="col-sm-6 control-label">&nbsp;</label>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Appointment Date/Time:</label>
        <div class="col-sm-5"> 
	  <input class="form-control" id="tc_appointmentdate" type="text" name="tc_appointmentdate" wid="5" rid="5" value="<?php echo $upgradesinfo['tc_appointmentdate']; ?>"> 
	</div>
        <div class="col-sm-4"> 
	  <input class="form-control" id="tc_appointmenttime" type="text" name="tc_appointmenttime" wid="5" rid="5" value="<?php echo $upgradesinfo['tc_appointmenttime']; ?>"> 
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
        <input type="hidden" name="id" value=<?php echo $upgradesinfo['id']; ?>>
        <input type="hidden" name="fullorder_id" value=<?php echo $upgradesinfo['fullorder_id']; ?>>
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
	  <input class="form-control" id="com_date" type="text" name="com_date" wid="5" rid="5" value="<?php echo $upgradesinfo['com_date']; ?>"> 
	</div>
	<label class="col-sm-6 control-label">&nbsp;</label>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_id" type="text" name="com_staff_id" wid="5" rid="5" value="<?php echo $upgradesinfo['com_staff_id']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_name" type="text" name="com_staff_name" wid="5" rid="5" value="<?php echo $upgradesinfo['com_staff_name']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_teamcode" type="text" name="com_staff_teamcode" wid="5" rid="5" value="<?php echo $upgradesinfo['com_staff_teamcode']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Channel:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_channel" type="text" name="com_staff_channel" wid="5" rid="5" value="<?php echo $upgradesinfo['com_staff_channel']; ?>"> 
	</div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">TC Remark:</label>
        <div class="col-sm-9"> <textarea class="form-control" row="5" id="com_remark" name="com_remark"  wid="5" rid="5"><?php echo $upgradesinfo['com_remark']; ?></textarea></div>
      </div>
      <div class="form-group">
        <div class="col-sm-10">&nbsp;</div>
        <input type="hidden" name="id" value=<?php echo $upgradesinfo['id']; ?>>
        <input type="hidden" name="fullorder_id" value=<?php echo $upgradesinfo['fullorder_id']; ?>>
        <input type="hidden" name="action" value="complete">
        <div class="col-sm-2"><button type="submit" class="btn btn-info" action="complete" id="upgradeComplete">Complete</button>
	</div>
      </div>
  </div>

</div>
</form>
