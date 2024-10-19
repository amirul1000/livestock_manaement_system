<a  href="<?php echo site_url('admin/animal/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Animal'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/animal/save/'.$animal['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
                                    <label for="Parents Animal" class="col-md-4 control-label">Parents Animal</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Animal_model'); 
             $dataArr = $this->CI->Animal_model->get_all_animal(); 
          ?> 
          <select name="parents_animal_id"  id="parents_animal_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($animal['parents_animal_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['its_name']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                    <label for="Type" class="col-md-4 control-label">Type</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Type_model'); 
             $dataArr = $this->CI->Type_model->get_all_type(); 
          ?> 
          <select name="type_id"  id="type_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($animal['type_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['type_name']?></option> 
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
            <option value="<?=$dataArr[$i]['id']?>" <?php if($animal['breed_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['breed_name']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                    <label for="Gender" class="col-md-4 control-label">Gender</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Gender_model'); 
             $dataArr = $this->CI->Gender_model->get_all_gender(); 
          ?> 
          <select name="gender_id"  id="gender_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($animal['gender_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['gender_name']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
          <label for="Its Name" class="col-md-4 control-label">Its Name</label> 
          <div class="col-md-8"> 
           <input type="text" name="its_name" value="<?php echo ($this->input->post('its_name') ? $this->input->post('its_name') : $animal['its_name']); ?>" class="form-control" id="its_name" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Tag Code" class="col-md-4 control-label">Tag Code</label> 
          <div class="col-md-8"> 
           <input type="text" name="tag_code" value="<?php echo ($this->input->post('tag_code') ? $this->input->post('tag_code') : $animal['tag_code']); ?>" class="form-control" id="tag_code" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Age" class="col-md-4 control-label">Age</label> 
          <div class="col-md-8"> 
           <input type="text" name="age" value="<?php echo ($this->input->post('age') ? $this->input->post('age') : $animal['age']); ?>" class="form-control" id="age" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Color" class="col-md-4 control-label">Color</label> 
          <div class="col-md-8"> 
           <input type="text" name="color" value="<?php echo ($this->input->post('color') ? $this->input->post('color') : $animal['color']); ?>" class="form-control" id="color" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Weight" class="col-md-4 control-label">Weight</label> 
          <div class="col-md-8"> 
           <input type="text" name="weight" value="<?php echo ($this->input->post('weight') ? $this->input->post('weight') : $animal['weight']); ?>" class="form-control" id="weight" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Known Animal" class="col-md-4 control-label">Known Animal</label> 
          <div class="col-md-8"> 
           <input type="text" name="known_animal" value="<?php echo ($this->input->post('known_animal') ? $this->input->post('known_animal') : $animal['known_animal']); ?>" class="form-control" id="known_animal" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Information" class="col-md-4 control-label">Information</label> 
          <div class="col-md-8"> 
           <textarea  name="information"  id="information"  class="form-control" rows="4"/><?php echo ($this->input->post('information') ? $this->input->post('information') : $animal['information']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Date Of Birth" class="col-md-4 control-label">Date Of Birth</label> 
            <div class="col-md-8"> 
           <input type="text" name="date_of_birth"  id="date_of_birth"  value="<?php echo ($this->input->post('date_of_birth') ? $this->input->post('date_of_birth') : $animal['date_of_birth']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>
<div class="form-group"> 
                                        <label for="File Picture" class="col-md-4 control-label">File Picture</label> 
          <div class="col-md-8"> 
           <input type="file" name="file_picture"  id="file_picture" value="<?php echo ($this->input->post('file_picture') ? $this->input->post('file_picture') : $animal['file_picture']); ?>" class="form-control-file"/> 
          </div> 
            </div>
<div class="form-group"> 
                                        <label for="Status" class="col-md-4 control-label">Status</label> 
          <div class="col-md-8"> 
           <?php 
             $enumArr = $this->customlib->getEnumFieldValues('animal','status'); 
           ?> 
           <select name="status"  id="status"  class="form-control"/> 
             <option value="">--Select--</option> 
             <?php 
              for($i=0;$i<count($enumArr);$i++) 
              { 
             ?> 
             <option value="<?=$enumArr[$i]?>" <?php if($animal['status']==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
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
        <button type="submit" class="btn btn-success"><?php if(empty($animal['id'])){?>Save<?php }else{?>Update<?php } ?></button>
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