<!-- Page Content -->
<!-- menu in header.php -->
<script src="<?php echo base_url("js/jquery.min.js"); ?>"></script>
<script src="<?php echo base_url("js/jquery.validate.min.js"); ?>"></script>
<script src="<?php echo base_url("js/bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("js/bootstrap-table.js"); ?>"></script>

<div class="col-md-9">
  <div class="row">
    <div class="alert alert-info"><h3>Upgrade Management</h3>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#warrantyinfo">Warranty Info</button>&nbsp;&nbsp;&nbsp;
      <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#upgradeinfo">Upgrade Info</button>&nbsp;&nbsp;&nbsp;
      <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#tcassignmentinfo">TC Assignment Info</button>&nbsp;&nbsp;&nbsp;
      <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#tccompletioninfo">TC Completion Info</button>
    </div>
  </div>

  <div class="thumbnail">
    <div class="caption-full">
      <div class="form-group">
        <label class="col-sm-2 control-label">Order ID:</label>
        <div class="col-sm-4">
          <input class="form-control" id="disabledInput" type="text" name="staffid" value="" placeholder="" disabled>
        </div>
        <label class="col-sm-2 control-label">Warranty ID:</label>
        <div class="col-sm-4">
          <input class="form-control" id="disabledInput" type="text" name="staffid" value="" placeholder="" disabled>
        </div>
      </div>
      <h4></h4><br/>
    </div>
  </div>

                <div class="thumbnail">
                  <div class="caption-full">
                    <h4>Login Staff Information </h4><br/>
  		    <form class="form-horizontal">
    		    <div class="form-group">
      		      <label class="col-sm-2 control-label">Staff ID:</label>
      		      <div class="col-sm-5">
        	        <input class="form-control" id="disabledInput" type="text" name="staffid" value="" placeholder="" readonly>
      		      </div>
      		      <label class="col-sm-5 control-label">&nbsp;</label>
		    </div>

  		    <div class="form-group">
      		      <label class="col-sm-2 control-label">Staff Name:</label>
      		      <div class="col-sm-5">
        		<input class="form-control" id="disabledInput" type="text" name="staffname" value="" placeholder="" readonly>
      		      </div>
      		      <label class="col-sm-5 control-label">&nbsp;</label>
    		    </div>

    		    <div class="form-group">
      		      <label class="col-sm-2 control-label">Order Status:</label>
      		      <div class="col-sm-5">
        	        <input class="form-control" id="disabledInput" type="text" name="orderstatus" value="Cancelled" placeholder="" readonly>
      		      </div>
      		      <label class="col-sm-5 control-label">&nbsp;</label>
		    </div>
		  </form>
	        </div>
 	      </div>

                <div class="thumbnail">
                    <div class="caption-full">
                        <!--<h4 class="pull-right">$24.99</h4>-->
                        <h4>Smart Living Warranty Checking List </h4><br/>

  			<form class="form-horizontal">

<!--
    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Staff ID:</label>
      			    <div class="col-sm-5">
        		      <input class="form-control" id="disabledInput" type="text" name="staffid" value="" placeholder="" disabled>
      			    </div>
      			    <label class="col-sm-5 control-label">&nbsp;</label>
    			  </div>

    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Staff Name:</label>
      			    <div class="col-sm-5">
        			<input class="form-control" id="disabledInput" type="text" name="staffname" value="" placeholder="" disabled>
      			    </div>
      			    <label class="col-sm-5 control-label">&nbsp;</label>
    			  </div>
  
    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Order Status:</label>
      			    <div class="col-sm-5">
        			  <input class="form-control" id="disabledInput" type="text" name="orderstatus" value="" placeholder="" disabled>
      			    </div>
      			    <label class="col-sm-5 control-label">&nbsp;</label>
    			  </div>
 //-->
 
    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Maintenance Category:</label>
      			    <div class="col-sm-5 dropdown">
			      <select class="form-control" id="maintenancecategory" name="maintenancecategory">
			      <option value="1">CP</option>
			      <option value="2">PP</option>
			      </select>
      			    </div>
      			    <label class="col-sm-5 control-label">&nbsp;</label>
    			  </div>
  
    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Warranty Package:</label>
      			    <div class="col-sm-10 dropdown">
			      <select class="form-control" id="warrantypackage" name="warrantypackage">
			      <option value="1">package 1</option>
			      <option value="2">package 2</option>
			      </select>
      			    </div>
      			    <label class="col-sm-5 control-label">&nbsp;</label>
    			  </div>
  
    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Extra offer:</label>
      			    <div class="col-sm-6">
        			  <input class="form-control" id="disabledInput" type="text" name="extraoffer" value="" placeholder="">
      			    </div>
      			    <label class="col-sm-4 control-label"># (Please Contact Marketing)</label>
			  </div>
  
    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Sales Memo Number:</label>
      			    <div class="col-sm-10">
        			  <input class="form-control" id="salesmemonumber" type="text" name="salesmemonumber" value="" placeholder="">
      			    </div>
			  </div>
 
    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Effective Date:</label>
      			    <div class="col-sm-10">
        	              <input class="form-control" id="salesmemonumber" type="text" name="salesmemonumber" value="" placeholder="">#Only opened for CS/TS or TC.<br/>#If not selectd, effective date will follow the TC completion date of selected category / the end date of last row record added.
      			    </div>
			  </div>

    			  <div class="form-group">
			    <div class="col-sm-9">&nbsp;</div>
                            <div class="col-sm-3"><button type="submit" class="btn btn-info" action="addwarranty">Add Warranty</button></div>
			    <input type="hidden" name="action" value="addwarranty">
			  </div>
