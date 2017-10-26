<?php echo log_message('debug', 'zzz[v_warrantyhistory]1:'. $awid); ?>
<?php echo log_message('debug', 'zzz[v_warrantyhistory]2:'. json_encode($warrantys)); ?>
<table class="table table-hover">
<thead>
 <tr><th>Warranty ID</th><th>Staff Name</th><th>Completed by</th><th>COM/Start Date</th><th>End Date</th><th>EDIT</th></tr>
</thead>
<tbody>
 <?php 
  if (sizeof($warrantys)>0) {
    foreach ($warrantys as $warrantys_item): 
     //echo "<tr ".(($faults_item['id']==$afid)?'class="success"':'').">";
     //awid = active warranty id
     echo "<tr ".(($warrantys_item['id']==$awid)?'class="success"':'').">";
     //echo '<td><img class="img-thumbnail" src="'.base_url().'images/updates.png'.'" width="5" height="5">'.$faults_item['forder_id'].'-'.$faults_item['id'].'</td>';
     echo '<td class="col-md-3">'.$warrantys_item['fullorder_id'].'-'.$warrantys_item['id'].'</td>';
     //echo "<td class='col-md-3'>".$warrantys_item['createddate']."</td>";
     echo "<td class='col-md-2'>".$warrantys_item['staff_name']."</td>";
     echo "<td class='col-md-2'>".$warrantys_item['com_staff_name']."</td>";
     echo "<td class='col-md-2'>".$warrantys_item['com_date']."</td>";
     echo "<td class='col-md-2'>".$warrantys_item['end_date']."</td>";
     echo "<td class='col-md-1'><a href=".site_url('hswarranty/index/'.$warrantys_item['fullorder_id'].'/'.$warrantys_item['id'])." btn btn-info btn-lg><span class='glyphicon glyphicon-edit'></span></a></td></tr>";
    endforeach; 
  } else {
     echo "<tr><td colspan=5>NO data found</td></tr>";
  }
 ?>
</tbody>
</table>

