<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Ad_image'); ?></h5>
<?php
  	echo $this->session->flashdata('msg');
?>
<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/ad_image/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='<?php echo site_url('admin/ad_image/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/ad_image/search/',array("class"=>"form-horizontal")); ?>
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
   
<!--Data display of ad_image-->     
<div style="overflow-x:auto;width:100%;">      
<table class="table table-striped table-bordered">
    <tr>
		<th>Ad</th>
<th>Image</th>

		<th>Actions</th>
    </tr>
	<?php foreach($ad_image as $c){ ?>
    <tr>
		<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Ad_model');
									   $dataArr = $this->CI->Ad_model->get_ad($c['ad_id']);
									   echo $dataArr['quantity'];?>
									</td>
<td><?php
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
										</td>

		<td>
            <a href="<?php echo site_url('admin/ad_image/details/'.$c['id']); ?>"  class="action-icon"> <i class="fas fa-eye"></i></a>
            <a href="<?php echo site_url('admin/ad_image/save/'.$c['id']); ?>" class="action-icon"> <i class="fas fa-edit"></i></a>
            <a href="<?php echo site_url('admin/ad_image/remove/'.$c['id']); ?>" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="fas fa-trash"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
</div>
<!--End of Data display of ad_image//--> 

<!--No data-->
<?php
	if(count($ad_image)==0){
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
