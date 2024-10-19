<!doctype html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Register</title>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url(); ?>public/riktheme/img/core-img/favicon.png">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/riktheme/style.css">

</head>
<!-- style="background-image: url('<?php echo base_url(); ?>public/riktheme/img/bg-img/8.jpg');"-->
<body class="dark-color-overlay bg-img">
    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- ======================================
    ******* Main Wrapper Area Start **********
    ======================================= -->
    <div class="main-content- h-100vh">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-sm-10 col-md-12 col-lg-9">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card mb-0">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="xs-d-none">
                                            <img src="<?php echo base_url(); ?>public/riktheme/img/bg-img/6.png" alt="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Logo -->
                                        <div class="card-body-login mb-30">
                                            
                                        </div>
                                        <div>
                                            <h4 class="font-24 mt-0">Free Sign Up</h4>
                                            <p class="text-muted mb-4">Create a new account</p>
                                        </div>
                                        <?=$msg?>
                                        <?php echo form_open_multipart('admin/login/register_process',array("class"=>"form-horizontal")); ?>
                                            <div class="form-group">
                                                <label for="fullname">Business Type</label>
                                                <select class="form-control" type="text" name="user_type" id="user_type" value="<?php echo ($this->input->post('user_type') ? $this->input->post('user_type') : ''); ?>" placeholder="Enter user type" required>
                                                 <option value="business">Business</option>
                                                 <option value="individual">Individual</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="fullname">First Name</label>
                                                <input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo ($this->input->post('first_name') ? $this->input->post('first_name') : ''); ?>" placeholder="Enter first name" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="fullname">Last Name</label>
                                                <input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo ($this->input->post('last_name') ? $this->input->post('last_name') : ''); ?>" placeholder="Enter last name" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="business_name">Business name</label>
                                                <input class="form-control" type="text" name="business_name" id="business_name" value="<?php echo ($this->input->post('business_name') ? $this->input->post('business_name') : ''); ?>" placeholder="Enter business name" required>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input class="form-control" type="text" name="address" id="address" value="<?php echo ($this->input->post('address') ? $this->input->post('address') : ''); ?>" placeholder="Enter address" required>
                                            </div>
                                            
                                            
                                             <div class="form-group">
                                                <label for="adress2">Adress2</label>
                                                <input class="form-control" type="text" name="adress2" id="adress2" value="<?php echo ($this->input->post('adress2') ? $this->input->post('adress2') : ''); ?>" placeholder="Enter adress2" required>
                                            </div>
                                            
                                            
                                             <div class="form-group">
                                                <label for="city">City</label>
                                                <input class="form-control" type="text" name="city" id="city" value="<?php echo ($this->input->post('city') ? $this->input->post('city') : ''); ?>" placeholder="Enter city" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <input class="form-control" type="text" name="state" id="state" value="<?php echo ($this->input->post('state') ? $this->input->post('state') : ''); ?>" placeholder="Enter state" required>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="zip">Zip</label>
                                                <input class="form-control" type="text" name="zip" id="zip" value="<?php echo ($this->input->post('zip') ? $this->input->post('zip') : ''); ?>" placeholder="Enter zip" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="phone_no">Phone no</label>
                                                <input class="form-control" type="text" name="phone_no" id="phone_no" value="<?php echo ($this->input->post('phone_no') ? $this->input->post('phone_no') : ''); ?>" placeholder="Enter phone_no" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="emailaddress">Email address</label>
                                                <input class="form-control" type="email" name="email" id="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : ''); ?>" required placeholder="Enter your email">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input class="form-control" type="password" name="password" id="password" value="<?php echo ($this->input->post('password') ? $this->input->post('password') : ''); ?>" required  placeholder="Enter your password">
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1"><span class="font-16">I accept <a href="" class="text-muted">Terms and Conditions</a></span></label>
                                                </div>
                                            </div>

                                            <div class="form-group mb-0 text-center">
                                                <button class="btn btn-primary btn-block" type="submit"> Sign Up </button>
                                            </div>

                                        <?php echo form_close(); ?>
                                        
                                        <a href="<?php echo site_url(); ?>/admin/login/index" class="text-dark float-right"><span class="font-12 text-primary">Back
                                        </span></a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================
    ********* Page Wrapper Area End ***********
    ======================================= -->

   
    <!-- Must needed plugins to the run this Template -->
    <script src="<?php echo base_url(); ?>public/riktheme/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/riktheme/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>public/riktheme/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/riktheme/js/bundle.js"></script>

    <!-- Active JS -->
    <script src="<?php echo base_url(); ?>public/riktheme/js/default-assets/active.js"></script>

</body>


</html>