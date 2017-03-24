<!--<div class="alert alert-warning"><h3><?php echo $title; ?></h3></div>//-->

<table class="table table-hover">
<thead>
 <tr><th>Fault ID</th><th>Created Date</th><th>Customer Name</th><th>Handle Staff</th><th>Detail</th></tr>
</thead>
<tbody>
 <?php foreach ($faults as $faults_item): ?>
   <tr>
   <td><?php echo $faults_item['id']; ?></td>
   <td><?php echo $faults_item['createddate']; ?></td>
   <td><?php echo $faults_item['customer_name']; ?></td>
   <td><?php echo $faults_item['name']; ?></td>
   <td><a href="<?php echo site_url('hsfault/index/'.$faults_item['orders_id'].'/'.$faults_item['id']); ?>">Fault detail</a></td></tr>
<?php endforeach; ?>
</tbody>
</table>

<!--
<?php foreach ($faults as $faults_item): ?>

        <div class="faulthistory">
                <?php echo $faults_item['name']; ?>
        </div>
<p><a href="<?php echo site_url('faults/'.$faults_item['faultid']); ?>">View article</a></p>

<?php endforeach; ?>
//-->
