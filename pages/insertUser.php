<?php 

/*
  checkinng if exists the post  
*/
if ($_POST) {
	$userName = $_POST['userName'];
	$userMail = $_POST['userMail'];
	$userPassword = $_POST['userPassword'];
}

//calling the classes

if (isset($userName) && isset($userMail) && isset($userPassword)) {
	//setting the username to what the user inserted
	require_once "classes.php";
	$user = new user();
	$user->setUserName($userName);
	$user->setUserMail($userMail);
	$user->setUserPassword($userPassword);
	$user->insertUser();

}
 
?>