    <div class="form-group">
       <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
       <div class="col-sm-3">
         <input class="form-control" id="tc_staff_id" type="text" name="tc_staff_id" onchange="getstaffinfo(this.value, 'v_upgradeAssignment')" wid="5" rid="5" value="<?php echo $staff_id;?>">
       </div>
       <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
       <div class="col-sm-3">
         <input class="form-control" id="tc_staff_name" type="text" name="tc_staff_name" wid="0" rid="5" value="<?php echo $staff_name;?> " readonly>
       </div>
     </div>

     <div class="form-group">
       <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
       <div class="col-sm-3">
         <input class="form-control" id="tc_staff_teamcode" type="text" name="tc_staff_teamcode" wid="0" rid="5" value="<?php echo $staff_teamcode;?>" readonly>
       </div>
       <label class="col-sm-3 control-label">Channel:</label>
       <div class="col-sm-3">
         <input class="form-control" id="tc_staff_channel" type="text" name="tc_staff_channel" wid="0" rid="5" value="<?php echo $staff_channel;?>" readonly>
       </div>
     </div>

     <div class="form-group">
       <label class="col-sm-3 control-label">Technical Consultant Phone No.:</label>
       <div class="col-sm-3">
         <input class="form-control" id="tc_staff_telno" type="text" name="tc_staff_telno" wid="0" rid="5" value="<?php echo $staff_telno;?>" readonly>
       </div>
        <label class="col-sm-6 control-label">&nbsp;</label>
     </div>

