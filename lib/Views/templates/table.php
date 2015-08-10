<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

<?php
$keys = array_keys ($rows[0]);
?>
<div class="container">
<table id="read_<?= $table ?>" class="table">
<thead>
<tr>
<?php foreach ($keys as $key) {
if(in_array($key, $filter)) continue; ?>
    <th><?= ucfirst(str_replace('_',' ',$key)) ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php foreach ($rows as $key => $row) { 
if($key == 0) continue; ?>
<tr>
<?php  foreach ($row as $key => $value) { 
if(in_array($key, $filter)) continue; ?>
    <td><?= $value?></td>
<?php } ?>
</tr>
<?php } ?>
</tbody>
</table>
</div>

<!-- <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
        //$('#read_<?= $table ?>').DataTable();
});
</script> -->
