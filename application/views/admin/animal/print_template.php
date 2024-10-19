<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Animal'); ?></h3>
Date: <?php echo date("Y-m-d");?>
<hr>
<!--*************************************************
*********mpdf header footer page no******************
****************************************************-->
<htmlpageheader name="firstpage" class="hide">
</htmlpageheader>

<htmlpageheader name="otherpages" class="hide">
    <span class="float_left"></span>
    <span  class="padding_5"> &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp;</span>
    <span class="float_right"></span>         
</htmlpageheader>      
<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" /> 
   
<htmlpagefooter name="myfooter"  class="hide">                          
     <div align="center">
               <br><span class="padding_10">Page {PAGENO} of {nbpg}</span> 
     </div>
</htmlpagefooter>    

<sethtmlpagefooter name="myfooter" value="on" />
<!--*************************************************
*********#////mpdf header footer page no******************
****************************************************-->
<!--Data display of animal-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
    <tr>
		<th>Parents Animal</th>
<th>Type</th>
<th>Breed</th>
<th>Gender</th>
<th>Its Name</th>
<th>Tag Code</th>
<th>Age</th>
<th>Color</th>
<th>Weight</th>
<th>Known Animal</th>
<th>Information</th>
<th>Date Of Birth</th>
<th>File Picture</th>
<th>Status</th>

    </tr>
	<?php foreach($animal as $c){ ?>
    <tr>
		<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Animal_model');
									   $dataArr = $this->CI->Animal_model->get_animal($c['parents_animal_id']);
									   echo $dataArr['its_name'];?>
									</td>
<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Type_model');
									   $dataArr = $this->CI->Type_model->get_type($c['type_id']);
									   echo $dataArr['type_name'];?>
									</td>
<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Breed_model');
									   $dataArr = $this->CI->Breed_model->get_breed($c['breed_id']);
									   echo $dataArr['breed_name'];?>
									</td>
<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Gender_model');
									   $dataArr = $this->CI->Gender_model->get_gender($c['gender_id']);
									   echo $dataArr['gender_name'];?>
									</td>
<td><?php echo $c['its_name']; ?></td>
<td><?php echo $c['tag_code']; ?></td>
<td><?php echo $c['age']; ?></td>
<td><?php echo $c['color']; ?></td>
<td><?php echo $c['weight']; ?></td>
<td><?php echo $c['known_animal']; ?></td>
<td><?php echo $c['information']; ?></td>
<td><?php echo $c['date_of_birth']; ?></td>
<td><?php
											if(is_file(APPPATH.'../public/'.$c['file_picture'])&&file_exists(APPPATH.'../public/'.$c['file_picture']))
											{
										 ?>
										  <img src="<?php echo base_url().'public/'.$c['file_picture']?>" class="picture_50x50">
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
<td><?php echo $c['status']; ?></td>

    </tr>
	<?php } ?>
</table>
<!--End of Data display of animal//--> 