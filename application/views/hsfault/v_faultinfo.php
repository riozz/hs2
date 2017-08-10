 <?php 
    echo validation_errors(); 
    //echo json_encode($faultsinfo); 
    $rightid = $this->session->userdata('s_rightid');
    if ($faultsinfo['faultid']>0) {
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
    var checkAttr = "<?php echo $faultsinfo['faultid'] ?>";
    var rightid = "<?php echo $rightid ?>";
    //var x = document.forms[0];
    //if (checkAttr) {  
    alert("checkAttr,rightid = "+ checkAttr+" "+rightid);
    if (checkAttr>0) {  
      var x = document.forms['faultform'];
      //alert("x = "+ x);
      var i;
      var txt = "";
      for (i=0; i< x.length; i++) {
        //txt = txt + x[i].id + ";";
	componentname = x[i].getAttribute("name");
	componentvalue = x[i].getAttribute("wid");
        //txt = txt + componentname+"~"+componentvalue + ";";
        //alert("txt = "+txt);
	if (componentvalue) {
	  if (rightid < componentvalue) {
	    x[i].setAttribute("readonly", true);
	  }
	}
      } 
      //var s = document.getElementById("c_email");
      //var cattr = s.getAttribute("wid");
      //alert("wid = "+ cattr);
      //s.setAttribute("readonly", true);
      //alert("wid = "+attr.innerHTML + " is a " + cattr + ".");
    }
  };

  $(document).ready(function() {
    $('#faultForm').validate({
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
	    url: "<?php echo base_url(); ?>"+"index.php/faults/check_appointmentquota/8",
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
    //alert("ZZZ");
    showCustomAttr(this);

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
  echo form_open(base_url().'index.php/faults/change/'.$faultsinfo['orderid'], 'class="form-horizontal" id="faultForm" name="faultform"');
?>
<div class="thumbnail" id="faultinfo_content">
  <div class="caption-full">
    <div class="form-group" id="key">
      <label class="col-sm-2 control-label">Order ID</label>
      <label class="col-sm-4 control-label">
	<input class="form-control" type="text" value="<?php echo $faultsinfo['orderid'];?>" disabled></label>
      <?php echo ($faultsinfo['faultid']>0)?'<label class="col-sm-2 control-label">Fault ID</label><label class="col-sm-4 control-label"><input class="form-control" type="text" value="'.$faultsinfo['faultid'].'" disabled></label>':'';
      ?>
    </div>
  </div>
</div>
<div class="thumbnail" id="faultinfo_content">
  <div class="caption-full">
    <h4>Part I: CS/TS Staff Profile </h4><br/>
      <div class="form-group" id="part1">
     	<label class="col-sm-2 control-label">Staff Number</label>
      	<div class="col-sm-4">
          <input class="form-control" id="disabledInput" type="text" name="staffid" value="<?php echo ($qresult)?$faultsinfo['staffid']:$this->session->userdata('s_staffid'); ?>" placeholder="" readonly>
     	</div>
      	<label class="col-sm-2 control-label">Staff Name</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffname" value="<?php echo ($qresult)?$faultsinfo['staffname']:$this->session->userdata('s_name'); ?>" placeholder="" readonly>
      	</div>
      </div>
      <div class="form-group">
     	<label class="col-sm-2 control-label">Staff Team Code</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffteamcode" value="<?php echo ($qresult)?$faultsinfo['staffteamcode']:$this->session->userdata('s_teamcode'); ?>" placeholder="" readonly>
      	</div>
        <label class="col-sm-2 control-label">Channel</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffchannel" value="<?php echo ($qresult)?$faultsinfo['staffchannel']:$this->session->userdata('s_channel'); ?>" placeholder="" readonly>
      	</div>
      </div>
  </div>
</div>

<div class="thumbnail">
  <div class="caption-full">
    <h4>Part II: Customer information </h4><br/>

    <div class="form-group">
      <label class="col-sm-2 control-label">Customer Name</label>
      <div class="col-sm-4">
     	<input class="form-control" id="c_name" type="text" wid="5" rid="5" value="<?php echo $faultsinfo['c_name']; ?>" name="c_name">
      </div>
      <label class="col-sm-2 control-label"></label>
      <!--
      <div class="col-sm-4">
      	<input class="form-control" id="focusedInput" type="text" value="<?php echo ''; ?>" name="staffno">
      </div>
      //-->
    </div>

    <?php if (strlen($faultsinfo['c_uid'])>0) {
	    $uid_no=str_replace('BR:','',strtoupper($faultsinfo['c_uid']));
	    $uid_no=str_replace('PS:','',strtoupper($uid_no));
	    $uid_no=str_replace('HKID:','',strtoupper($uid_no));
          } else {
	    $uid_no = 0;
	  } 
          //log_message('debug', 'zzz[v_faultinfo]83:uid_no='.$faultsinfo['c_uid'].' / '.$uid_no);
    ?>
    <div class="form-group">
      <label class="col-sm-3">
      <input type="radio" name="c_certtype" wid="5" rid="5" value="HKID" <?php echo (strpos(strtoupper($faultsinfo['c_uid']),'HKID')===false)?'':'checked'; ?>>HKID&nbsp;&nbsp;&nbsp;
      <input type="radio" name="c_certtype" wid="5" rid="5" value="BR" <?php echo (strpos(strtoupper($faultsinfo['c_uid']),'BR')===false)?'':'checked'; ?>>BR&nbsp;&nbsp;&nbsp;
      <input type="radio" name="c_certtype" wid="5" rid="5" value="PS" <?php echo (strpos(strtoupper($faultsinfo['c_uid']),'PS')===false)?'':'checked'; ?>>PS
      </label>

      <div class="col-sm-3">
        <input class="form-control" id="c_certno" wid="5" rid="5" type="text" value="<?php echo (strlen($uid_no)>0)?$uid_no:''; ?>" name="c_certno" data-toggle="tooltip" data-placement="right" title="Hooray!">
      </div>
      <label class="col-sm-2 control-label">Working location</label>
      <div class="col-sm-4">
        <input class="form-control" id="c_workingloc" wid="3" rid="5" type="text" value="<?php echo $faultsinfo['c_workingloc']; ?>" name="c_workingloc" >
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Contact Number</label>
      <div class="col-sm-4">
     	<input class="form-control" id="c_contact" wid="5" rid="5" type="text" value="<?php echo $faultsinfo['c_contact']; ?>" name="c_contact">
      </div>
      <label class="col-sm-2 control-label">2nd Contact Number</label>
      <div class="col-sm-4">
        <input class="form-control" id="c_ndcontact" wid="3" rid="5" type="text" value="<?php echo $faultsinfo['c_ndcontact']; ?>" name="c_ndcontact">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Office Tel Number</label>
      <div class="col-sm-4">
     	<input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['c_officetel']; ?>" name="c_officetel" wid="3" rid="5">
      </div>
      <label class="col-sm-2 control-label">Contact Email</label>
      <div class="col-sm-4">
        <input class="form-control" id="c_email" wid="3" rid="5" type="text" wid="5" value="<?php echo $faultsinfo['c_email']; ?>" name="c_email" type="email" >
      </div>
    </div>

    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading"><i>Installation Address</i></div>
	  <div class="panel-body">
	    <div class="form-group">
      	      <label class="col-sm-2 control-label">[ Apt/Flat ]</label>
      	      <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_flat']; ?>" name="ia_flat" wid="5" rid="5"></div>
      	      <label class="col-sm-2 control-label">[ Floor ]</label>
      	      <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_floor']; ?>" name="ia_floor" wid="5" rid="5"></div>
	    </div>
	    <div class="form-group">
      	    <label class="col-sm-2 control-label">[ Apt/Hse ]</label>
            <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_hse']; ?>" name="ia_hse" wid="5" rid="5"></div>
      	    <label class="col-sm-2 control-label">[ Bldg ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_bldg']; ?>" name="ia_bldg" wid="5" rid="5"></div>
	  </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">[ St No ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_stno']; ?>" name="ia_stno" wid="5" rid="5"></div>
      	    <label class="col-sm-2 control-label">[ Street ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_street']; ?>" name="ia_street" wid="5" rid="5"></div>
	  </div>
	  <div class="form-group">
      	    <label class="col-sm-2 control-label">[ District ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_district']; ?>" name="ia_district" wid="5" rid="5"></div>

	    <?php $areacode=substr($faultsinfo['ia_area'],0,2); ?>
   	    <label class="col-sm-2 control-label">[ Area ]</label>
      	    <div class="col-sm-4 dropdown">
	      <select class="form-control" id="area" name="ia_area" wid="5" rid="5">
	         <option value="" <?php echo ($areacode=='')?'selected':''; ?>>Please select</option>
	         <option value="HK" <?php echo ($areacode=='HK')?'selected':''; ?>>HK-Hong Kong Island</option>
	         <option value="KLN" <?php echo ($areacode=='KL')?'selected':''; ?>>KLN-Kowloon</option>
	         <option value="LI" <?php echo ($areacode=='LI')?'selected':''; ?>>LI-Lantau Island</option>
		 <option value="NT" <?php echo ($areacode=='NT')?'selected':''; ?>>NT-New Territories</option>
	      </select>
	    </div>  
          </div>
        </div>
      </div>

      <br/>
      <div class="form-group">
        <label class="col-sm-2 control-label">Additional Address</label>
        <div class="col-sm-10"> <textarea class="form-control" id="focusedInput" row="5" id="2ndaddress" name="ia_additionaladdr"  wid="5" rid="5"><?php echo $faultsinfo['ia_additionaladdr']; ?></textarea></div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Ref. Order No</label>
        <div class="col-sm-3 dropdown">
          <select class="form-control" id="reforderno" name="ia_refordernoprefix" wid="5" rid="5">
	    <option value="SL">SL</option>
	    <option value="AA">AA</option>
	  </select>
				      </div>  
          <div class="col-sm-7 dropdown">
     	    <input class="form-control" id="reforderno" type="text" value="<?php echo $faultsinfo['ia_reforderno']; ?>" name="ia_reforderno" wid="5" rid="5">
          </div>
	</div>
      </div>
    </div>
  </div>

<!---Part III -->
  <div class="thumbnail">
    <div class="caption-full">
      <h4>Part III: TS/CS Fault Reporting</h4><br/>
      <div class="form-group">
        <label class="col-sm-2 control-label">Fault Report To</label>
        <div class="col-sm-10"> 
	  <?php foreach ($faultsinfo['reportto'] as $row) 
	    {
              //echo "<label class='radio-inline'><input type='radio' name='faultto' value='".$row['id']."' >".$row['desc']."</label>";
              echo "<label class='radio-inline'><input type='radio' name='f_faulttoid'  wid='5' rid='5' value='".$row['id']."' ". (($row['id']==$faultsinfo['f_reporttoid'])?'checked':'')  ." />".$row['content']."</label>";
	    }
	  ?>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Fault Category ]</label>
        <div class="col-sm-8"> 
          <label class="checkbox-inline"> <input type="checkbox" value="PCD" name="f_pcd" wid="5" rid="5" <?php echo (strpos(strtoupper($faultsinfo['f_category']),"PCD")===false)?'':'checked'; ?>>PCD</label>
	  <label class="checkbox-inline"> <input type="checkbox" value="LTS" name="f_lts" wid="5" rid="5" <?php echo (strpos(strtoupper($faultsinfo['f_category']),"LTS")===false)?'':'checked'; ?>>LTS</label>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Fault Symptom ]</label>
        <div class="col-sm-8"> 
          <select class="form-control" id="faultsym" name="f_symptomid" wid="5" rid="5">
	    <?php echo "<option value='' ".(($faultsinfo['f_symptomid']==0)?'selected':'') . ">Please select</option>";
	      foreach ($faultsinfo['tab_symptom'] as $row) 
              {
	        echo "<option value='".$row['id']."' ".(($row['id']==$faultsinfo['f_symptomid'])?'selected':'') . ">".$row['content']."</option>";
              }
            ?> 
	  </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Item Replacement ]</label>
        <div class="col-sm-8"> 
          <label> <input type="checkbox" name="f_replacement" value='1' wid='5' rid='5' <?php echo (($faultsinfo['f_replacement']==0)?'':'checked') ?>>&nbsp;&nbsp;</label>
	</div>
      </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Type ]</label>
      <div class="col-sm-8"> 
        <select class="form-control" id="itemtype" name="f_itemtypeid" wid="5" rid="5">
	  <?php echo "<option value='' ".(($faultsinfo['f_itemtypeid']==0)?'selected':'') . ">Please select</option>";
	    foreach ($faultsinfo['tab_itemtype'] as $row) 
            {
	    echo "<option value='".$row['id']."' ".(($row['id']==$faultsinfo['f_itemtypeid'])?'selected':'') . ">".$row['content']."</option>";
            }
	  ?>
	</select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Model ]</label>
      <div class="col-sm-3"> <input class="form-control" id="itemmodel" type="text" name="f_model" wid="5" rid="5" value="<?php echo $faultsinfo['f_model']; ?>"> </div>
      <label class="col-sm-2 control-label">[ Quantities ]</label>
      <div class="col-sm-3"> <input class="form-control" id="quantities" type="text" name="f_quantity" wid="5" rid="5" value="<?php echo $faultsinfo['f_quantity']; ?>"> </div>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Serial ]</label>
      <div class="col-sm-5"> <input class="form-control" id="itemserial" type="text" name="f_serial" wid="5" rid="5" value="<?php echo $faultsinfo['f_serial']; ?>"> </div>
      <label class="col-sm-3 control-label">[ Use ";" for separation ]</label>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Transfer To ]</label>
      <div class="col-sm-8"> 
        <select class="form-control" id="f_transfertoid" name="f_transfertoid" wid="5" rid="5" >
	  <?php echo "<option value='' ".(($faultsinfo['f_transfertoid']==0)?'selected':'') . ">Please select</option>";
	    foreach ($faultsinfo['tab_transferto'] as $row) 
            {
	    echo "<option value='".$row['id']."' ".(($row['id']==$faultsinfo['f_transfertoid'])?'selected':'') . ">".$row['content']."</option>";
            }
	  ?>
        </select>
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Appointment ]</label>
      <div class="col-sm-8"> 
      <select class="form-control" id="appointment" name="appointment" wid="5" rid="5">
	<?php echo "<option value='' ".(($faultsinfo['f_appointmentid']==0)?'selected':'') . ">Please select</option>";
	  if ($faultsinfo['f_appointmentid']>0) {
	    echo "<option value='".$faultsinfo['f_appointmentid']."' selected>".$faultsinfo['appointmentdate'].' '.$faultsinfo['appointmenttimeslot']."</option>";
          }
	  foreach ($faultsinfo['tab_appointment'] as $row) 
          {
	    echo "<option value='".$row['id']."' ".(($row['id']==$faultsinfo['f_appointmentid'])?'selected':'') . ">".$row['date'].' '.$row['timeslot']."</option>";
          }
	?>
      </select>
      <input type="hidden" id="f_o_appointmentid" name="f_o_appointmentid" value="<?php echo $faultsinfo['f_appointmentid']; ?>">
    </div>
      <label class="col-sm-3 control-label"></label>
      <label class="col-sm-8 control-label" id="appointment_msg"></label>
  </div>

  <div class="form-group">
    <label class="col-sm-1 control-label"></label>
    <label class="col-sm-3 control-label">[ Fault Details ]</label>
    <div class="col-sm-8"> <textarea class="form-control" id="faultdetail" row="5" id="faultdetail" name="f_details" wid="5" rid="5"><?php echo $faultsinfo['f_details']; ?></textarea> </div>
  </div>

  <div class="form-group">
    <div class="col-sm-10">&nbsp;</div>
    <input type="hidden" name="faultid" value=<?php echo $faultsinfo['faultid']; ?>>
    <input type="hidden" name="orderid" value=<?php echo $faultsinfo['orderid']; ?>>
    <input type="hidden" name="action" value="addfault">
    <div class="col-sm-2"><button type="submit" class="btn btn-info" action="addfault" id="faultSubmit">Submit</button></div>
    </div>
  </div>
</div>
</form>