<!-- zzz  -->
    			  <div class="panel-group">
			    <div class="panel panel-default">
			      <div class="panel-heading"><i>Warranty History</i></div>
				<div class="panel-body">
				  <div class="form-group">
       		                    <table class="table table-hover">
    				      <thead>
      			     	      <tr>
        		              <th>Firstname</th>
        		              <th>Lastname</th>
        		              <th>Email</th>
      			              </tr>
    				      </thead>
    				      <tbody>
      				      <tr>
        		  	      <td>Denvor</td>
        		  	      <td>Doe</td>
        		  	      <td>john@example.com</td>
				      <td><form action="." method="get"><input type="hidden" name="action" value="edit"><input type="hidden" name="id" value="id"><button class="btn btn-default">EDIT</button></form></td>
      				      </tr>
      				      <tr>
        		  	      <td>Mary</td>
        		  	      <td>Moe</td>
        		  	      <td>mary@example.com</td>
				      <td><form action="." method="get"><input type="hidden" name="action" value="edit"><input type="hidden" name="id" value="id"><button class="btn btn-default">EDIT</button></form></td>
      		  		      </tr>
				      </tbody>
				    </table>
				  </div>
				</div>
			    </div>
			  </div>

  			</form>
                      </div>
 		    </div>

                <div class="thumbnail">
                    <div class="caption-full">
                        <!--<h4 class="pull-right">$24.99</h4>-->
                        <h4>Smart Living Upgrade Item </h4><br/>

  			<form class="form-horizontal">

    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Upgrade Router Model:</label>
      			    <div class="col-sm-10 dropdown">
			      <select class="form-control" id="upgraderoutermodel" name="upgraderoutermodel">
			      <option value="1">$16800</option>
			      <option value="2">$1800</option>
			      </select>
      			    </div>
    			  </div>

    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Upgrade Ruoter Quantity:</label>
      			    <div class="col-sm-5">
        			  <input class="form-control" id="disabledInput" type="text" name="upgraderouterquantity" value="" placeholder="">
      			    </div>
      			    <label class="col-sm-5 control-label">&nbsp;&nbsp;</label>
			  </div>
  
    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Appointment Date/Time:</label>
      			    <div class="col-sm-5">
        	              <input class="form-control" id="disabledInput" type="text" name="appointmentdate" value="" placeholder="">
			    </div>
      			    <div class="col-sm-5 dropdown">
			      <select class="form-control" id="appointmenttime" name="appointmenttime">
			      <option value="1">time 1</option>
			      <option value="2">time 2</option>
			      </select>
      			    </div>
    			  </div>
  
    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Sales Memo Number:</label>
      			    <div class="col-sm-10">
        			  <input class="form-control" id="disabledInput" type="text" name="salesmemonumber" value="" placeholder="">
      			    </div>
			  </div>
  
    			  <div class="form-group">
      			    <label class="col-sm-2 control-label">Salesman Remark:</label>
      			    <div class="col-sm-10">
      			       <textarea class="form-control" id="focusedInput" row="5" id="salesmanremark" name="salesmanremark" value=""></textarea>
      			    </div>
			  </div>

    			  <div class="form-group">
			    <div class="col-sm-9">&nbsp;</div>
                            <div class="col-sm-3"><button type="submit" class="btn btn-info" action="addupgrade">Add Upgrade</button></div>
			    <input type="hidden" name="action" value="addupgrade">
			  </div>
