<?php echo log_message('debug', 'zzz[v_upgradehistory]1:'. $auid); ?>
<?php echo log_message('debug', 'zzz[v_upgradehistory]2:'. json_encode($upgrades)); ?>
<table class="table table-hover">
<thead>
 <tr><th>Upgrade ID</th><th>Created Date</th><th>Staff Name</th><th>TC Name</th><th>Completed by</th><th>Detail</th></tr>
</thead>
<tbody>
 <?php 
  if (sizeof($upgrades)>0) {
    foreach ($upgrades as $upgrades_item): 
     //echo "<tr ".(($faults_item['id']==$afid)?'class="success"':'').">";
     echo "<tr ".(($upgrades_item['id']==$auid)?'class="success"':'').">";
     //echo '<td><img class="img-thumbnail" src="'.base_url().'images/updates.png'.'" width="5" height="5">'.$faults_item['forder_id'].'-'.$faults_item['id'].'</td>';
     echo '<td>'.$upgrades_item['fullorder_id'].'-'.$upgrades_item['id'].'</td>';
     echo "<td>".$upgrades_item['createddate']."</td>";
     echo "<td>".$upgrades_item['name']."</td>";
     echo "<td>".$upgrades_item['tcname']."</td>";
     echo "<td>".$upgrades_item['comname']."</td>";
     echo "<td><a href=".site_url('hsupgrade/index/'.$upgrades_item['orders_id'].'/'.$upgrades_item['id']).">Upgrade detail</a></td></tr>";
    endforeach; 
  } else {
     echo "<tr><td colspan=5>NO data found</td></tr>";
  }
 ?>
</tbody>
</table>

