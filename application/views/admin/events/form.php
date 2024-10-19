<a  href="<?php echo site_url('admin/events/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Events'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/events/save/'.$events['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
                                    <label for="Animal" class="col-md-4 control-label">Animal</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Animal_model'); 
             $dataArr = $this->CI->Animal_model->get_all_animal(); 
          ?> 
          <select name="animal_id"  id="animal_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($events['animal_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['its_name']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                        <label for="Insemination" class="col-md-4 control-label">Insemination</label> 
          <div class="col-md-8"> 
           <textarea  name="insemination"  id="insemination"  class="form-control" rows="4"/><?php echo ($this->input->post('insemination') ? $this->input->post('insemination') : $events['insemination']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Insemination Date" class="col-md-4 control-label">Insemination Date</label> 
            <div class="col-md-8"> 
           <input type="text" name="insemination_date"  id="insemination_date"  value="<?php echo ($this->input->post('insemination_date') ? $this->input->post('insemination_date') : $events['insemination_date']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>
<div class="form-group"> 
                                        <label for="Pregnancies" class="col-md-4 control-label">Pregnancies</label> 
          <div class="col-md-8"> 
           <textarea  name="pregnancies"  id="pregnancies"  class="form-control" rows="4"/><?php echo ($this->input->post('pregnancies') ? $this->input->post('pregnancies') : $events['pregnancies']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Pregnancies Date" class="col-md-4 control-label">Pregnancies Date</label> 
            <div class="col-md-8"> 
           <input type="text" name="pregnancies_date"  id="pregnancies_date"  value="<?php echo ($this->input->post('pregnancies_date') ? $this->input->post('pregnancies_date') : $events['pregnancies_date']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>
<div class="form-group"> 
                                        <label for="Treatments" class="col-md-4 control-label">Treatments</label> 
          <div class="col-md-8"> 
           <textarea  name="treatments"  id="treatments"  class="form-control" rows="4"/><?php echo ($this->input->post('treatments') ? $this->input->post('treatments') : $events['treatments']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Treatments Date" class="col-md-4 control-label">Treatments Date</label> 
            <div class="col-md-8"> 
           <input type="text" name="treatments_date"  id="treatments_date"  value="<?php echo ($this->input->post('treatments_date') ? $this->input->post('treatments_date') : $events['treatments_date']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>
<div class="form-group"> 
                                        <label for="Vaccinations" class="col-md-4 control-label">Vaccinations</label> 
          <div class="col-md-8"> 
           <textarea  name="vaccinations"  id="vaccinations"  class="form-control" rows="4"/><?php echo ($this->input->post('vaccinations') ? $this->input->post('vaccinations') : $events['vaccinations']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Vaccinations Date" class="col-md-4 control-label">Vaccinations Date</label> 
            <div class="col-md-8"> 
           <input type="text" name="vaccinations_date"  id="vaccinations_date"  value="<?php echo ($this->input->post('vaccinations_date') ? $this->input->post('vaccinations_date') : $events['vaccinations_date']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>
<div class="form-group"> 
                                        <label for="Castrations" class="col-md-4 control-label">Castrations</label> 
          <div class="col-md-8"> 
           <textarea  name="castrations"  id="castrations"  class="form-control" rows="4"/><?php echo ($this->input->post('castrations') ? $this->input->post('castrations') : $events['castrations']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Castrations Date" class="col-md-4 control-label">Castrations Date</label> 
            <div class="col-md-8"> 
           <input type="text" name="castrations_date"  id="castrations_date"  value="<?php echo ($this->input->post('castrations_date') ? $this->input->post('castrations_date') : $events['castrations_date']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>
<div class="form-group"> 
                                        <label for="Weighing" class="col-md-4 control-label">Weighing</label> 
          <div class="col-md-8"> 
           <textarea  name="weighing"  id="weighing"  class="form-control" rows="4"/><?php echo ($this->input->post('weighing') ? $this->input->post('weighing') : $events['weighing']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Weighing Date" class="col-md-4 control-label">Weighing Date</label> 
            <div class="col-md-8"> 
           <input type="text" name="weighing_date"  id="weighing_date"  value="<?php echo ($this->input->post('weighing_date') ? $this->input->post('weighing_date') : $events['weighing_date']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>
<div class="form-group"> 
                                        <label for="Spraying" class="col-md-4 control-label">Spraying</label> 
          <div class="col-md-8"> 
           <textarea  name="spraying"  id="spraying"  class="form-control" rows="4"/><?php echo ($this->input->post('spraying') ? $this->input->post('spraying') : $events['spraying']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Spraying Date" class="col-md-4 control-label">Spraying Date</label> 
            <div class="col-md-8"> 
           <input type="text" name="spraying_date"  id="spraying_date"  value="<?php echo ($this->input->post('spraying_date') ? $this->input->post('spraying_date') : $events['spraying_date']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>
<div class="form-group"> 
                                        <label for="Births" class="col-md-4 control-label">Births</label> 
          <div class="col-md-8"> 
           <textarea  name="births"  id="births"  class="form-control" rows="4"/><?php echo ($this->input->post('births') ? $this->input->post('births') : $events['births']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Births Date" class="col-md-4 control-label">Births Date</label> 
            <div class="col-md-8"> 
           <input type="text" name="births_date"  id="births_date"  value="<?php echo ($this->input->post('births_date') ? $this->input->post('births_date') : $events['births_date']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($events['id'])){?>Save<?php }else{?>Update<?php } ?></button>
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