<!-- zzz  -->
    			  <div class="panel-group">
			    <div class="panel panel-default">
			      <div class="panel-heading"><i>Upgrade History</i></div>
				<div class="panel-body">
				  <div class="form-group">
       		                    <table class="table table-hover">
    				      <thead>
      			     	      <tr>
        		              <th>Firstname</th>
        		              <th>Lastname</th>
        		              <th>Email</th>
      			              </tr>
    				      </thead>
    				      <tbody>
      				      <tr>
        		  	      <td>John</td>
        		  	      <td>Doe</td>
        		  	      <td>john@example.com</td>
				      <td><form action="." method="get"><input type="hidden" name="action" value="edit"><input type="hidden" name="id" value="id"><button class="btn btn-default">EDIT</button></form></td>
      				      </tr>
      				      <tr>
        		  	      <td>Mary</td>
        		  	      <td>Moe</td>
        		  	      <td>mary@example.com</td>
				      <td><form action="." method="get"><input type="hidden" name="action" value="edit"><input type="hidden" name="id" value="id"><button class="btn btn-default">EDIT</button></form></td>
      		  		      </tr>
				      </tbody>
				    </table>
				  </div>
				</div>
			    </div>
			  </div>

  			</form>
                      </div>
 		    </div>

                <div class="thumbnail">
                    <div class="caption-full">
                        <h4>Technical Consultant Assignment</h4><br/>

  			<form class="form-horizontal">
    			  <div class="form-group">
      			    <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
      			    <div class="col-sm-3">
        		      <input class="form-control" id="disabledInput" type="text" name="tcstaffno" value="" placeholder="" >
      			    </div>
      			    <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
      			    <div class="col-sm-3">
        		      <input class="form-control" id="disabledInput" type="text" name="tcstaffname" value="" placeholder="" >
      			    </div>
    			  </div>

    			  <div class="form-group">
      			    <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
      			    <div class="col-sm-3">
        		      <input class="form-control" id="disabledInput" type="text" name="tcteamcode" value="" placeholder="" >
      			    </div>
      			    <label class="col-sm-3 control-label">Channel:</label>
      			    <div class="col-sm-3">
        		      <input class="form-control" id="disabledInput" type="text" name="channel" value="" placeholder="" >
      			    </div>
    			  </div>

    			  <div class="form-group">
      			    <label class="col-sm-3 control-label">Technical Consultant Phone No.:</label>
      			    <div class="col-sm-3">
        		      <input class="form-control" id="disabledInput" type="text" name="tcphoneno" value="" placeholder="" >
      			    </div>
      			    <label class="col-sm-6 control-label">&nbsp;</label>
    			  </div>

    			  <div class="form-group">
      			    <label class="col-sm-3 control-label">Appointment Date/Time:</label>
      			    <div class="col-sm-3">
        	              <input class="form-control" id="disabledInput" type="text" name="tcappointmentdate" value="" placeholder="">
			    </div>
      			    <div class="col-sm-3 dropdown">
			      <select class="form-control" id="appointmenttime" name="appointmenttime">
			      <option value="1">time 1</option>
			      <option value="2">time 2</option>
			      </select>
      			    </div>
      			    <label class="col-sm-3 control-label">&nbsp;</label>
    			  </div>
    			  <div class="form-group">
			    <div class="col-sm-10">&nbsp;</div>
                            <div class="col-sm-2"><button type="submit" class="btn btn-info" action="tcassignment">Assign</button></div>
			    <input type="hidden" name="action" value="tcassignment">
			  </div>
  			</form>
                      </div>
 		    </div>

                <div class="thumbnail">
                    <div class="caption-full">
                        <h4>Technical Consultant Task Completion</h4><br/>

  			<form class="form-horizontal">
    			  <div class="form-group">
      			    <label class="col-sm-3 control-label">Completion Date:</label>
      			    <div class="col-sm-3">
        		      <input class="form-control" id="disabledInput" type="text" name="tccompletiondate" value="" placeholder="" >
      			    </div>
      			    <label class="col-sm-6 control-label">&nbsp;</label>
    			  </div>

    			  <div class="form-group">
      			    <label class="col-sm-3 control-label">Technical Consultant Staff No.:</label>
      			    <div class="col-sm-3">
        		      <input class="form-control" id="disabledInput" type="text" name="tcstaffnocomplete" value="" placeholder="" >
      			    </div>
      			    <label class="col-sm-3 control-label">Technical Consultant Staff Name:</label>
      			    <div class="col-sm-3">
        		      <input class="form-control" id="disabledInput" type="text" name="tcstaffnamecomplete" value="" placeholder="" >
      			    </div>
    			  </div>

    			  <div class="form-group">
      			    <label class="col-sm-3 control-label">Technical Consultant Team Code:</label>
      			    <div class="col-sm-3">
        		      <input class="form-control" id="disabledInput" type="text" name="tcteamcodecomplete" value="" placeholder="" >
      			    </div>
      			    <label class="col-sm-3 control-label">Channel:</label>
      			    <div class="col-sm-3">
        		      <input class="form-control" id="disabledInput" type="text" name="channelcomplete" value="" placeholder="" >
      			    </div>
    			  </div>

    			  <div class="form-group">
      			    <label class="col-sm-3 control-label">TC Remark:</label>
      			    <div class="col-sm-9"> <textarea class="form-control" id="focusedInput" row="5" id="tcremark" name="tcremark" value=""></textarea></div>
			  </div>

    			  <div class="form-group">
			    <div class="col-sm-10">&nbsp;</div>
                            <div class="col-sm-2"><button type="submit" class="btn btn-info" action="tccomplete">Complete</button></div>
			    <input type="hidden" name="action" value="tccomplete">
			  </div>
  			</form>
                      </div>
 		    </div>

        </div>

    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

