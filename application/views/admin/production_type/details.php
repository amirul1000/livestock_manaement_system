<a  href="<?php echo site_url('admin/production_type/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Production_type'); ?></h5>
<!--Data display of production_type with id--> 
<?php
	$c = $production_type;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Production Type Name</td><td><?php echo $c['production_type_name']; ?></td></tr>


</table>
<!--End of Data display of production_type with id//--> 