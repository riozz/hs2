<pre>
 <?php 
    echo json_encode($faultsinfo); 
    //$qresult = isset($faultsinfo['name'])?true:false; 
    if ($faultsinfo['faultid']>0) {
      $qresult=true;
    } else {
      $qresult=false;
      /*
      $faultsinfo['report_to']=0;
      $faultsinfo['category']=0;
      $faultsinfo['symptomid']=0;
      $faultsinfo['replacement']=0;
      $faultsinfo['itemtypeid']=0;
      $faultsinfo['transfertoid']=0;
      $faultsinfo['appointmentid']=0;
      $faultsinfo['faultid']=0;
      $faultsinfo['orderid']=0;
	*/
    }
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
     	<input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['c_name']; ?>" name="c_name">
      </div>
      <label class="col-sm-2 control-label"></label>
      <!--
      <div class="col-sm-4">
      	<input class="form-control" id="focusedInput" type="text" value="<?php echo ''; ?>" name="staffno">
      </div>
      //-->
    </div>

    <?php if (strlen($faultsinfo['c_uid'])>0) {
	    $uid_no=str_replace('HKID:','',strtoupper($faultsinfo['c_uid']));
	    $uid_no=str_replace('BR:','',strtoupper($faultsinfo['c_uid']));
	    $uid_no=str_replace('PS:','',strtoupper($faultsinfo['c_uid']));
          } else {
	    $uid_no = 0;
	  } 
          //log_message('debug', 'zzz82:uid_no='.str_replace('HKID: ','',strtoupper($uid_no)));
    ?>
    <div class="form-group">
      <label class="col-sm-3">
      <input type="radio" name="c_certtype" value="HKID" <?php echo (strpos(strtoupper($faultsinfo['c_uid']),'HKID')===false)?'':'checked'; ?>>HKID&nbsp;&nbsp;&nbsp;
      <input type="radio" name="c_certtype" value="BR" <?php echo (strpos(strtoupper($faultsinfo['c_uid']),'BR')===false)?'':'checked'; ?>>BR&nbsp;&nbsp;&nbsp;
      <input type="radio" name="c_certtype" value="PS" <?php echo (strpos(strtoupper($faultsinfo['c_uid']),'PS')===false)?'':'checked'; ?>>PS
      </label>

      <div class="col-sm-3">
        <input class="form-control" id="focusedInput" type="text" value="<?php echo (strlen($uid_no)>0)?$uid_no:''; ?>" name="c_certno" data-toggle="tooltip" data-placement="right" title="Hooray!">
      </div>
      <label class="col-sm-2 control-label">Working location</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['c_workingloc']; ?>" name="c_workingloc">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Contact Number</label>
      <div class="col-sm-4">
     	<input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['c_contact']; ?>" name="c_contact">
      </div>
      <label class="col-sm-2 control-label">2nd Contact Number</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['c_ndcontact']; ?>" name="c_ndcontact">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Office Tel Number</label>
      <div class="col-sm-4">
     	<input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['c_officetel']; ?>" name="c_officetel">
      </div>
      <label class="col-sm-2 control-label">Contact Email</label>
      <div class="col-sm-4">
        <input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['c_email']; ?>" name="c_email">
      </div>
    </div>

    <div class="panel-group">
      <div class="panel panel-default">
        <div class="panel-heading"><i>Installation Address</i></div>
	  <div class="panel-body">
	    <div class="form-group">
      	      <label class="col-sm-2 control-label">[ Apt/Flat ]</label>
      	      <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_flat']; ?>" name="ia_flat"></div>
      	      <label class="col-sm-2 control-label">[ Floor ]</label>
      	      <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_floor']; ?>" name="ia_floor"></div>
	    </div>
	    <div class="form-group">
      	    <label class="col-sm-2 control-label">[ Apt/Hse ]</label>
            <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_hse']; ?>" name="ia_hse"></div>
      	    <label class="col-sm-2 control-label">[ Bldg ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_bldg']; ?>" name="ia_bldg"></div>
	  </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">[ St No ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_stno']; ?>" name="ia_stno"></div>
      	    <label class="col-sm-2 control-label">[ Street ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_street']; ?>" name="ia_street"></div>
	  </div>
	  <div class="form-group">
      	    <label class="col-sm-2 control-label">[ District ]</label>
      	    <div class="col-sm-4"><input class="form-control" id="focusedInput" type="text" value="<?php echo $faultsinfo['ia_district']; ?>" name="ia_district"></div>

	    <?php $areacode=substr($faultsinfo['ia_area'],0,2); ?>
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
        <div class="col-sm-10"> <textarea class="form-control" id="focusedInput" row="5" id="2ndaddress" name="ia_additionaladdr" ><?php echo $faultsinfo['ia_additionaladdr']; ?></textarea></div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Ref. Order No</label>
        <div class="col-sm-3 dropdown">
          <select class="form-control" id="reforderno" name="ia_refordernoprefix">
	    <option value="SL">SL</option>
	    <option value="AA">AA</option>
	  </select>
				      </div>  
          <div class="col-sm-7 dropdown">
     	    <input class="form-control" id="reforderno" type="text" value="<?php echo $faultsinfo['ia_reforderno']; ?>" name="ia_reforderno">
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
              echo "<label class='radio-inline'><input type='radio' name='f_faulttoid' value='".$row['id']."' ". (($row['id']==$faultsinfo['f_reporttoid'])?'checked':'')  .">".$row['content']."</label>";
	    }
	  ?>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Fault Category ]</label>
        <div class="col-sm-8"> 
          <label class="checkbox-inline"> <input type="checkbox" value="PCD" name="f_pcd" <?php echo (strpos(strtoupper($faultsinfo['f_category']),"PCD")===false)?'':'checked'; ?>>PCD</label>
	  <label class="checkbox-inline"> <input type="checkbox" value="LTS" name="f_lts" <?php echo (strpos(strtoupper($faultsinfo['f_category']),"LTS")===false)?'':'checked'; ?>>LTS</label>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Fault Symptom ]</label>
        <div class="col-sm-8"> 
          <select class="form-control" id="faultsym" name="f_symptomid">
	    <?php echo "<option value=0 ".(($faultsinfo['f_symptomid']==0)?'selected':'') . ">Please select</option>";
	      foreach ($faultsinfo['tab_symptom'] as $row) 
              {
	        echo "<option value=".$row['id']." ".(($row['id']==$faultsinfo['f_symptomid'])?'selected':'') . ">".$row['content']."</option>";
              }
            ?> 
	  </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Item Replacement ]</label>
        <div class="col-sm-8"> 
          <label> <input type="checkbox" value="itemreplacement" name="f_replacement" <?php echo (($faultsinfo['f_replacement']==0)?'':'checked') ?>>&nbsp;&nbsp;</label>
	</div>
      </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Type ]</label>
      <div class="col-sm-8"> 
        <select class="form-control" id="itemtype" name="f_itemtypeid">
	  <?php echo "<option value=0 ".(($faultsinfo['f_itemtypeid']==0)?'selected':'') . ">Please select</option>";
	    foreach ($faultsinfo['tab_itemtype'] as $row) 
            {
	    echo "<option value=".$row['id']." ".(($row['id']==$faultsinfo['f_itemtypeid'])?'selected':'') . ">".$row['content']."</option>";
            }
	  ?>
	</select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Model ]</label>
      <div class="col-sm-3"> <input class="form-control" id="itemmodel" type="text" name="f_model" value="<?php echo $faultsinfo['f_model']; ?>"> </div>
      <label class="col-sm-2 control-label">[ Quantities ]</label>
      <div class="col-sm-3"> <input class="form-control" id="quantities" type="text" name="f_quantity" value="<?php echo $faultsinfo['f_quantity']; ?>"> </div>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Serial ]</label>
      <div class="col-sm-5"> <input class="form-control" id="itemserial" type="text" name="f_serial" value="<?php echo $faultsinfo['f_serial']; ?>"> </div>
      <label class="col-sm-3 control-label">[ Use ";" for separation ]</label>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Transfer To ]</label>
      <div class="col-sm-8"> 
        <select class="form-control" id="transferto" name="f_transfertoid">
	  <?php echo "<option value=0 ".(($faultsinfo['f_transfertoid']==0)?'selected':'') . ">Please select</option>";
	    foreach ($faultsinfo['tab_transferto'] as $row) 
            {
	    echo "<option value=".$row['id']." ".(($row['id']==$faultsinfo['f_transfertoid'])?'selected':'') . ">".$row['content']."</option>";
            }
	  ?>
        </select>
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Appointment ]</label>
      <div class="col-sm-8"> 
      <select class="form-control" id="appointment" name="f_appointmentid">
	<?php echo "<option value=0 ".(($faultsinfo['f_appointmentid']==0)?'selected':'') . ">Please select</option>";
	  if ($faultsinfo['f_appointmentid']>0) {
	    echo "<option value=".$faultsinfo['f_appointmentid'].">".$faultsinfo['date'].' '.$faultsinfo['timeslot']."</option>";
          }
	  foreach ($faultsinfo['tab_appointment'] as $row) 
          {
	    echo "<option value=".$row['id']." ".(($row['id']==$faultsinfo['f_appointmentid'])?'selected':'') . ">".$row['date'].' '.$row['timeslot']."</option>";
          }
	?>
      </select>
      <input type="hidden" name="f_o_appointmentid" value=<?php echo $faultsinfo['f_appointmentid']; ?>>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-1 control-label"></label>
    <label class="col-sm-3 control-label">[ Fault Details ]</label>
    <div class="col-sm-8"> <textarea class="form-control" id="faultdetail" row="5" id="faultdetail" name="f_details" ><?php echo $faultsinfo['f_details']; ?></textarea> </div>
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
