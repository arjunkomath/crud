<table class="table">
<?php foreach ($row as $key => $value) { ?>
<tr>
    <td><b><?= ucfirst(str_replace('_',' ',$key)) ?></b></td>
    <td><?= $value ?></td>
</tr>
<?php } ?>
</table>
