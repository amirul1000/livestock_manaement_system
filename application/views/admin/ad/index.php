<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Ad'); ?></h5>
<?php
  	echo $this->session->flashdata('msg');
?>
<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/ad/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='<?php echo site_url('admin/ad/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/ad/search/',array("class"=>"form-horizontal")); ?>
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
   
<!--Data display of ad-->     
<div style="overflow-x:auto;width:100%;">      
<table class="table table-striped table-bordered">
    <tr>
		<th>Users</th>
<th>Breed</th>
<th>Quantity</th>
<th>Gender</th>
<th>Known Animal</th>
<th>Its Name</th>
<th>Age</th>
<th>Slaugter</th>
<th>Information</th>
<th>Sold Status</th>

		<th>Actions</th>
    </tr>
	<?php foreach($ad as $c){ ?>
    <tr>
		<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Users_model');
									   $dataArr = $this->CI->Users_model->get_users($c['users_id']);
									   echo $dataArr['email'];?>
									</td>
<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Breed_model');
									   $dataArr = $this->CI->Breed_model->get_breed($c['breed_id']);
									   echo $dataArr['breed_name'];?>
									</td>
<td><?php echo $c['quantity']; ?></td>
<td><?php echo $c['gender']; ?></td>
<td><?php echo $c['known_animal']; ?></td>
<td><?php echo $c['its_name']; ?></td>
<td><?php echo $c['age']; ?></td>
<td><?php echo $c['slaugter']; ?></td>
<td><?php echo $c['information']; ?></td>
<td><?php echo $c['sold_status']; ?></td>

		<td>
            <a href="<?php echo site_url('admin/ad/details/'.$c['id']); ?>"  class="action-icon"> <i class="fas fa-eye"></i></a>
            <a href="<?php echo site_url('admin/ad/save/'.$c['id']); ?>" class="action-icon"> <i class="fas fa-edit"></i></a>
            <a href="<?php echo site_url('admin/ad/remove/'.$c['id']); ?>" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="fas fa-trash"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
</div>
<!--End of Data display of ad//--> 

<!--No data-->
<?php
	if(count($ad)==0){
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
