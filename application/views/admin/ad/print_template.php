<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Ad'); ?></h3>
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
<!--Data display of ad-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
    <tr>
		<th>Users</th>
<th>Breed</th>
<th>Quantity</th>
<th>Gender</th>
<th>Known Animal</th>
<th>Its Name</th>
<th>Age</th>
<th>Slaugter</th>
<th>Information</th>
<th>Sold Status</th>

    </tr>
	<?php foreach($ad as $c){ ?>
    <tr>
		<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Users_model');
									   $dataArr = $this->CI->Users_model->get_users($c['users_id']);
									   echo $dataArr['email'];?>
									</td>
<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Breed_model');
									   $dataArr = $this->CI->Breed_model->get_breed($c['breed_id']);
									   echo $dataArr['breed_name'];?>
									</td>
<td><?php echo $c['quantity']; ?></td>
<td><?php echo $c['gender']; ?></td>
<td><?php echo $c['known_animal']; ?></td>
<td><?php echo $c['its_name']; ?></td>
<td><?php echo $c['age']; ?></td>
<td><?php echo $c['slaugter']; ?></td>
<td><?php echo $c['information']; ?></td>
<td><?php echo $c['sold_status']; ?></td>

    </tr>
	<?php } ?>
</table>
<!--End of Data display of ad//--> 