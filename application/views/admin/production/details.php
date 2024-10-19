<a  href="<?php echo site_url('admin/production/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Production'); ?></h5>
<!--Data display of production with id--> 
<?php
	$c = $production;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Animal</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Animal_model');
									   $dataArr = $this->CI->Animal_model->get_animal($c['animal_id']);
									   echo $dataArr['age'];?>
									</td></tr>

<tr><td>Production Type</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Production_type_model');
									   $dataArr = $this->CI->Production_type_model->get_production_type($c['production_type_id']);
									   echo $dataArr['production_type_name'];?>
									</td></tr>

<tr><td>Weight</td><td><?php echo $c['weight']; ?></td></tr>

<tr><td>Description</td><td><?php echo $c['description']; ?></td></tr>

<tr><td>Created At</td><td><?php echo $c['created_at']; ?></td></tr>

<tr><td>Updated At</td><td><?php echo $c['updated_at']; ?></td></tr>


</table>
<!--End of Data display of production with id//--> 