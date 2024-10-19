<a  href="<?php echo site_url('admin/breed/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Breed'); ?></h5>
<!--Data display of breed with id--> 
<?php
	$c = $breed;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Breed Name</td><td><?php echo $c['breed_name']; ?></td></tr>

<tr><td>Status</td><td><?php echo $c['status']; ?></td></tr>


</table>
<!--End of Data display of breed with id//--> 