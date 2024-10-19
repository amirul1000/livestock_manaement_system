<a  href="<?php echo site_url('admin/ad_video/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Ad_video'); ?></h5>
<!--Data display of ad_video with id--> 
<?php
	$c = $ad_video;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Ad</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Ad_model');
									   $dataArr = $this->CI->Ad_model->get_ad($c['ad_id']);
									   echo $dataArr['quantity'];?>
									</td></tr>

<tr><td>Video</td><td><?php echo $c['video']; ?></td></tr>


</table>
<!--End of Data display of ad_video with id//--> 