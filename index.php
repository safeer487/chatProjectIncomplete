<?php 

// calling the classess
require_once 'pages/classes.php';
$user = new user();

//saving the error into a variable so i can called it later
$signUpError = $user->error();
//saving the error if the user exists
$userExist = $user->userExist();
//saving the login error
$logInError =  $user->logInError();






 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome to chat app</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	
	<div class="header">
			<a class="chatty" href="index.php">Chatty</a>
		
			<div class="logInForm">
				<form method="post" action="pages/userLogIn.php" role='form' class="form-inline">
					
					<div class="form-group">
					<label for="form-elem-1" class="sr-only">Email</label>
					<input type="text" id="form-elem-1" name="userMailLogIn" class="form-control" placeholder="Your Email">
					</div>

					<div class="form-group">
					<label for="form-elem-2" class="sr-only">Password</label>
					<input type="password" id="form-elem-2" name="userPasswordLogIn" class="form-control" placeholder="Password"><br>
					</div>

					<div class="form-group">
					<label for="form-elem-3" class="sr-only"></label>
					<input type="submit" value="Log In" id="form-elem-3" class="form-control">
					</div>
					<?php echo $logInError;  ?>

				</form>
			</div>
		
	</div>

		<hr>
		<div class="signUpForm">
			
			<form method="post" action="pages/insertUser.php" role="form">
				<h2>Sign up</h2>
				<div class="form-group">
				<!-- <label for="form-elem-4">Your Name</label> -->
				<input type="text" name="userName" class="form-control" placeholder="Your Name">
				</div>

				<div class="form-group">
				<!-- <label for="form-elem-5">Your Email</label> -->
				<input type="email" name="userMail" class="form-control" placeholder="Your Email">
				</div>		
		
				<div class="form-group">
				<!-- <label for="form-elem-6">Your password</label> -->
				<input type="password" name="userPassword" class="form-control" placeholder="Your Password">
				</div>
				
				<div class="form-group">
				<input class="signUp" type="submit" value="Sign Up"><br>
				</div>
				<?php 
					if (isset($_GET['success'])) {
					 echo "<span class='green'>* Thank you for registering.Using you email and password you can chat with peoples</span>";
					}
					echo $signUpError;
					echo $userExist;
				 ?>
			</form>



		</div>
	</div>
	<div id="footer">
		<p>Copyright <span class="glyphicon glyphicon-copyright-mark"></span> 2014 by Safeer Mehmood</p>
</div>

	<script src="js/jquery-2.1.1.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>	
</body>
</html>