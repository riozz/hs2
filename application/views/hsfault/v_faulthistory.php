<?php echo log_message('debug', 'zzz[v_faulthistory]1:'. $afid); ?>
<?php echo log_message('debug', 'zzz[v_faulthistory]2:'. json_encode($faults)); ?>
<table class="table table-hover">
<thead>
 <tr><th>Fault ID</th><th>Created Date</th><th>Customer Name</th><th>Handle Staff</th><th>EDIT</th></tr>
</thead>
<tbody>
 <?php 
  if (sizeof($faults)>0) {
    foreach ($faults as $faults_item): 
     //echo "<tr ".(($faults_item['id']==$afid)?'class="success"':'').">";
     echo "<tr ".(($faults_item['id']==$afid)?'class="success"':'').">";
     //echo '<td><img class="img-thumbnail" src="'.base_url().'images/updates.png'.'" width="5" height="5">'.$faults_item['forder_id'].'-'.$faults_item['id'].'</td>';
     echo '<td class="col-md-3">'.$faults_item['forder_id'].'-'.$faults_item['id'].'</td>';
     echo "<td class='col-md-3'>".$faults_item['createddate']."</td>";
     echo "<td class='col-md-3'>".$faults_item['customer_name']."</td>";
     echo "<td class='col-md-3'>".$faults_item['name']."</td>";
     //echo "<td class='col-md-1'><a href=".site_url('hsfault/index/'.$faults_item['orders_id'].'/'.$faults_item['id'])."><img src='".base_url()."images/edit_blue.png'></a></td></tr>";
     echo "<td class='col-md-1'><a href=".site_url('hsfault/index/'.$faults_item['orders_id'].'/'.$faults_item['id'])." btn btn-info btn-lg><span class='glyphicon glyphicon-edit'></span></a></td></tr>";
    endforeach; 
  } else {
     echo "<tr><td colspan=5>NO data found</td></tr>";
  }
 ?>
</tbody>
</table>

