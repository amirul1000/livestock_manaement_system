<a  href="<?php echo site_url('admin/ad_image/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Ad_image'); ?></h5>
<!--Data display of ad_image with id--> 
<?php
	$c = $ad_image;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Ad</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Ad_model');
									   $dataArr = $this->CI->Ad_model->get_ad($c['ad_id']);
									   echo $dataArr['quantity'];?>
									</td></tr>

<tr><td>Image</td><td><?php
											if(is_file(APPPATH.'../public/'.$c['image'])&&file_exists(APPPATH.'../public/'.$c['image']))
											{
										 ?>
										  <img src="<?php echo base_url().'public/'.$c['image']?>" class="picture_50x50">
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


</table>
<!--End of Data display of ad_image with id//--> 