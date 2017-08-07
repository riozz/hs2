 <?php 
    echo validation_errors(); 
    //echo json_encode($faultsinfo); 
    if ($warrantysinfo['id']>0) { //warrantyid
      $qresult=true;
    } else {
      $qresult=false;
    }
 ?>
<script src="<?php echo base_url("js/jquery.min.js"); ?>"></script>
<script src="<?php echo base_url("js/jquery.validate.min.js"); ?>"></script>
<script src="<?php echo base_url("js/bootstrap.min.js"); ?>"></script>
<script type="text/javascript" charset="UTF-8" src="<?php echo base_url("js/bootstrap-datetimepicker.js"); ?>"></script>


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
  
  function getstaffinfo(str, vform) {
    alert("str = "+str+" vform="+vform);
    if (str == "") {
      return;
    } else {
      xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById(vform).innerHTML = this.responseText;
	}
      };
      xmlhttp.open("GET","warrantys/get_staffinfo/"+str+"/"+vform,true);
      xmlhttp.send();
    }
  };

  $(document).ready(function() {
    $('#warrantyForm').validate({
      rules: {
	w_category: {
	  required: true
	},
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
	tc_staff_name: {
	  required: true,
	  minlength: 6
	},
	/*
	tc_staff_id: {
	  required: true,
	  minlength: 6,
	  remote: {
	    url: "<?php echo base_url(); ?>"+"index.php/warrantys/get_staffinfo/1",
	    type: "post",
	    data: {
	      tc_staff_id: function() {
		return $("#tc_staff_name").val();
	      }
	    }
	  }
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
	w_package: {
	  required: true
	},
	w_offer: {
	  required: true
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
      var submiturl = "<?php echo base_url(); ?>" + "index.php/faults/change/" + "<?php echo $warrantysinfo['orderid'] ?>";
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
  echo form_open(base_url().'index.php/warrantys/change/'.$warrantysinfo['fullorder_id'], 'class="form-horizontal" id="warrantyForm"');
?>
<div class="thumbnail" >
  <div class="caption-full">
    <div class="form-group" id="key">
      <label class="col-sm-2 control-label">Order ID</label>
      <label class="col-sm-4 control-label">
	<input class="form-control" type="text" value="<?php echo $warrantysinfo['orderid'];?>" disabled></label>
      <?php echo ($warrantysinfo['id']>0)?'<label class="col-sm-2 control-label">Warranty ID</label><label class="col-sm-4 control-label"><input class="form-control" type="text" value="'.$warrantysinfo['id'].'" disabled></label>':'';
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
          <input class="form-control" id="disabledInput" type="text" name="staff_id" value="<?php echo ($qresult)?$warrantysinfo['staff_id']:$this->session->userdata('s_staffid'); ?>" placeholder="" readonly>
     	</div>
      	<label class="col-sm-2 control-label">Staff Name</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staff_name" value="<?php echo ($qresult)?$warrantysinfo['staff_name']:$this->session->userdata('s_name'); ?>" placeholder="" readonly>
      	</div>
      </div>
      <div class="form-group">
     	<label class="col-sm-2 control-label">Staff Team Code</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staff_teamcode" value="<?php echo ($qresult)?$warrantysinfo['staff_teamcode']:$this->session->userdata('s_teamcode'); ?>" placeholder="" readonly>
      	</div>
        <label class="col-sm-2 control-label">Channel</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staff_channel" value="<?php echo ($qresult)?$warrantysinfo['staff_channel']:$this->session->userdata('s_channel'); ?>" placeholder="" readonly>
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
	  <select class="form-control" id="w_category" name="w_category" sid="5" rid="5">
	  <?php echo "<option value='' ".(($warrantysinfo['w_category']==0)?'selected':'') .">Please select</option>";
	  foreach ($warrantysinfo['tab_category'] as $row) 
	  {
            echo "<option value='".$row['id']."' ".(($row['id']==$warrantysinfo['w_category'])?'selected':'') . ">".$row['category']."</option>";
	  }
	  ?>
	 </select>
       </div>
     </div>

     <div class="form-group">
       <label class="col-sm-2 control-label">Warranty Package: </label>
       <div class="col-sm-5 dropdown"> 
	  <select class="form-control" id="w_package" name="w_package" sid="5" rid="5">
          <?php echo "<option value='' ".(($warrantysinfo['w_package']==0)?'selected':'') .">Please select</option>";
	    foreach ($warrantysinfo['tab_package'] as $row) 
	    {
              echo "<option value='".$row['id']."' ".(($row['id']==$warrantysinfo['w_package'])?'selected':'') . ">".$row['package']."</option>";
	    }
	  ?>
	  </select>
        </div>
     </div>

     <div class="form-group">
       <label class="col-sm-2 control-label">Extra offer:</label>
       <div class="col-sm-6"> 
         <input class="form-control" id="w_offer" type="text" name="w_offer" wid="5" rid="5" value="<?php echo $warrantysinfo['w_offer']; ?>"> 
       </div>
         <label class="col-sm-4 control-label"># (Please Contact Marketing)</label>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Sales Memo Number:</label>
        <div class="col-sm-10"> 
	  <input class="form-control" id="w_smno" type="text" name="w_smno" wid="5" rid="5" value="<?php echo $warrantysinfo['w_smno']; ?>"> </div>
      </div>

      <div class="form-group">
        <label for="dtp_input1" class="col-md-2 control-label">Effective Date:</label>
        <div class="input-group date form_datetime col-md-8" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
          <input class="form-control" id="w_effdate" size="10" type="text" name="w_effdate" wid="5" rid="5" value="<?php echo $warrantysinfo['w_effdate']; ?>" readonly>
          <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        <input type="hidden" id="dtp_input1" value="" /><br/>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10"> 
	  #Only opened for CS/TS or TC.<br/>#If not selectd, effective date will follow the TC completion date of selected category / the end date of last row record added.
	</div>
      </div>

<!--
      <div class="form-group">
        <label class="col-sm-2 control-label">Effective Date:</label>
        <div class="col-sm-10"> 
	  <input class="form-control" id="w_effdate" type="text" name="w_effdate" wid="5" rid="5" value="<?php echo $warrantysinfo['w_effdate']; ?>"> #Only opened for CS/TS or TC.<br/>#If not selectd, effective date will follow the TC completion date of selected category / the end date of last row record added.
	</div>
      </div>
//-->

      <div class="form-group">
        <div class="col-sm-10">&nbsp;</div>
        <input type="hidden" name="id" value=<?php echo $warrantysinfo['id']; ?>>
        <input type="hidden" name="fullorder_id" value=<?php echo $warrantysinfo['fullorder_id']; ?>>
        <input type="hidden" name="action" value="addwarranty">
        <div class="col-sm-2"><button type="submit" class="btn btn-info" action="addwarranty" id="warrantySubmit">Submit</button>
	</div>
      </div>
  </div>
</div>

<!---Part III -->
<div class="thumbnail" id="tc_assignment_info">
  <div class="caption-full">
    <h4>Part III: Technical Consultant Assignment</h4><br/>
    <div id="v_warrantyAssignment">
     <div class="form-group">
       <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
       <div class="col-sm-3"> 
         <input class="form-control" id="tc_staff_id" type="text" name="tc_staff_id" onchange="getstaffinfo(this.value, 'v_warrantyAssignment')" wid="5" rid="5" value="<?php echo $warrantysinfo['tc_staff_id']; ?>"> 
       </div>
       <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
       <div class="col-sm-3"> 
         <input class="form-control" id="tc_staff_name" type="text" name="tc_staff_name" wid="5" rid="5" value="<?php echo $warrantysinfo['tc_staff_name']; ?>" readonly> 
       </div>
     </div>

     <div class="form-group">
       <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
       <div class="col-sm-3"> 
         <input class="form-control" id="tc_staff_teamcode" type="text" name="tc_staff_teamcode" wid="5" rid="5" value="<?php echo $warrantysinfo['tc_staff_teamcode']; ?>" readonly> 
       </div>
       <label class="col-sm-3 control-label">Channel:</label>
       <div class="col-sm-3"> 
         <input class="form-control" id="tc_staff_channel" type="text" name="tc_staff_channel" wid="5" rid="5" value="<?php echo $warrantysinfo['tc_staff_channel']; ?>" readonly> 
       </div>
     </div>

     <div class="form-group">
       <label class="col-sm-3 control-label">Technical Consultant Phone No.:</label>
       <div class="col-sm-3"> 
	 <input class="form-control" id="tc_staff_telno" type="text" name="tc_staff_telno" wid="5" rid="5" value="<?php echo $warrantysinfo['tc_staff_telno']; ?>" readonly> 
       </div>
        <label class="col-sm-6 control-label">&nbsp;</label>
     </div>
    </div>

     <div class="form-group">
        <label for="dtp_appointment_input" class="col-md-3 control-label">Appointment Date/Time:</label>
        <div class="input-group date form_appdatetime col-md-7" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_appointment_input">
          <input class="form-control" id="tc_appointmentdatetime" size="10" type="text" name="tc_appointmentdatetime" wid="5" rid="5" value="<?php echo $warrantysinfo['tc_appointmentdatetime']; ?>" readonly>
          <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
          <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="dtp_appointment_input" value="" /><br/>
      </div>

<!--
      <div class="form-group">
        <label class="col-sm-3 control-label">Appointment Date/Time:</label>
        <div class="col-sm-6"> 
	  <input class="form-control" id="tc_appointmentdate" type="text" name="tc_appointmentdate" wid="5" rid="5" value="<?php echo $warrantysinfo['tc_appointmentdate']; ?>"> 
	</div>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tc_appointmenttime" type="text" name="tc_appointmenttime" wid="5" rid="5" value="<?php echo $warrantysinfo['tc_appointmenttime']; ?>"> 
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
	</div>
      </div>
//-->

      <div class="form-group">
        <div class="col-sm-10">&nbsp;</div>
        <input type="hidden" name="id" value=<?php echo $warrantysinfo['id']; ?>>
        <input type="hidden" name="fullorder_id" value=<?php echo $warrantysinfo['fullorder_id']; ?>>
        <input type="hidden" name="action" value="assign">
        <div class="col-sm-2"><button type="submit" class="btn btn-info" action="assign" id="warrantyAssign">Assign</button>
	</div>
      </div>
   </div>
 </div>

<!---Part IV -->
  <div class="thumbnail" id="tc_completion_info">
    <div class="caption-full">
     <h4>Part IV: Technical Consultant Task Completion</h4><br/>

      <div class="form-group">
        <label for="dtp_com_input" class="col-md-3 control-label">Completion Date:</label>
        <div class="input-group date form_datetime col-md-7" data-date-format="yyyy-mm-dd" data-link-field="dtp_com_input">
          <input class="form-control" id="com_date" size="10" type="text" name="com_date" wid="5" rid="5" value="<?php echo $warrantysinfo['com_date']; ?>" readonly>
          <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        <input type="hidden" id="dtp_com_input" value="" /><br/>
      </div>

<!--
      <div class="form-group">
        <label for="dtp_com_input" class="col-sm-3 control-label">Completion Date:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_date" type="text" name="com_date" wid="5" rid="5" value="<?php echo $warrantysinfo['com_date']; ?>"> 
	</div>
	<label class="col-sm-6 control-label">&nbsp;</label>
      </div>
//-->

     <div id="v_warrantyCompletion">     
      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_id" type="text" name="com_staff_id" onchange="getstaffinfo(this.value, 'v_warrantyCompletion')" wid="5" rid="5" value="<?php echo $warrantysinfo['com_staff_id']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_name" type="text" name="com_staff_name" wid="5" rid="5" value="<?php echo $warrantysinfo['com_staff_name']; ?>" readonly> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_teamcode" type="text" name="com_staff_teamcode" wid="5" rid="5" value="<?php echo $warrantysinfo['com_staff_teamcode']; ?>" readonly> 
	</div>
        <label class="col-sm-3 control-label">Channel:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_channel" type="text" name="com_staff_channel" wid="5" rid="5" value="<?php echo $warrantysinfo['com_staff_channel']; ?>" readonly> 
	</div>
      </div>
     </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">TC Remark:</label>
        <div class="col-sm-10"> <textarea class="form-control" row="5" id="com_remark" name="com_remark"  wid="5" rid="5"><?php echo $warrantysinfo['com_remark']; ?></textarea></div>
      </div>
      <div class="form-group">
        <div class="col-sm-10">&nbsp;</div>
        <input type="hidden" name="id" value=<?php echo $warrantysinfo['id']; ?>>
        <input type="hidden" name="fullorder_id" value=<?php echo $warrantysinfo['fullorder_id']; ?>>
        <input type="hidden" name="action" value="complete">
        <div class="col-sm-2"><button type="submit" class="btn btn-info" action="complete" id="warrantyComplete">Complete</button>
	</div>
      </div>
  </div>

</div>
</form>

<!-- datetimepicker -->
   <script type="text/javascript">
     var today = new Date();
     var sdate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+' '+today.getHours()+":"+today.getMinutes();
     var weekday = new Date(today.getTime() + 168 * 60 * 60 * 1000);
     var edate = weekday.getFullYear()+'-'+(weekday.getMonth()+1)+'-'+weekday.getDate()+' '+weekday.getHours()+":"+weekday.getMinutes();
     $('.form_datetime').datetimepicker({
          //language:  'fr',
          //weekStart: 1,
          //showMeridian: 1,
	  minView: 2,
          todayBtn:  1,
          autoclose: 1,
          todayHighlight: 1,
          startView: 2,
          forceParse: 0,
	  //minuteStep: 30,
	  startDate: sdate
	  //endDate: edate
	  //initalDate: today
     });
     $('.form_appdatetime').datetimepicker({
	  //minView: 2,
          //todayBtn:  1,
          autoclose: 1,
          todayHighlight: 1,
          startView: 2,
          forceParse: 0,
	  //minuteStep: 30,
	  startDate: sdate,
	  endDate: edate
	  //initalDate: today
     });
   </script>

