<pre>
 <?php 
    //echo json_encode($faultsinfo); 
    //echo $faultsinfo['name']; 
    $qresult = ($faultsinfo['name'] == 'NULL')?false:true; 
 ?>
<p>
</pre>
<form class="form-horizontal" id="faultForm">
<div class="thumbnail">
  <div class="caption-full">
    <h4>Part I: CS/TS Staff Profile </h4><br/>
      <div class="form-group">
     	<label class="col-sm-2 control-label">Staff Number</label>
      	<div class="col-sm-4">
          <input class="form-control" id="disabledInput" type="text" name="staffnumber" value="<?php echo ($qresult)?$faultsinfo['sfstaffid']:''; ?>" placeholder="" disabled>
     	</div>
      	<label class="col-sm-2 control-label">Staff Name</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffname" value="<?php echo ($qresult)?$faultsinfo['name']:''; ?>" placeholder="" disabled>
      	</div>
      </div>
      <div class="form-group">
     	<label class="col-sm-2 control-label">Staff Team Code</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="staffteamcode" value="<?php echo ($qresult)?$faultsinfo['teamcode']:''; ?>" placeholder="" disabled>
      	</div>
        <label class="col-sm-2 control-label">Channel</label>
      	<div class="col-sm-4">
       	  <input class="form-control" id="disabledInput" type="text" name="channel" value="<?php echo ($qresult)?$faultsinfo['channel']:''; ?>" placeholder="" disabled>
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

    <div class="form-group">
      <label class="col-sm-3">
      <input type="radio" name="optcert" value="">HKID&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="optcert" value="">BR&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="optcert" value="">PS
      </label>

      <div class="col-sm-3">
        <input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['uid']:''; ?>" name="certno" data-toggle="tooltip" data-placement="right" title="Hooray!">
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
        <input class="form-control" id="focusedInput" type="text" value="<?php echo ($qresult)?$faultsinfo['c2number']:''; ?>" name="2ndcontactnumber">
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
      	    <div class="col-sm-4 dropdown">
	      <select class="form-control" id="district" name="district">
	        <option value="1">WanChai</option>
		<option value="2">ChaiWan</option>
	      </select>
            </div>
   	    <label class="col-sm-2 control-label">[ Area ]</label>
      	    <div class="col-sm-4 dropdown">
	      <select class="form-control" id="area" name="area">
	         <option value="HK">HK</option>
	         <option value="KLN">KLN</option>
		 <option value="NT">NT</option>
	      </select>
	    </div>  
          </div>
        </div>
      </div>

      <br/>
      <div class="form-group">
        <label class="col-sm-2 control-label">Additional Address</label>
        <div class="col-sm-10"> <textarea class="form-control" id="focusedInput" row="5" id="2ndaddress" name="additionaladdress" ><?php echo ($qresult)?$faultsinfo['additionaladdr']:''; ?></textarea></div>
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
          <label class="radio-inline"><input type="radio" name="faultto" value="ts">TS</label>
	  <label class="radio-inline"><input type="radio" name="faultto" value="cs">CS</label>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Fault Category ]</label>
        <div class="col-sm-8"> 
          <label class="checkbox-inline"> <input type="checkbox" value="Option 1" name="faultcatgory1">Option 1</label>
	  <label class="checkbox-inline"> <input type="checkbox" value="Option 2" name="faultcatgory2">Option 2</label>
	</div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Fault Sympthon ]</label>
        <div class="col-sm-8"> 
          <select class="form-control" id="faultsym" name="faultsymthon">
	    <option value="faultsym1">faultsym1</option>
	    <option value="faultsym2">faultsym2</option>
	  </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <label class="col-sm-3 control-label">[ Item Replacement ]</label>
        <div class="col-sm-8"> 
          <label> <input type="checkbox" value="itemreplacement" name="itemreplacement">&nbsp;&nbsp;</label>
	</div>
      </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Type ]</label>
      <div class="col-sm-8"> 
        <select class="form-control" id="itemtype" name="itemtype">
	  <option value="itemtype1">itemtype1</option>
	  <option value="itemtype2">itemtype2</option>
	</select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Model ]</label>
      <div class="col-sm-3"> <input class="form-control" id="itemmodel" type="text" name="itemmodel" value="<?php echo ($qresult)?$faultsinfo['model']:''; ?>"> </div>
      <label class="col-sm-2 control-label">[ Quantities ]</label>
      <div class="col-sm-3"> <input class="form-control" id="quantities" type="text" name="quantities" value="<?php echo ($qresult)?$faultsinfo['quantity']:''; ?>"> </div>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Item Serial ]</label>
      <div class="col-sm-5"> <input class="form-control" id="itemserial" type="text" name="itemserial" value="<?php echo ($qresult)?$faultsinfo['serial']:''; ?>"> </div>
      <label class="col-sm-3 control-label">[ Use ";" for separation ]</label>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Transfer To ]</label>
      <div class="col-sm-8"> 
        <select class="form-control" id="transferto" name="transferto">
	  <option value="transferto1">transferto1</option>
	  <option value="transferto2">transferto2</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Appointment Date ]</label>
      <div class="col-sm-8"> <input class="form-control" id="appointmentdate" type="text" name="appointmentdate" value="<?php echo ($qresult)?$faultsinfo['appointment_date']:''; ?>"> </div>
    </div>

    <div class="form-group">
      <label class="col-sm-1 control-label"></label>
      <label class="col-sm-3 control-label">[ Appointment Time ]</label>
      <div class="col-sm-8"> 
      <select class="form-control" id="appointmenttime" name="appointmenttime">
	<option value="appointmenttime1">appointmenttime1</option>
	<option value="appointmenttime2">appointmenttime2</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-1 control-label"></label>
    <label class="col-sm-3 control-label">[ Fault Details ]</label>
    <div class="col-sm-8"> <textarea class="form-control" id="faultdetail" row="5" id="faultdetail" name="faultdetails" ><?php echo ($qresult)?$faultsinfo['details']:''; ?></textarea> </div>
  </div>

  <div class="form-group">
    <div class="col-sm-10">&nbsp;</div>
    <div class="col-sm-2"><button type="submit" class="btn btn-info" action="addfault" id="faultSubmit">Submit</button></div>
    <input type="hidden" name="action" value="addfault">
    </div>
  </div>
</div>
</form>