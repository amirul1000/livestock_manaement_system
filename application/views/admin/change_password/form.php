<link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"><script	src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script><!--begin::Toolbar--><div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">	<!--begin::Toolbar container-->	<div id="kt_app_toolbar_container"		class="app-container container-xxl d-flex flex-stack">		<!--begin::Page title-->		<div			class="page-title d-flex flex-column justify-content-center flex-wrap me-3">			<!--begin::Title-->			<h1				class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Profile</h1>			<!--end::Title-->			<!--begin::Breadcrumb-->			<ul				class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">				<!--begin::Item-->				<li class="breadcrumb-item text-muted"><a					href="<?php echo site_url('admin/homecontroller'); ?>"					class="text-muted text-hover-primary">Home</a></li>				<!--end::Item-->				<!--begin::Item-->				<li class="breadcrumb-item"><span					class="bullet bg-gray-400 w-5px h-2px"></span></li>				<!--end::Item-->				<!--begin::Item-->				<li class="breadcrumb-item text-muted">Change Password</li>				<!--end::Item-->			</ul>			<!--end::Breadcrumb-->		</div>		<!--end::Page title-->	</div></div><div id="kt_app_content" class="app-content flex-column-fluid">	<!--begin::Content container-->	<div id="kt_app_content_container" class="app-container container-xxl">		<!--begin::Row-->		<div class="row g-5 g-xl-8">			<div class="col-xl-12">				<!--<h5 class="font-20 mt-15 mb-1">Change Password</h5>-->
<?php

echo $this->session->flashdata('msg');

?>
<?php echo form_open_multipart('admin/change_password/save/'.$users['id'],array("class"=>"form-horizontal","onSubmit"=>"return CheckPassword();")); ?>
<br>&nbsp;</br>				<div class="form-group">					<label for="Password" class="col-md-4 control-label">Old Password</label>					<div class="col-md-8">						<input type="password" name="old_password"							value="<?php echo ($this->input->post('old_password') ? $this->input->post('old_password') : ''); ?>"							class="form-control" id="old_password"							placeholder="Enter old password" required />					</div>				</div>				<div class="form-group">					<label for="Password" class="col-md-4 control-label">New Password</label>					<div class="col-md-8">						<input type="password" name="password"							value="<?php echo ($this->input->post('password') ? $this->input->post('password') : ''); ?>"							class="form-control" id="password"							placeholder="Enter new password" required />					</div>				</div>				<div class="form-group">					<label for="Password" class="col-md-4 control-label">Confirm						Password</label>					<div class="col-md-8">						<input class="form-control" type="password"							name="confirm_password" id="confirm_password"							value="<?php echo ($this->input->post('password') ? $this->input->post('password') : ''); ?>"							placeholder="Re-enter new password" required>					</div>				</div>				<br>&nbsp;</br>				<div class="form-group">					<div class="col-sm-offset-4 col-sm-8">						<button type="submit" class="btn btn-success"><?php if(empty($users['id'])){?>Save<?php }else{?>Update<?php } ?></button>					</div>				</div>

<?php echo form_close(); ?>

</div>		</div>	</div></div><script>
	function CheckPassword() 
    { 
	   
		if($("#password").val()!=$("#confirm_password").val())
		{
			toastr.error("Password and confirm password is mismatched");
			return false;
		}
	   return true;
		/*inputtxt = $("#password").val();
		var decimal=  /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,15}/;
		if(inputtxt.match(decimal)) 
		{ 
		  return true;
		}
		else
		{ 
		   toastr.error('Wrong...!8 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit')
		  return false;
		}*/
  } 
</script>