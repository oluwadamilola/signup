<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Sign up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- MATERIAL DESIGN ICONIC FONT -->
	<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

	<!-- STYLE CSS -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="build/css/intlTelInput.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

	<div class="wrapper" style="background-image: url('images/5.jpg');">
		<div class="inner">
			<form action="formcontrol.php" id="form" method="POST">
				<h3>Sign Up</h3>
				<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<span>Step 1 of 2</span>
				<div class="form-group">
					<div class="form-wrapper">
						<label for="">First Name</label>
						<input type="text" class="form-control" id="firstname" name="firstname" required>
					</div> 
					<div class="form-wrapper">
						<label for="">Last Name</label>
						<input type="text" class="form-control" id="lastname" name="lastname" required >	
					</div>
				</div>
				<div class="form-wrapper">
					<label for="number">Phone Number</label>
					<input id="phone" type="text"  class="form-control" width="100%" name="phonenumber" placeholder="80123456789" id="phone" required>
				</div>
				<div class="form-wrapper">
					<label for="">Email</label>
					<input type="email" class="form-control" name="email" required>
				</div>
				<div class="form-group">
				<div class="form-wrapper">
					<label for="">Date of Birth</label>
					<input type="date" class="form-control"  id="dob" name="dateofbirth" required>	
				</div>
				<div class="form-wrapper">
					<label for="">Gender</label>
					<select class="form-control" id="gender"  name="gender"  required>
						<option value="" class="form-control" >select</option>
						<option value="Female"  class="form-control"name="gender">Female</option>
						<option value="Male" class="form-control" name="gender">Male</option>
					</select>		
</div>
				</div>
				<button class="button" name="submit">Continue</button>
			</form>


			<!-- <div class="form-wrapper">
					<label for="">Gender</label>
					<select class="form-control" id="gender"  name="gender"  required>
						<option value="" class="form-control" >select</option>
						<option value="Female"  class="form-control"name="gender">Female</option>
						<option value="Male" class="form-control" name="gender">Male</option>
					</select>	
				</div> -->














			<script src="build/js/intlTelInput.js"></script>
	
			<script>
				
				// Vanilla Javascript
				var input = document.querySelector("#phone");
				window.intlTelInput(input, ({
					// options here
					onlyCountries:['ng']
				}));

				$(document).ready(function () {
					$('.iti__flag-container').click(function () {
						var countryCode = $('.iti__selected-flag').attr('title');
						var countryCode = countryCode.replace(/[^0-9]/g, '')
						$('#phone').val("");
						$('#phone').val("+" + countryCode + " " + $('#phone').val());
					});
				});

			</script>
		
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>