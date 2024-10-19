<a  href="<?php echo site_url('admin/transactions/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Transactions'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/transactions/save/'.$transactions['id'],array("class"=>"form-horizontal")); ?>
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
            <option value="<?=$dataArr[$i]['id']?>" <?php if($transactions['animal_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['its_name']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
          <label for="Subject" class="col-md-4 control-label">Subject</label> 
          <div class="col-md-8"> 
           <input type="text" name="subject" value="<?php echo ($this->input->post('subject') ? $this->input->post('subject') : $transactions['subject']); ?>" class="form-control" id="subject" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Description" class="col-md-4 control-label">Description</label> 
          <div class="col-md-8"> 
           <textarea  name="description"  id="description"  class="form-control" rows="4"/><?php echo ($this->input->post('description') ? $this->input->post('description') : $transactions['description']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Debit" class="col-md-4 control-label">Debit</label> 
          <div class="col-md-8"> 
           <input type="text" name="debit" value="<?php echo ($this->input->post('debit') ? $this->input->post('debit') : $transactions['debit']); ?>" class="form-control" id="debit" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Credit" class="col-md-4 control-label">Credit</label> 
          <div class="col-md-8"> 
           <input type="text" name="credit" value="<?php echo ($this->input->post('credit') ? $this->input->post('credit') : $transactions['credit']); ?>" class="form-control" id="credit" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Refference" class="col-md-4 control-label">Refference</label> 
          <div class="col-md-8"> 
           <textarea  name="refference"  id="refference"  class="form-control" rows="4"/><?php echo ($this->input->post('refference') ? $this->input->post('refference') : $transactions['refference']); ?></textarea> 
          </div> 
           </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($transactions['id'])){?>Save<?php }else{?>Update<?php } ?></button>
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