<!DOCTYPE html>
<html lang="en">
<head>
	<title>POST LOGIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	         <!-- jQuery (required by Toastr) -->
	          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <!-- Toastr CSS -->
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!--===============================================================================================-->
	<link rel="icon" type="<?=base_url()?>assets2/image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets2/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets2/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets2/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets2/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets2/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets2/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets2/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets2/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets2/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets2/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="<?=base_url('login/processlogin')?>" method="POST">
				    <?=$this->session->flashdata('error')?>
					<span class="login100-form-title p-b-43">
					Admin Login
					</span>


					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text"  autocomlpete="off" name="username" id="username">
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" autocomplete="off"  type="password" name="password" id="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1"  required type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button  class="login100-form-btn" id="btnsubmit">
							Login
						</button>

					</div>

					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign up using
						</span>
					</div>

				</form>

				<div class="login100-more" style="background-image: url('<?=base_url()?>assets2/images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>


            <!-- Toastr JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<script src="<?=base_url()?>assets/js/jquery.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets2/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets2/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets2/vendor/bootstrap/js/popper.js"></script>
	<script src="<?=base_url()?>assets2/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets2/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets2/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?=base_url()?>assets2/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets2/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url()?>assets2/js/main.js"></script>


	<script>
 $(document).ready(function() {
	$('#btnsubmit').on('click', function(e) {
        e.preventDefault();
        var username = $('#username').val();
		var password = $('#password').val();

		if(username!="" && password!=""){
			$("#butsave").attr("disabled", "disabled");
			$.ajax({
				url: "<?php echo base_url("login/processlogin");?>",
				type: "POST",
				data: {
					type: 1,
					username,
					password
				},
				cache: false,
				success: function(res){
					if(res==true){
						window.location = "<?=base_url('dashboard')?>";
                        //window.location = "<?=base_url('home/seller_buy')?>"+prod_id;
					}
					else if(res==false){
                           //location.reload();
					       //alert(" Wrong Username Or Password!");
                          toastr.error('Incorrect Login Credentials!');

					}

				}
			});
		}
		else{
            $('#error').html('please fill all entries !');
		}
	});
});
</script>


</body>
</html>
