<a  href="<?php echo site_url('admin/transactions/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Transactions'); ?></h5>
<!--Data display of transactions with id--> 
<?php
	$c = $transactions;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Animal</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Animal_model');
									   $dataArr = $this->CI->Animal_model->get_animal($c['animal_id']);
									   echo $dataArr['its_name'];?>
									</td></tr>

<tr><td>Subject</td><td><?php echo $c['subject']; ?></td></tr>

<tr><td>Description</td><td><?php echo $c['description']; ?></td></tr>

<tr><td>Debit</td><td><?php echo $c['debit']; ?></td></tr>

<tr><td>Credit</td><td><?php echo $c['credit']; ?></td></tr>

<tr><td>Refference</td><td><?php echo $c['refference']; ?></td></tr>

<tr><td>Created At</td><td><?php echo $c['created_at']; ?></td></tr>

<tr><td>Updated At</td><td><?php echo $c['updated_at']; ?></td></tr>


</table>
<!--End of Data display of transactions with id//--> 