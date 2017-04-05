<pre>
 <?php 
    echo json_encode($faultsinfo); 
    //$qresult = isset($faultsinfo['name'])?true:false; 
    if (isset($faultsinfo['name'])) {
      $qresult=true;
    } else {
      $qresult=false;
      $faultsinfo['report_to']=0;
      $faultsinfo['category']=0;
      $faultsinfo['symptomid']=0;
      $faultsinfo['replacement']=0;
      $faultsinfo['itemtypeid']=0;
      $faultsinfo['transfertoid']=0;
      $faultsinfo['appointmenttimeid']=0;
      $faultsinfo['faultid']=0;
      $faultsinfo['orderid']=0;
    }
    //echo "<br>category:".strtoupper($faultsinfo['category']); 
    /*
    foreach ($faultsinfo['reportto'] as $row) {
      echo '<br>'.$row['id'].'<br>'.$row['content'].'<br>';
    }
    */
 ?>
<p>
</pre>
<?php 
  echo validation_errors(); 
  echo form_open(base_url().'index.php/faults/change/'.$faultsinfo['orderid'], 'class="form-horizontal" id="faultForm"');
?>
<div class="thumbnail">
  <div class="caption-full">
    <h4>Part I: CS/TS Staff Profile </h4><br/>
      <div class="form-group">
     	<label class="col-sm-2 control-label">Staff Number</label>
      	<div class="col-sm-4">
          <input class="form-control" id="disabledInput" type="text" name="staffnumber" value="<?php echo ($qresult)?$faultsinfo['sfstaffid']:$this->session->userdata('s_staffid'); ?>" placeholder="" readonly>
     	</div>
      	<label class="col-sm-2 control-label">Staff Name</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffname" value="<?php echo ($qresult)?$faultsinfo['name']:$this->session->userdata('s_name'); ?>" placeholder="" readonly>
      	</div>
      </div>
      <div class="form-group">
     	<label class="col-sm-2 control-label">Staff Team Code</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffteamcode" value="<?php echo ($qresult)?$faultsinfo['teamcode']:$this->session->userdata('s_teamcode'); ?>" placeholder="" readonly>
      	</div>
        <label class="col-sm-2 control-label">Channel</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffchannel" value="<?php echo ($qresult)?$faultsinfo['channel']:$this->session->userdata('s_channel'); ?>" placeholder="" readonly>
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
     	<input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['customer_name']:''; ?>" name="customername">
      </div>
      <label class="col-sm-2 control-label">Staff No</label>
      <div class="col-sm-4">
      	<input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['ostaffid']:''; ?>" name="staffno">
      </div>
    </div>

    <?php if (!isset($faultsinfo['uid'])) {
	    $faultsinfo['uid']=0; 
	    $uid_no='';
          } else {
	    $uid_no=$faultsinfo['uid']; 
	    $uid_no=str_replace('HKID: ','',strtoupper($uid_no));
	    $uid_no=str_replace('BR: ','',strtoupper($uid_no));
	    $uid_no=str_replace('PS: ','',strtoupper($uid_no));
	  }
          //log_message('debug', 'zzz82:uid_no='.str_replace('HKID: ','',strtoupper($uid_no)));
    ?>
    <div class="form-group">
      <label class="col-sm-3">
      <input type="radio" name="optcert" value="HKID" <?php echo (strpos(strtoupper($faultsinfo['uid']),'HKID')===false)?'':'checked'; ?>>HKID&nbsp;&nbsp;&nbsp;
      <input type="radio" name="optcert" value="BR" <?php echo (strpos(strtoupper($faultsinfo['uid']),'BR')===false)?'':'checked'; ?>>BR&nbsp;&nbsp;&nbsp;
      <input type="radio" name="optcert" value="PS" <?php echo (strpos(strtoupper($faultsinfo['uid']),'PS')===false)?'':'checked'; ?>>PS
      </label>

      <div class="col-sm-3">
        <input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$uid_no:''; ?>" name="certno" data-toggle="tooltip" data-placement="right" title="Hooray!">
      </div>
      <label class="col-sm-2 control-label">Working location</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['workinglocation']:''; ?>" name="workinglocation">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Contact Number</label>
      <div class="col-sm-4">
     	<input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['contactnumber']:''; ?>" name="contactnumber">
      </div>
      <label class="col-sm-2 control-label">2nd Contact Number</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['c2number']:''; ?>" name="ndcontactnumber">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Office Tel Number</label>
      <div class="col-sm-4">
     	<input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['officetel']:''; ?>" name="officetelnumber">
      </div>
      <label class="col-sm-2 control-label">Contact Email</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['email']:''; ?>" name="contactemail">
      </div>
    </div>

    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading"><i>Installation Address</i></div>
	  <div class="panel-body">
	    <div class="form-group">
      	      <label class="col-sm-2 control-label">[ Apt/Flat ]</label>
      	      <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['flat']:''; ?>" name="ia_flat"></div>
      	      <label class="col-sm-2 control-label">[ Floor ]</label>
      	      <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['floor']:''; ?>" name="ia_floor"></div>
	    </div>
	    <div class="form-group">
      	    <label class="col-sm-2 control-label">[ Apt/Hse ]</label>
            <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['hse']:''; ?>" name="ia_hse"></div>
      	    <label class="col-sm-2 control-label">[ Bldg ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['bldg']:''; ?>" name="ia_bldg"></div>
	  </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">[ St No ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['stno']:''; ?>" name="ia_stno"></div>
      	    <label class="col-sm-2 control-label">[ Street ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['street']:''; ?>" name="ia_street"></div>
	  </div>
	  <div class="form-group">
      	    <label class="col-sm-2 control-label">[ District ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['district']:''; ?>" name="ia_district"></div>
	    <!--
      	    <div class="col-sm-4 dropdown">
	      <select class="form-control" id="district" name="district">
	        <option value="1">WanChai</option>
		<option value="2">ChaiWan</option>
	      </select>
            </div>
	    // -->
	    <?php $areacode=($qresult)?substr($faultsinfo['area'],0,2):''; ?>
   	    <label class="col-sm-2 control-label">[ Area ]</label>
      	    <div class="col-sm-4 dropdown">
	      <select class="form-control" id="area" name="ia_area">
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
        <div class="col-sm-10"> <textarea class="form-control" id="focusedInput" row="5" id="2ndaddress" name="ia_additionaladdress" ><?php echo ($qresult)?$faultsinfo['additionaladdr']:''; ?></textarea></div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Ref. Order No</label>
        <div class="col-sm-3 dropdown">
          <select class="form-control" id="reforderno" name="refordernoprefix">
	    <option value="SL">SL</option>
	    <option value="AA">AA</option>
	  </select>
				      </div>  
          <div class="col-sm-7 dropdown">
     	    <input class="form-control" id="reforderno" type="text" value="<?php echo ($qresult)?$faultsinfo['model']:''; ?>" name="reforderno">
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
              echo "<label class='radio-inline'><input type='radio' name='f_faultto_id' value='".$row['id']."' ". (($row['id']==$faultsinfo['report_to'])?'checked':'')  .">".$row['content']."</label>";
	    }
	  ?>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Fault Category ]</label>
        <div class="col-sm-8"> 
          <label class="checkbox-inline"> <input type="checkbox" value="PCD" name="f_pcd" <?php echo (strpos(strtoupper($faultsinfo['category']),"PCD")===false)?'':'checked'; ?>>PCD</label>
	  <label class="checkbox-inline"> <input type="checkbox" value="LTS" name="f_lts" <?php echo (strpos(strtoupper($faultsinfo['category']),"LTS")===false)?'':'checked'; ?>>LTS</label>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Fault Symptom ]</label>
        <div class="col-sm-8"> 
          <select class="form-control" id="faultsym" name="f_faultsymptom_id">
	    <?php echo "<option value=0 ".(($faultsinfo['symptomid']==0)?'selected':'') . ">Please select</option>";
	      foreach ($faultsinfo['tab_symptom'] as $row) 
              {
	        echo "<option value=".$row['id']." ".(($row['id']==$faultsinfo['symptomid'])?'selected':'') . ">".$row['content']."</option>";
              }
            ?> 
	  </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Item Replacement ]</label>
        <div class="col-sm-8"> 
          <label> <input type="checkbox" value="itemreplacement" name="f_itemreplacement" <?php echo (($faultsinfo['replacement']==0)?'':'checked') ?>>&nbsp;&nbsp;</label>
	</div>
      </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Type ]</label>
      <div class="col-sm-8"> 
        <select class="form-control" id="itemtype" name="f_itemtype_id">
	  <?php echo "<option value=0 ".(($faultsinfo['itemtypeid']==0)?'selected':'') . ">Please select</option>";
	    foreach ($faultsinfo['tab_itemtype'] as $row) 
            {
	    echo "<option value=".$row['id']." ".(($row['id']==$faultsinfo['itemtypeid'])?'selected':'') . ">".$row['content']."</option>";
            }
	  ?>
	</select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Model ]</label>
      <div class="col-sm-3"> <input class="form-control" id="itemmodel" type="text" name="f_itemmodel" value="<?php echo ($qresult)?$faultsinfo['model']:''; ?>"> </div>
      <label class="col-sm-2 control-label">[ Quantities ]</label>
      <div class="col-sm-3"> <input class="form-control" id="quantities" type="text" name="f_quantities" value="<?php echo ($qresult)?$faultsinfo['quantity']:''; ?>"> </div>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Serial ]</label>
      <div class="col-sm-5"> <input class="form-control" id="itemserial" type="text" name="f_itemserial" value="<?php echo ($qresult)?$faultsinfo['serial']:''; ?>"> </div>
      <label class="col-sm-3 control-label">[ Use ";" for separation ]</label>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Transfer To ]</label>
      <div class="col-sm-8"> 
        <select class="form-control" id="transferto" name="f_transferto_id">
	  <?php echo "<option value=0 ".(($faultsinfo['transfertoid']==0)?'selected':'') . ">Please select</option>";
	    foreach ($faultsinfo['tab_transferto'] as $row) 
            {
	    echo "<option value=".$row['id']." ".(($row['id']==$faultsinfo['transfertoid'])?'selected':'') . ">".$row['content']."</option>";
            }
	  ?>
        </select>
      </div>
    </div>

