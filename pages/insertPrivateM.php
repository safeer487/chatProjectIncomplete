<?php  
session_start();
/*Session variable*/
if (!$_SESSION) {
	header('Location:../index.php');
	exit;
}

$iId = $_SESSION['userId'];



require_once "classes.php";
$chat = new chat();
// if not exists the session


if (isset($_POST['chatText'])) {
	$chatText = $_POST['chatText'];	
	$chat->setChatUserId($iId);
	$chat->setChatText($chatText);
	$chat->insertPrivateChat();
}
?>
