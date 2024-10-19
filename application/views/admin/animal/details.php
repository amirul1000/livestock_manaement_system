<a  href="<?php echo site_url('admin/animal/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Animal'); ?></h5>
<!--Data display of animal with id--> 
<?php
	$c = $animal;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Parents Animal</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Animal_model');
									   $dataArr = $this->CI->Animal_model->get_animal($c['parents_animal_id']);
									   echo $dataArr['its_name'];?>
									</td></tr>

<tr><td>Type</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Type_model');
									   $dataArr = $this->CI->Type_model->get_type($c['type_id']);
									   echo $dataArr['type_name'];?>
									</td></tr>

<tr><td>Breed</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Breed_model');
									   $dataArr = $this->CI->Breed_model->get_breed($c['breed_id']);
									   echo $dataArr['breed_name'];?>
									</td></tr>

<tr><td>Gender</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Gender_model');
									   $dataArr = $this->CI->Gender_model->get_gender($c['gender_id']);
									   echo $dataArr['gender_name'];?>
									</td></tr>

<tr><td>Its Name</td><td><?php echo $c['its_name']; ?></td></tr>

<tr><td>Tag Code</td><td><?php echo $c['tag_code']; ?></td></tr>

<tr><td>Age</td><td><?php echo $c['age']; ?></td></tr>

<tr><td>Color</td><td><?php echo $c['color']; ?></td></tr>

<tr><td>Weight</td><td><?php echo $c['weight']; ?></td></tr>

<tr><td>Known Animal</td><td><?php echo $c['known_animal']; ?></td></tr>

<tr><td>Information</td><td><?php echo $c['information']; ?></td></tr>

<tr><td>Date Of Birth</td><td><?php echo $c['date_of_birth']; ?></td></tr>

<tr><td>File Picture</td><td><?php
											if(is_file(APPPATH.'../public/'.$c['file_picture'])&&file_exists(APPPATH.'../public/'.$c['file_picture']))
											{
										 ?>
										  <img src="<?php echo base_url().'public/'.$c['file_picture']?>" class="picture_50x50">
										  <?php
											}
											else
											{
										?>
										<img src="<?php echo base_url()?>public/uploads/no_image.jpg" class="picture_50x50">
										<?php		
											}
										  ?>	
										</td></tr>

<tr><td>Status</td><td><?php echo $c['status']; ?></td></tr>

<tr><td>Created At</td><td><?php echo $c['created_at']; ?></td></tr>

<tr><td>Updated At</td><td><?php echo $c['updated_at']; ?></td></tr>


</table>
<!--End of Data display of animal with id//--> 