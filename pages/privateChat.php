<?php 
if (isset($_GET['id'])) {
	$iId = $_GET['id'];
	
}


 ?>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome to the chat</title>
	<title>Welcome to chat app</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<style>
	#chatBox{
		width:500px;
	}

	</style>

</head>
<body>
	<div class="header">
	<a class="chatty" href="home.php">Chatty</a>
		<!-- <div class="welcome"><span class="welcom">welcome, </span> <?php echo "<span class='green'>$name</span>" ?> -->
		<!-- <a class="btn btn-success btn-sm" href="home.php?cerrar=1">Log out</a></div> -->
	</div>

	<div id="chatBox">
		<div id="chatMesseges">
		</div>
		<form action=""></form>
		<textarea name="chatText" id="chatText" placeholder="Chat messege here!"></textarea>
	</div>


	<div id="footer">
		<p>Copyright <span class="glyphicon glyphicon-copyright-mark"></span> 2014 by Safeer Mehmood</p>
	</div>

<script src="../js/jquery-2.1.1.js"></script>
<script>
(function(){
	var chat = $('#chatText');
	
		chat.keyup(function(e){
		if(e.keyCode ==13) {
				var chatText = chat.val();
				console.log(chatText);
				$.ajax({
					type:'POST',
					url:'insertPrivateM.php',
					data:{chatText:chatText},
					success:function(){
						chat.val('');
					}

				})
		};
	})
	setInterval(function(){//refresh every half second
		$('#chatMesseges').scrollTop(99999);
		// $('#chatMesseges').load('dispalyMesseges.php');

	},500);	

	


})();

</script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>	
</body>
</html>