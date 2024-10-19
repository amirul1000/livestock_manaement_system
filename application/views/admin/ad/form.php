<a  href="<?php echo site_url('admin/ad/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Ad'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/ad/save/'.$ad['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
                                    <label for="Users" class="col-md-4 control-label">Users</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Users_model'); 
             $dataArr = $this->CI->Users_model->get_all_users(); 
          ?> 
          <select name="users_id"  id="users_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($ad['users_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['email']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                    <label for="Breed" class="col-md-4 control-label">Breed</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Breed_model'); 
             $dataArr = $this->CI->Breed_model->get_all_breed(); 
          ?> 
          <select name="breed_id"  id="breed_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($ad['breed_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['breed_name']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
          <label for="Quantity" class="col-md-4 control-label">Quantity</label> 
          <div class="col-md-8"> 
           <input type="text" name="quantity" value="<?php echo ($this->input->post('quantity') ? $this->input->post('quantity') : $ad['quantity']); ?>" class="form-control" id="quantity" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Gender" class="col-md-4 control-label">Gender</label> 
          <div class="col-md-8"> 
           <input type="text" name="gender" value="<?php echo ($this->input->post('gender') ? $this->input->post('gender') : $ad['gender']); ?>" class="form-control" id="gender" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Known Animal" class="col-md-4 control-label">Known Animal</label> 
          <div class="col-md-8"> 
           <input type="text" name="known_animal" value="<?php echo ($this->input->post('known_animal') ? $this->input->post('known_animal') : $ad['known_animal']); ?>" class="form-control" id="known_animal" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Its Name" class="col-md-4 control-label">Its Name</label> 
          <div class="col-md-8"> 
           <input type="text" name="its_name" value="<?php echo ($this->input->post('its_name') ? $this->input->post('its_name') : $ad['its_name']); ?>" class="form-control" id="its_name" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Age" class="col-md-4 control-label">Age</label> 
          <div class="col-md-8"> 
           <input type="text" name="age" value="<?php echo ($this->input->post('age') ? $this->input->post('age') : $ad['age']); ?>" class="form-control" id="age" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Slaugter" class="col-md-4 control-label">Slaugter</label> 
          <div class="col-md-8"> 
           <input type="text" name="slaugter" value="<?php echo ($this->input->post('slaugter') ? $this->input->post('slaugter') : $ad['slaugter']); ?>" class="form-control" id="slaugter" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Information" class="col-md-4 control-label">Information</label> 
          <div class="col-md-8"> 
           <textarea  name="information"  id="information"  class="form-control" rows="4"/><?php echo ($this->input->post('information') ? $this->input->post('information') : $ad['information']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Sold Status" class="col-md-4 control-label">Sold Status</label> 
          <div class="col-md-8"> 
           <?php 
             $enumArr = $this->customlib->getEnumFieldValues('ad','sold_status'); 
           ?> 
           <select name="sold_status"  id="sold_status"  class="form-control"/> 
             <option value="">--Select--</option> 
             <?php 
              for($i=0;$i<count($enumArr);$i++) 
              { 
             ?> 
             <option value="<?=$enumArr[$i]?>" <?php if($ad['sold_status']==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
             <?php 
              } 
             ?> 
           </select> 
          </div> 
            </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($ad['id'])){?>Save<?php }else{?>Update<?php } ?></button>
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