<a  href="<?php echo site_url('admin/gender/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Gender'); ?></h5>
<!--Data display of gender with id--> 
<?php
	$c = $gender;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Gender Name</td><td><?php echo $c['gender_name']; ?></td></tr>


</table>
<!--End of Data display of gender with id//--> 