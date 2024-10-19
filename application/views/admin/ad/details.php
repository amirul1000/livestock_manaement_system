<a  href="<?php echo site_url('admin/ad/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Ad'); ?></h5>
<!--Data display of ad with id--> 
<?php
	$c = $ad;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Users</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Users_model');
									   $dataArr = $this->CI->Users_model->get_users($c['users_id']);
									   echo $dataArr['email'];?>
									</td></tr>

<tr><td>Breed</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Breed_model');
									   $dataArr = $this->CI->Breed_model->get_breed($c['breed_id']);
									   echo $dataArr['breed_name'];?>
									</td></tr>

<tr><td>Quantity</td><td><?php echo $c['quantity']; ?></td></tr>

<tr><td>Gender</td><td><?php echo $c['gender']; ?></td></tr>

<tr><td>Known Animal</td><td><?php echo $c['known_animal']; ?></td></tr>

<tr><td>Its Name</td><td><?php echo $c['its_name']; ?></td></tr>

<tr><td>Age</td><td><?php echo $c['age']; ?></td></tr>

<tr><td>Slaugter</td><td><?php echo $c['slaugter']; ?></td></tr>

<tr><td>Information</td><td><?php echo $c['information']; ?></td></tr>

<tr><td>Sold Status</td><td><?php echo $c['sold_status']; ?></td></tr>

<tr><td>Created At</td><td><?php echo $c['created_at']; ?></td></tr>

<tr><td>Updated At</td><td><?php echo $c['updated_at']; ?></td></tr>


</table>
<!--End of Data display of ad with id//--> 