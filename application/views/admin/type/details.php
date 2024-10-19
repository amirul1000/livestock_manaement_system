<a  href="<?php echo site_url('admin/type/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Type'); ?></h5>
<!--Data display of type with id--> 
<?php
	$c = $type;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Type Name</td><td><?php echo $c['type_name']; ?></td></tr>


</table>
<!--End of Data display of type with id//--> 