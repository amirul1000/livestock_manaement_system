<!--begin::Toolbar--><div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">	<!--begin::Toolbar container-->	<div id="kt_app_toolbar_container"		class="app-container container-xxl d-flex flex-stack">		<!--begin::Page title-->		<div			class="page-title d-flex flex-column justify-content-center flex-wrap me-3">			<!--begin::Title-->			<h1				class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">My				Profile</h1>			<!--end::Title-->			<!--begin::Breadcrumb-->			<ul				class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">				<!--begin::Item-->				<li class="breadcrumb-item text-muted"><a					href="<?php echo site_url('admin/homecontroller'); ?>"					class="text-muted text-hover-primary">Home</a></li>				<!--end::Item-->				<!--begin::Item-->				<li class="breadcrumb-item"><span					class="bullet bg-gray-400 w-5px h-2px"></span></li>				<!--end::Item-->				<!--begin::Item-->				<li class="breadcrumb-item text-muted">My Profile</li>				<!--end::Item-->			</ul>			<!--end::Breadcrumb-->		</div>		<!--end::Page title-->	</div></div><div id="kt_app_content" class="app-content flex-column-fluid">	<!--begin::Content container-->	<div id="kt_app_content_container" class="app-container container-xxl">		<!--begin::Row-->		<div class="row g-5 g-xl-8">			<div class="col-xl-12">				<!--<h5 class="font-20 mt-15 mb-1">Profile</h5>-->				<div style="clear: both;"></div>				<div class="table-responsive">					<table class="table table-striped table-bordered">						<tr>							<td>Email</td>							<td><?php echo $users['email'] ?></td>						</tr>						<tr>							<td>Title</td>							<td><?php echo $users['title'] ?></td>						</tr>						<tr>							<td>First Name</td>							<td><?php echo $users['first_name'] ?></td>						</tr>						<tr>							<td>Last Name</td>							<td><?php echo $users['last_name'] ?></td>						</tr>						<tr>							<td>File Picture</td>							<td>
		     <?php

    if (is_file(APPPATH . '../public/' . $users['file_picture']) && file_exists(APPPATH . '../public/' . $users['file_picture'])) {

        ?>
			  <img src="<?php echo base_url().'public/'.$users['file_picture']?>"								style="width: 100px; height: 100px;">
			  <?php
    } else {

        ?>
            <img								src="<?php echo base_url()?>public/uploads/no_image.jpg"								style="width: 100px; height: 100px;">
            <?php
    }

    ?>	
        </td>						</tr>						<tr>							<td>Phone No</td>							<td><?php echo $users['phone_no'] ?></td>						</tr>						<tr>							<td>Dob</td>							<td><?php echo $users['dob'] ?></td>						</tr>						<tr>							<td>Company</td>							<td><?php echo $users['company'] ?></td>						</tr>						<tr>							<td>Address</td>							<td><?php echo $users['address'] ?></td>						</tr>						<tr>							<td>City</td>							<td><?php echo $users['city'] ?></td>						</tr>						<tr>							<td>State</td>							<td><?php echo $users['state'] ?></td>						</tr>						<tr>							<td>Zip</td>							<td><?php echo $users['zip'] ?></td>						</tr>						<tr>							<td>Country</td>							<td><?php

    $this->CI = & get_instance();

    $this->CI->load->database();

    $this->CI->load->model('Country_model');

    $dataArr = $this->CI->Country_model->get_country($users['country_id']);

    echo $dataArr['country'];

    ?>
        </td>						</tr>						<tr>							<td>Created At</td>							<td><?php echo $users['created_at'] ?></td>						</tr>						<tr>							<td>Updated At</td>							<td><?php echo $users['updated_at'] ?></td>						</tr>						<tr>							<td>User Type</td>							<td><?php echo $users['user_type'] ?></td>						</tr>						<tr>							<td>Status</td>							<td><?php echo $users['status'] ?></td>						</tr>						<tr>							<td>Action</td>							<td><a								href="<?php echo site_url('admin/profile/save/'.$users['id']); ?>"								class="btn btn-info btn-xs">Edit</a></td>						</tr>					</table>				</div>			</div>		</div>	</div></div>