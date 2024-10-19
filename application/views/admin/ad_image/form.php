<a  href="<?php echo site_url('admin/ad_image/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Ad_image'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/ad_image/save/'.$ad_image['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
                                    <label for="Ad" class="col-md-4 control-label">Ad</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Ad_model'); 
             $dataArr = $this->CI->Ad_model->get_all_ad(); 
          ?> 
          <select name="ad_id"  id="ad_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($ad_image['ad_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['quantity']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                        <label for="Image" class="col-md-4 control-label">Image</label> 
          <div class="col-md-8"> 
           <input type="file" name="image"  id="image" value="<?php echo ($this->input->post('image') ? $this->input->post('image') : $ad_image['image']); ?>" class="form-control-file"/> 
          </div> 
            </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($ad_image['id'])){?>Save<?php }else{?>Update<?php } ?></button>
    </div>
</div>
<?php echo form_close(); ?>
<!--End of Form to save data//-->	
<!--JQuery-->
<script>
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '<?php echo base_url(); ?>public/datepicker/images/calendar.gif',
	});
</script>  			