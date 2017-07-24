 <?php 
    echo validation_errors(); 
    //echo json_encode($faultsinfo); 
    if ($warrantysinfo['warrantyid']>0) {
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
      txt = txt + x[i].getAttribute("wid") + ";";
      alert("txt = "+txt);
    } 
    var s = document.getElementById("c_email");
    //alert("s = "+s);
    var cattr = s.getAttribute("wid");
    alert("wid = "+ cattr);
    s.setAttribute("readonly", true);
    //alert("wid = "+attr.innerHTML + " is a " + cattr + ".");
  };

  $(document).ready(function() {
    $('#warrantyForm').validate({
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
	    url: "<?php echo base_url(); ?>"+"index.php/warrantys/check_appointmentquota/8",
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
      var submiturl = "<?php echo base_url(); ?>" + "index.php/faults/change/" + "<?php echo $faultsinfo['orderid'] ?>";
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
  echo form_open(base_url().'index.php/warrantys/change/'.$warrantysinfo['orderid'], 'class="form-horizontal" id="warrantyForm"');
?>
<div class="thumbnail" id="warrantyinfo_content">
  <div class="caption-full">
    <div class="form-group" id="key">
      <label class="col-sm-2 control-label">Order ID</label>
      <label class="col-sm-4 control-label">
	<input class="form-control" type="text" value="<?php echo $warrantysinfo['orderid'];?>" disabled></label>
      <?php echo ($warrantysinfo['warrantyid']>0)?'<label class="col-sm-2 control-label">Warranty ID</label><label class="col-sm-4 control-label"><input class="form-control" type="text" value="'.$warrantysinfo['warrantyid'].'" disabled></label>':'';
      ?>
    </div>
  </div>
</div>
<div class="thumbnail" id="warrantyinfo_content">
  <div class="caption-full">
    <h4>Part I: Staff Profile </h4><br/>
      <div class="form-group" id="part1">
     	<label class="col-sm-2 control-label">Staff Number</label>
      	<div class="col-sm-4">
          <input class="form-control" id="disabledInput" type="text" name="staffid" value="<?php echo ($qresult)?$warrantysinfo['staffid']:$this->session->userdata('s_staffid'); ?>" placeholder="" readonly>
     	</div>
      	<label class="col-sm-2 control-label">Staff Name</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffname" value="<?php echo ($qresult)?$warrantysinfo['staffname']:$this->session->userdata('s_name'); ?>" placeholder="" readonly>
      	</div>
      </div>
      <div class="form-group">
     	<label class="col-sm-2 control-label">Staff Team Code</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffteamcode" value="<?php echo ($qresult)?$warrantysinfo['staffteamcode']:$this->session->userdata('s_teamcode'); ?>" placeholder="" readonly>
      	</div>
        <label class="col-sm-2 control-label">Channel</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffchannel" value="<?php echo ($qresult)?$warrantysinfo['staffchannel']:$this->session->userdata('s_channel'); ?>" placeholder="" readonly>
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
      <h4>Part II: Smart Living Warranty Checking List</h4><br/>
      <div class="form-group">
        <label class="col-sm-2 control-label">Maintenance Category: </label>
        <div class="col-sm-5 dropdown"> 
	  <select class="form-control" id="category" name="category" sid="5" rid="5">
	    <?php echo "<option value='' ".(($warrantysinfo['wcategoryid']==0)?'selected':'') .">Please select</option>";
	    foreach ($warrantysinfo['tab_category'] as $row) 
	    {
              echo "<option value='".$row['id']."' ".(($row['id']==$warrantysinfo['wcategoryid'])?'selected':'') . ">".$row['category']."</option>";
	    }
	    ?>
	  </select>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Warranty Package: </label>
        <div class="col-sm-5 dropdown"> 
	  <select class="form-control" id="package" name="package" sid="5" rid="5">
	    <?php echo "<option value='' ".(($warrantysinfo['wpackageid']==0)?'selected':'') .">Please select</option>";
	    foreach ($warrantysinfo['tab_package'] as $row) 
	    {
              echo "<option value='".$row['id']."' ".(($row['id']==$warrantysinfo['wpackageid'])?'selected':'') . ">".$row['package']."</option>";
	    }
	    ?>
	  </select>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Extra offer:</label>
        <div class="col-sm-6"> 
	  <input class="form-control" id="woffer" type="text" name="woffer" wid="5" rid="5" value="<?php echo $warrantysinfo['woffer']; ?>"> </div>
        <label class="col-sm-4 control-label"># (Please Contact Marketing)</label>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Sales Memo Number:</label>
        <div class="col-sm-10"> 
	  <input class="form-control" id="wsmno" type="text" name="wsmno" wid="5" rid="5" value="<?php echo $warrantysinfo['wsmno']; ?>"> </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Effective Date:</label>
        <div class="col-sm-10"> 
	  <input class="form-control" id="weffdate" type="text" name="weffdate" wid="5" rid="5" value="<?php echo $warrantysinfo['weffdate']; ?>"> #Only opened for CS/TS or TC.<br/>#If not selectd, effective date will follow the TC completion date of selected category / the end date of last row record added.
	</div>
      </div>
      <div class="form-group">
        <div class="col-sm-10">&nbsp;</div>
        <input type="hidden" name="warrantyid" value=<?php echo $warrantysinfo['warrantyid']; ?>>
        <input type="hidden" name="orderid" value=<?php echo $warrantysinfo['orderid']; ?>>
        <input type="hidden" name="action" value="addwarranty">
        <div class="col-sm-2"><button type="submit" class="btn btn-info" action="addwarranty" id="warrantySubmit">Submit</button>
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
	  <input class="form-control" id="tcstaffid" type="text" name="tcstaffid" wid="5" rid="5" value="<?php echo $warrantysinfo['tcstaffid']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tcname" type="text" name="tcname" wid="5" rid="5" value="<?php echo $warrantysinfo['tcname']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tcteamcode" type="text" name="tcteamcode" wid="5" rid="5" value="<?php echo $warrantysinfo['tcteamcode']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Channel:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tcchannel" type="text" name="tcchannel" wid="5" rid="5" value="<?php echo $warrantysinfo['tcchannel']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Phone No.:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tctelno" type="text" name="tctelno" wid="5" rid="5" value="<?php echo $warrantysinfo['tctelno']; ?>"> 
	</div>
        <label class="col-sm-6 control-label">&nbsp;</label>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Appointment Date/Time:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tcdate" type="text" name="tcdate" wid="5" rid="5" value="<?php echo $warrantysinfo['tcdate']; ?>"> 
	</div>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tctime" type="text" name="tctime" wid="5" rid="5" value="<?php echo $warrantysinfo['tctime']; ?>"> 
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
        <label class="col-sm-3 control-label">&nbsp;</label>
      </div>

      <div class="form-group">
        <div class="col-sm-10">&nbsp;</div>
        <input type="hidden" name="warrantyid" value=<?php echo $warrantysinfo['warrantyid']; ?>>
        <input type="hidden" name="orderid" value=<?php echo $warrantysinfo['orderid']; ?>>
        <input type="hidden" name="action" value="assign">
        <div class="col-sm-2"><button type="submit" class="btn btn-info" action="assign" id="warrantyAssign">Assign</button>
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
	  <input class="form-control" id="completeddate" type="text" name="completeddate" wid="5" rid="5" value="<?php echo $warrantysinfo['completeddate']; ?>"> 
	</div>
	<label class="col-sm-6 control-label">&nbsp;</label>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="comstaffid" type="text" name="comstaffid" wid="5" rid="5" value="<?php echo $warrantysinfo['comstaffid']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="comname" type="text" name="comname" wid="5" rid="5" value="<?php echo $warrantysinfo['comname']; ?>"> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="comteamcode" type="text" name="comteamcode" wid="5" rid="5" value="<?php echo $warrantysinfo['comteamcode']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Channel:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="comchannel" type="text" name="comchannel" wid="5" rid="5" value="<?php echo $warrantysinfo['comchannel']; ?>"> 
	</div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">TC Remark:</label>
        <div class="col-sm-10"> <textarea class="form-control" row="5" id="comremark" name="comremark"  wid="5" rid="5"><?php echo $warrantysinfo['comremark']; ?></textarea></div>
      </div>
      <div class="form-group">
        <div class="col-sm-10">&nbsp;</div>
        <input type="hidden" name="warrantyid" value=<?php echo $warrantysinfo['warrantyid']; ?>>
        <input type="hidden" name="orderid" value=<?php echo $warrantysinfo['orderid']; ?>>
        <input type="hidden" name="action" value="complete">
        <div class="col-sm-2"><button type="submit" class="btn btn-info" action="complete" id="warrantyComplete">Complete</button>
	</div>
      </div>
  </div>

</div>
</form>
