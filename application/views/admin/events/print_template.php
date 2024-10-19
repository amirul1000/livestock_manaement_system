<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Events'); ?></h3>
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
<!--Data display of events-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
    <tr>
		<th>Animal</th>
<th>Insemination</th>
<th>Insemination Date</th>
<th>Pregnancies</th>
<th>Pregnancies Date</th>
<th>Treatments</th>
<th>Treatments Date</th>
<th>Vaccinations</th>
<th>Vaccinations Date</th>
<th>Castrations</th>
<th>Castrations Date</th>
<th>Weighing</th>
<th>Weighing Date</th>
<th>Spraying</th>
<th>Spraying Date</th>
<th>Births</th>
<th>Births Date</th>

    </tr>
	<?php foreach($events as $c){ ?>
    <tr>
		<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Animal_model');
									   $dataArr = $this->CI->Animal_model->get_animal($c['animal_id']);
									   echo $dataArr['its_name'];?>
									</td>
<td><?php echo $c['insemination']; ?></td>
<td><?php echo $c['insemination_date']; ?></td>
<td><?php echo $c['pregnancies']; ?></td>
<td><?php echo $c['pregnancies_date']; ?></td>
<td><?php echo $c['treatments']; ?></td>
<td><?php echo $c['treatments_date']; ?></td>
<td><?php echo $c['vaccinations']; ?></td>
<td><?php echo $c['vaccinations_date']; ?></td>
<td><?php echo $c['castrations']; ?></td>
<td><?php echo $c['castrations_date']; ?></td>
<td><?php echo $c['weighing']; ?></td>
<td><?php echo $c['weighing_date']; ?></td>
<td><?php echo $c['spraying']; ?></td>
<td><?php echo $c['spraying_date']; ?></td>
<td><?php echo $c['births']; ?></td>
<td><?php echo $c['births_date']; ?></td>

    </tr>
	<?php } ?>
</table>
<!--End of Data display of events//--> 