<?php	include 'header.php'; ?>
<div id="main" role="main">

	<!-- MAIN CONTENT -->
	<div id="content" class="container">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
				<h1 class="txt-color-red login-header-big">ERCASConnect Control Module</h1>
				<div class="hero">
					<div class="pull-left login-desc-box-l">
						<h4 class="paragraph-header">It's okay to be Smart. Experience the simplicity of ERCASConnect Admin, everywhere you go!</h4>
						
					</div>					

				</div>

				<div class="row">
					<!--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<h5 class="about-heading">About ERCASConnect</h5>
						<p>
							Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi voluptatem accusantium!
						</p>
					</div>-->
					<!--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<h5 class="about-heading">Designed for Biller Management efficiency.</h5>
						<p>
							Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi voluptatem accusantium!
						</p>
					</div>-->
				</div>

			</div>
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
				<div class="well no-padding">
					<form action="<?php echo site_url('login');?>" id="login-form" class="smart-form client-form" method="post">
						<header>
							Sign In
						</header>
						<fieldset>
							
							<section>
								<label class="label">E-mail</label>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="email" name="email">
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address</b></label>
							</section>

							<section>
								<label class="label">Password</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="password">
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
								<div class="note">
									<!--<a href="forgotpassword.html">Forgot password?</a>-->
								</div>
							</section>

							<section>
								<!--<label class="checkbox">
									<input type="checkbox" name="remember" checked="">
									<i></i>Stay signed in</label>-->
							</section>
						</fieldset>
						<footer>
							<button type="submit" class="btn btn-primary">
								Sign in
							</button>
						</footer>
					</form>

				</div>
			</div>
		</div>
	</div>

	</div>
	<!--================================================== -->	

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script src="<?php echo base_url('assets/js/plugin/pace/pace.min.js');?>"></script>

	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script> if (!window.jQuery) { document.write('<script src="<?php echo base_url('assets/js/libs/jquery-2.1.1.min.js');?>"><\/script>');} </script>

	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script> if (!window.jQuery.ui) { document.write('<script src="<?php echo base_url('assets/js/libs/jquery-ui-1.10.3.min.js');?>"><\/script>');} </script>

		<!-- IMPORTANT: APP CONFIG -->
		<script src="<?php echo base_url('assets/js/app.config.js');?>"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
		<script src="<?php echo base_url('assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js');?>"></script> -->

		<!-- BOOTSTRAP JS -->		
		<script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js');?>"></script>

		<!-- JQUERY VALIDATE -->
		<script src="<?php echo base_url('assets/js/plugin/jquery-validate/jquery.validate.min.js');?>"></script>
		
		<!-- JQUERY MASKED INPUT -->
		<script src="<?php echo base_url('assets/js/plugin/masked-input/jquery.maskedinput.min.js');?>"></script>
		
		<!--[if IE 8]>
			
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
			
		<![endif]-->

		<!-- MAIN APP JS FILE -->
		<script src="<?php echo base_url('assets/js/app.min.js');?>"></script>

		<script type="text/javascript">
			runAllForms();

			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						email : {
							required : true,
							email : true
						},
						password : {
							required : true,
							minlength : 3,
							maxlength : 20
						}
					},

					// Messages for form validation
					messages : {
						email : {
							required : 'Please enter your email address',
							email : 'Please enter a VALID email address'
						},
						password : {
							required : 'Please enter your password'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			});
		</script>
<?php	include 'footer.php'; ?>