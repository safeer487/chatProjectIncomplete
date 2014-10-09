<?php 
session_start();

if ($_POST) {
	$userMail = $_POST['userMailLogIn'];
	$userPassword = $_POST['userPasswordLogIn'];
}

if (isset($userMail) && isset($userPassword)) {
	require_once "classes.php";
	$miUser = new user();
	$miUser->setUserMail($userMail);
	$miUser->setUserPassword($userPassword);
	$miUser->userLogIn();

	};








 ?>