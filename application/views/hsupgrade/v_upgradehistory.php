<?php echo log_message('debug', 'zzz[v_upgradehistory]1:'. $auid); ?>
<?php echo log_message('debug', 'zzz[v_upgradehistory]2:'. json_encode($upgrades)); ?>
<table class="table table-hover">
<thead>
 <tr><th>Upgrade/Addon ID</th><th>Created Date</th><th>Staff Name</th><th>TC Name</th><th>Completed by</th><th>EDIT</th></tr>
</thead>
<tbody>
 <?php 
  if (sizeof($upgrades)>0) {
    foreach ($upgrades as $upgrades_item): 
     //echo "<tr ".(($faults_item['id']==$afid)?'class="success"':'').">";
     echo "<tr ".(($upgrades_item['id']==$auid)?'class="success"':'').">";
     //echo '<td><img class="img-thumbnail" src="'.base_url().'images/updates.png'.'" width="5" height="5">'.$faults_item['forder_id'].'-'.$faults_item['id'].'</td>';
     echo '<td class="col-md-3">'.$upgrades_item['fullorder_id'].'-'.$upgrades_item['id'].'</td>';
     echo "<td class='col-md-3'>".$upgrades_item['createddate']."</td>";
     echo "<td class='col-md-2'>".$upgrades_item['staff_name']."</td>";
     echo "<td class='col-md-2'>".$upgrades_item['tc_staff_name']."</td>";
     echo "<td class='col-md-2'>".$upgrades_item['com_staff_name']."</td>";
     echo "<td class='col-md-1'><a href=".site_url('hsupgrade/index/'.$upgrades_item['orders_id'].'/'.$upgrades_item['id'])." btn btn-info btn-lg><span class='glyphicon glyphicon-edit'></span></a></td></tr>";
    endforeach; 
  } else {
     echo "<tr><td colspan=5>NO data found</td></tr>";
  }
 ?>
</tbody>
</table>