<!--
    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Appointment Date/time ]</label>
      <div class="col-sm-8"> 
       <input class="form-control" id="appointmentdate" type="text" name="f_appointmentid" value="<?php echo ($qresult)?$faultsinfo['appointmentid']:''; ?>"> </div>
    </div>
//-->

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Appointment ]</label>
      <div class="col-sm-8"> 
      <select class="form-control" id="appointment" name="f_appointmentid">
	<?php echo "<option value=0 ".(($faultsinfo['appointmentid']==0)?'selected':'') . ">Please select</option>";
	  echo "<option value=".$faultsinfo['appointmentid'].">".$faultsinfo['date'].' '.$faultsinfo['timeslot']."</option>";
	  foreach ($faultsinfo['tab_appointment'] as $row) 
          {
	    echo "<option value=".$row['id']." ".(($row['id']==$faultsinfo['appointmentid'])?'selected':'') . ">".$row['date'].' '.$row['timeslot']."</option>";
          }
	?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-1 control-label"></label>
    <label class="col-sm-3 control-label">[ Fault Details ]</label>
    <div class="col-sm-8"> <textarea class="form-control" id="faultdetail" row="5" id="faultdetail" name="f_faultdetails" ><?php echo ($qresult)?$faultsinfo['details']:''; ?></textarea> </div>
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
