<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Breed'); ?></h5>
<?php
  	echo $this->session->flashdata('msg');
?>
<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/breed/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='<?php echo site_url('admin/breed/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/breed/search/',array("class"=>"form-horizontal")); ?>
                    <input name="key" type="text"
				value="<?php echo isset($key)?$key:'';?>" placeholder="Search..."
				class="form-control">
				<button type="submit" class="mr-0">
					<i class="fa fa-search"></i>
				</button>
                <?php echo form_close(); ?>
            </li>
		</ul>
	</div>
</div>
<!--End of Action//--> 
   
<!--Data display of breed-->     
<div style="overflow-x:auto;width:100%;">      
<table class="table table-striped table-bordered">
    <tr>
		<th>Breed Name</th>
<th>Status</th>

		<th>Actions</th>
    </tr>
	<?php foreach($breed as $c){ ?>
    <tr>
		<td><?php echo $c['breed_name']; ?></td>
<td><?php echo $c['status']; ?></td>

		<td>
            <a href="<?php echo site_url('admin/breed/details/'.$c['id']); ?>"  class="action-icon"> <i class="fas fa-eye"></i></a>
            <a href="<?php echo site_url('admin/breed/save/'.$c['id']); ?>" class="action-icon"> <i class="fas fa-edit"></i></a>
            <a href="<?php echo site_url('admin/breed/remove/'.$c['id']); ?>" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="fas fa-trash"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
</div>
<!--End of Data display of breed//--> 

<!--No data-->
<?php
	if(count($breed)==0){
?>
 <div align="center"><h3>Data does not exists</h3></div>
<?php
	}
?>
<!--End of No data//-->

<!--Pagination-->
<?php
	echo $link;
?>
<!--End of Pagination//-->
