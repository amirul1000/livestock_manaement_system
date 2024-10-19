<a  href="<?php echo site_url('admin/events/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Events'); ?></h5>
<!--Data display of events with id--> 
<?php
	$c = $events;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Animal</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Animal_model');
									   $dataArr = $this->CI->Animal_model->get_animal($c['animal_id']);
									   echo $dataArr['its_name'];?>
									</td></tr>

<tr><td>Insemination</td><td><?php echo $c['insemination']; ?></td></tr>

<tr><td>Insemination Date</td><td><?php echo $c['insemination_date']; ?></td></tr>

<tr><td>Pregnancies</td><td><?php echo $c['pregnancies']; ?></td></tr>

<tr><td>Pregnancies Date</td><td><?php echo $c['pregnancies_date']; ?></td></tr>

<tr><td>Treatments</td><td><?php echo $c['treatments']; ?></td></tr>

<tr><td>Treatments Date</td><td><?php echo $c['treatments_date']; ?></td></tr>

<tr><td>Vaccinations</td><td><?php echo $c['vaccinations']; ?></td></tr>

<tr><td>Vaccinations Date</td><td><?php echo $c['vaccinations_date']; ?></td></tr>

<tr><td>Castrations</td><td><?php echo $c['castrations']; ?></td></tr>

<tr><td>Castrations Date</td><td><?php echo $c['castrations_date']; ?></td></tr>

<tr><td>Weighing</td><td><?php echo $c['weighing']; ?></td></tr>

<tr><td>Weighing Date</td><td><?php echo $c['weighing_date']; ?></td></tr>

<tr><td>Spraying</td><td><?php echo $c['spraying']; ?></td></tr>

<tr><td>Spraying Date</td><td><?php echo $c['spraying_date']; ?></td></tr>

<tr><td>Births</td><td><?php echo $c['births']; ?></td></tr>

<tr><td>Births Date</td><td><?php echo $c['births_date']; ?></td></tr>

<tr><td>Created At</td><td><?php echo $c['created_at']; ?></td></tr>

<tr><td>Updated At</td><td><?php echo $c['updated_at']; ?></td></tr>


</table>
<!--End of Data display of events with id//--> 