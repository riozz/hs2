    <div class="form-group">
       <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
       <div class="col-sm-3">
         <input class="form-control" id="tc_staff_id" type="text" name="tc_staff_id" onchange="getstaffinfo(this.value, 'v_warrantyAssignment')" wid="5" rid="5" value="<?php echo $staff_id;?>">
       </div>
       <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
       <div class="col-sm-3">
         <input class="form-control" id="tc_staff_name" type="text" name="tc_staff_name" wid="5" rid="5" value="<?php echo $staff_name;?> " readonly>
       </div>
     </div>

     <div class="form-group">
       <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
       <div class="col-sm-3">
         <input class="form-control" id="tc_staff_teamcode" type="text" name="tc_staff_teamcode" wid="5" rid="5" value="<?php echo $staff_teamcode;?>" readonly>
       </div>
       <label class="col-sm-3 control-label">Channel:</label>
       <div class="col-sm-3">
         <input class="form-control" id="tc_staff_channel" type="text" name="tc_staff_channel" wid="5" rid="5" value="<?php echo $staff_channel;?>" readonly>
       </div>
     </div>

     <div class="form-group">
       <label class="col-sm-3 control-label">Technical Consultant Phone No.:</label>
       <div class="col-sm-3">
         <input class="form-control" id="tc_staff_telno" type="text" name="tc_staff_telno" wid="5" rid="5" value="<?php echo $staff_telno;?>" readonly>
       </div>
        <label class="col-sm-6 control-label">&nbsp;</label>
     </div>


<?php
  //echo str_replace("\"","",json_encode($staff_id));
  //echo json_encode($staff_name);
  //echo $staff_name;
  //echo json_encode($staff_location);
  //echo json_encode($staff_teamcode);
  //echo json_encode($staff_channel);
  //echo json_encode($staff_telno);
  //if ($ret>0) $v = "appointment=true";
  //else $v= "appointment=false";
  //return $v;
  //return json_encode($v);
?>
