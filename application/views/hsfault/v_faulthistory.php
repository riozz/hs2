<?php echo log_message('debug', 'zzz[v_faulthistory]1:'. json_encode($faults)); ?>
<table class="table table-hover">
<thead>
 <tr><th>Fault ID</th><th>Created Date</th><th>Customer Name</th><th>Handle Staff</th><th>Detail</th></tr>
</thead>
<tbody>
 <?php 
  if (sizeof($faults)>0) {
    foreach ($faults as $faults_item): 
     echo "<tr>";
     echo "<td>".$faults_item['id']."</td>";
     echo "<td>".$faults_item['createddate']."</td>";
     echo "<td>".$faults_item['customer_name']."</td>";
     echo "<td>".$faults_item['name']."</td>";
     echo "<td><a href=".site_url('hsfault/index/'.$faults_item['orders_id'].'/'.$faults_item['id']).">Fault detail</a></td></tr>";
    endforeach; 
  } else {
     echo "<tr><td colspan=5>NO data found</td></tr>";
  }
 ?>
</tbody>
</table>

