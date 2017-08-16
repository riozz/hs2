 <?php 
    echo validation_errors(); 
    //echo json_encode($faultsinfo); 
    //$rightid = $this->session->userdata('s_rightid');
    $i = 0; //convert php array to javascript array
    foreach ($this->session->userdata('s_rightid') as $row)
    {
      $rightids[$i] = $row['right_id'];
      $i++;
    }
    if ($upgradesinfo['id']>0) { //upgradeid
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
    var checkAttr = "<?php echo $upgradesinfo['id'] ?>"; //upgradeid
    var rightids = "<?php echo implode(",",$rightids) ?>";
    //var x = document.forms[0];
    //alert("checkAttr,rightid = "+ checkAttr+" "+rightid);
    //$('.form_appdatetime').datetimepicker('hide'); 
    if (checkAttr>0) {
      var x = document.forms['upgradeform'];
      var i, j;
      var txt = "";
      for (i=0; i< x.length; i++) {
        componentname = x[i].getAttribute("name");
        componentvalue = x[i].getAttribute("wid");
        //txt = txt + componentname + "~"+componentvalue+";";
        //alert("txt = "+txt);
        if (componentvalue) {
	  for (j=0; j<rightids.length; j++) {
	    if (rightids[j] != ",") {
              if (rightids[j] != componentvalue) {
	 	switch(componentname) {
		  case "u_model":
                    $("#u_model option:not(:selected)").prop("disabled","true");
                    //$("#u_model option").not(":selected").attr("disabled","disabled");
		    //x[i].setAttribute("disabled", true);
		    break;
		  case "u_appointmentdatetime":
		    //alert("line 56");
     		    $('.form_u_appointmentdatetime').datetimepicker('remove');
		    //x[i].setAttribute("disabled", true);
		    //$('span.s_u_appointmentdatetime').hide();
		    break;
		  case "tc_appointmentdatetime":
     		    $('.form_tc_appointmentdatetime').datetimepicker('remove');
		    //x[i].setAttribute("disabled", true);
		    //$('span.s_tc_appointmentdatetime').hide();
		    break;
		  case "com_date":
     		    $('.form_datetime').datetimepicker('remove');
		    //x[i].setAttribute("disabled", true);
		    //$('span.s_com_date').hide();
		    break;
	          default:
                    x[i].setAttribute("readonly", true);
		}
		//$("#u_appointmentdatetime").attr("disabled","disabled");
		//$("#u_appointmentdatetime_button").hide();
		//$("#u_model").attr('disabled',true);
              }
              if (rightids[j] == componentvalue) {
		switch(componentname) {
		  case "u_model":
                    //$("#u_model option").not(":selected").attr("disabled","false");
                    $("#u_model option:not(:selected)").prop("disabled",null);
		    //x[i].removeAttribute("disabled");
		    break;
		  case "u_appointmentdatetime":
		    //alert("line 83");
     		    $('.form_u_appointmentdatetime').datetimepicker('show');
		    //x[i].removeAttribute("disabled");
		    //$('span.s_u_appointmentdatetime').show();
		    break;
		  case "tc_appointmentdatetime":
     		    $('.form_tc_appointmentdatetime').datetimepicker('show');
		    //x[i].removeAttribute("disabled");
		    //$('span.s_tc_appointmentdatetime').show();
		    break;
		  case "com_date":
     		    $('.form_datetime').datetimepicker('show');
		    //x[i].removeAttribute("disabled");
		    //$('span.s_com_date').show();
		    break;
		  default:
                    x[i].removeAttribute("readonly");
		}
		//$("#u_appointmentdatetime").attr("disabled","");
		//$("#u_appointmentdatetime_button").show();
		//$("#u_model").attr('disabled',true);
              }
	    }
	  }
        }
      }
    } 
  };

  function getstaffinfo(str, vform) {
    //get staff info by staffid
    alert("zzz117:upgrades/get_staffinfo/"+str+"/"+vform);
    if (str == "") {
      return;
    } else {
      xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById(vform).innerHTML = this.responseText;
        }
      };	
      //alert("zzz127:"+window.location.pathname);	
      //var url = windows.location.host + windows.location.pathname
      xmlhttp.open("GET","http://10.39.8.113/dev/hs2/index.php/upgrades/get_staffinfo/"+str+"/"+vform,true);
      //xmlhttp.open("GET","upgrades/get_staffinfo/1352731/v_upgradeCompletion",true);
      xmlhttp.send();
    }
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
	tc_staff_name: {
	  required: true,
	  minlength: 6
	},
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
	u_model: {
	  required: true
	}
      }
    });
    showCustomAttr(this);
    //prevent enter to submit
    $(window).keydown(function(event){
      if (event.keyCode == 13) {
        event.preventDefault();
        return false;
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
  echo form_open(base_url().'index.php/upgrades/change/'.$upgradesinfo['fullorder_id'], 'class="form-horizontal" id="upgradeForm" name="upgradeform"');
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
	  <select class="form-control" id="u_model" name="u_model" wid="4" rid="5" >
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
        <label for="dtp_u_appointment_input" class="col-sm-2 control-label">Appointment Date/Time:</label>
        <div class="input-group date form_u_appointmentdatetime col-md-7" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_u_appointment_input">
          <input class="form-control" id="u_appointmentdatetime" size="10" type="text" name="u_appointmentdatetime" wid="4" rid="5" value="<?php echo $upgradesinfo['u_appointmentdatetime']; ?>" readonly>
          <span class="input-group-addon s_u_appointmentdatetime" ><span class="glyphicon glyphicon-remove"></span></span>
          <span class="input-group-addon s_u_appointmentdatetime" ><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input type="hidden" id="dtp_u_appointment_input" value="" /><br/>
      </div>

<!--
      <div class="form-group">
        <label class="col-sm-2 control-label">Appointment Date/Time:</label>
        <div class="col-sm-6"> 
	  <input class="form-control" id="u_appointmentdate" type="text" name="u_appointmentdate" wid="5" rid="5" value="<?php echo $upgradesinfo['u_appointmentdate']; ?>"> 
	</div>
        <div class="col-sm-4"> 
	  <input class="form-control" id="u_appointmenttime" type="text" name="u_appointmenttime" wid="5" rid="5" value="<?php echo $upgradesinfo['u_appointmenttime']; ?>"> 
	</div>
      </div>
//-->

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
  <div class="thumbnail" id="tc_assignment_info">
    <div class="caption-full">
      <h4>Part III: Technical Consultant Assignment</h4><br/>
      <div id="v_upgradeAssignment">
       <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tc_staff_id" type="text" name="tc_staff_id" onchange="getstaffinfo(this.value, 'v_upgradeAssignment')" wid="5" rid="5" value="<?php echo $upgradesinfo['tc_staff_id']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tc_staff_name" type="text" name="tc_staff_name" wid="0" rid="5" value="<?php echo $upgradesinfo['tc_staff_name']; ?>" readonly> 
	</div>
       </div>

       <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tc_staff_teamcode" type="text" name="tc_staff_teamcode" wid="0" rid="5" value="<?php echo $upgradesinfo['tc_staff_teamcode']; ?>" readonly> 
	</div>
        <label class="col-sm-3 control-label">Channel:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tc_staff_channel" type="text" name="tc_staff_channel" wid="0" rid="5" value="<?php echo $upgradesinfo['tc_staff_channel']; ?>" readonly> 
	</div>
       </div>

       <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Phone No.:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="tc_staff_telno" type="text" name="tc_staff_telno" wid="0" rid="5" value="<?php echo $upgradesinfo['tc_staff_telno']; ?>" readonly> 
	</div>
        <label class="col-sm-6 control-label">&nbsp;</label>
       </div>
      </div>

      <div class="form-group">
        <label for="dtp_tc_appointment_input" class="col-sm-3 control-label">Appointment Date/Time:</label>
        <div class="input-group date form_tc_appointmentdatetime col-sm-7" date-date-format="yyyy-mm-dd hh:ii" date-link-field="dtp_tc_appointment_input"> 
	  <input class="form-control" id="tc_appointmentdatetime" size="10" type="text" name="tc_appointmentdatetime" wid="4" rid="5" value="<?php echo $upgradesinfo['tc_appointmentdatetime']; ?>" readonly> 
          <span class="input-group-addon s_tc_appointmentdatetime"><span class="glyphicon glyphicon-remove"></span></span>
          <span class="input-group-addon s_tc_appointmentdatetime"><span class="glyphicon glyphicon-th"></span></span>
	</div>
        <input type="hidden" id="dtp_tc_appointment_input" value="" /><br/>
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
  <div class="thumbnail" id="tc_completion_info">
    <div class="caption-full">
      <h4>Part IV: Technical Consultant Task Completion</h4><br/>

      <div class="form-group">
        <label for="dtp_com_input" class="col-md-3 control-label">Completion Date:</label>
        <div class="input-group date form_datetime col-md-7" data-date-format="yyyy-mm-dd" data-link-field="dtp_com_input">
          <input class="form-control" id="com_date" size="10" type="text" name="com_date" wid="4" rid="5" value="<?php echo $upgradesinfo['com_date']; ?>" readonly>
          <span class="input-group-addon s_com_date"><span class="glyphicon glyphicon-remove"></span></span>
          <span class="input-group-addon s_com_date"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        <input type="hidden" id="dtp_com_input" value="" /><br/>
      </div>

     <div id="v_upgradeCompletion">
      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_id" type="text" name="com_staff_id" onchange="getstaffinfo(this.value, 'v_upgradeCompletion')" wid="5" rid="5" value="<?php echo $upgradesinfo['com_staff_id']; ?>"> 
	</div>
        <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_name" type="text" name="com_staff_name" wid="0" rid="5" value="<?php echo $upgradesinfo['com_staff_name']; ?>" readonly> 
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_teamcode" type="text" name="com_staff_teamcode" wid="0" rid="5" value="<?php echo $upgradesinfo['com_staff_teamcode']; ?>" readonly> 
	</div>
        <label class="col-sm-3 control-label">Channel:</label>
        <div class="col-sm-3"> 
	  <input class="form-control" id="com_staff_channel" type="text" name="com_staff_channel" wid="0" rid="5" value="<?php echo $upgradesinfo['com_staff_channel']; ?>" readonly> 
	</div>
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

<!-- datetimepicker -->
   <script type="text/javascript">
     var today = new Date();
     var sdate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+' '+today.getHours()+":"+today.getMinutes();
     var weekday = new Date(today.getTime() + 1440 * 60 * 60 * 1000); //day * 24
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
     $('.form_tc_appointmentdatetime').datetimepicker({
          //minView: 2,
          //todayBtn:  1,
          autoclose: 1,
          todayHighlight: 1,
          startView: 2,
          forceParse: 0,
          minuteStep: 30,
          startDate: sdate,
          endDate: edate,
          //initalDate: today
     });
     $('.form_u_appointmentdatetime').datetimepicker({
          //minView: 2,
          //todayBtn:  1,
          autoclose: 1,
          todayHighlight: 1,
          startView: 2,
          forceParse: 0,
          minuteStep: 30,
          startDate: sdate,
          endDate: edate,
          //initalDate: today
     });

   </script>

