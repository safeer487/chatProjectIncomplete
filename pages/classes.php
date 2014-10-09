<?php 
/**
* class user
*/
class user
{
	private $userId,$userName,$userMail,$userPassword;
	
    	function __construct()
	{


	}
	/**
	 * Method getting userId
	 * @return userId
	 */
	public function getUserId(){
		return $this->userId;
	}

	/**
	 * Method for setting userID
	 */
	public function setUserId($userId){
		$this->userId = $userId;
	}

	/**
	 * Method for getting userName
	 * @return userName
	 */
	public function getUserName(){
		return $this->userName;
	}

	/**
	 * Method of setting userName
	 * @param set the username according to the parameter
	 */
	public function setUserName($userName){
		$this->userName = $userName;
				
	}

	/**
	 * Method of getting userMail
	 */
	public function getUserMail(){
		return $this->userMail;
	}

	/**
	 * Method of setting userMail
	 */
	public function setUserMail($userMail){
		$this->userMail = $userMail;
	}
    
    /**
     * Method of getting userPassword
     */
	public function getUserPassword(){
		return $this->userPassword;
	}

	/**
	 * Method of setting userPassword
	 */
	public function setUserPassword($userPassword){
		$this->userPassword = $userPassword;
	}

	/**
	 * Method of inserting  user data to database
	 */
	public function insertUser(){
		require_once "BD.class.php";
		$miDB = new DB();
		//to save the vairables 
		$userName = $this->getUserName();
		$userMail = $this->getUserMail();
		$userPassword = $this->getUserPassword();
		if (empty($userName) || empty($userMail) || empty($userPassword)) {
			header('Location: ../index.php?error=3');
			exit();
		}else{
			$sSQL = "SELECT * FROM users WHERE username = '$userName' AND usermail = '$userMail' ";
			$resul = $miDB->contarResultadosQuery($sSQL);
			if ($resul >= 1 ) {
			header('Location: ../index.php?error=4');
			exit;
		}else
		$sSQL = "INSERT INTO users VALUES('NULL','$userName','$userMail','$userPassword')";
		$miDB->ejecutarQuery($sSQL);
		header('Location: ../index.php?success=1');
		exit;
		}
	}
	

	/**
	 * Method for user to log in
	 */
	public function userLogIn(){
		require_once "BD.class.php";
		$miDB = new DB();
		$userMail = $this->getUserMail();
		$userPassword = $this->getUserPassword();
		$sSQL = "SELECT * FROM users WHERE usermail = '$userMail' AND userpassword = '$userPassword' ";
		$iNumResultado = $miDB->contarResultadosQuery($sSQL);
		if ($iNumResultado == 0) {
			header('Location: ../index.php?error=1');
		}else{
			$resul = $miDB->obtenerResultado($sSQL);
			$iId = $resul[0][0];
			$userName = $resul[0][1];
			$userMail = $resul[0][2];
			session_start();
			$_SESSION['userId'] = $iId;
			$_SESSION['userName'] = $userName;
			$_SESSION['userMail'] = $userMail;
			
			header('Location:home.php');
			exit();
			
		}
	}

	/**
	 * Method of closing the session
	 */
	public function close(){
		if (isset($_GET['cerrar'])) {
			session_start();
			session_destroy();
			header('Location: ../index.php');
			exit();
		}
	}

	/**
	 * Method of showing the error
	 */
	public function error(){
		if (isset($_GET['error']) && $_GET['error'] == 3) {
		return "<p class='red'>* Please fill all the fields</p>";	
		}
		
	}

	/**
	 * Method of showing the error if the user exists
	 */
	public function userExist(){
		if (isset($_GET['error']) && $_GET['error'] == 4) {
		return "<p class='red'>* You have already registered with this email and name.</p>";
		}
	}

	/**
	 * Method of showing the error if email or password incorrect
	 */
	public function logInError(){
		if (isset($_GET['error']) &&  $_GET['error'] == 1) {
		return "<p class='red'>* please enter your correct mail and password.<br>* If you are not a member please sign up.</p>";
		} 
	}

	/**
	 * Security 
	 */
	public function security(){
		if (!$_SESSION) {
		header('Location: ../index.php');
		exit;
		}
	}

	public function displayUsers(){
		require_once "BD.class.php";
		$miDB = new DB();
		$sSQL = "SELECT username,id FROM users";
		$resul = $miDB->obtenerResultado($sSQL);
		$sHTML = '';
		foreach ($resul as $value ) {
			extract($value);
		$sHTML .= <<<EOT
			<a href="privateChat.php?id=$id" title="" target="_blank">{$username}</a><br>
			
EOT;
		}
		echo $sHTML;
	}
}
	

/**
* class chat
*/
class chat
{
	private $id,$chatUserId,$chatText;

	function __construct()
	{
		
	}

	public function getChatId(){
		return $this->id;
	}
	public function setChatId($id){
		$this->id = $id;
	}


	public function getChatUserId(){
		return $this->chatUserId;
	}
	public function setChatUserId($chatUserId){
		$this->chatUserId = $chatUserId;
	}

	public function getChatText(){
		return $this->chatText;
	}
	public function setChatText($chatText){
		$this->chatText = $chatText;
	}

	/**
	 * Method for inserting chat normal
	 */
	public function insertChat(){
		require_once 'BD.class.php';
		$miDB = new DB();
		$chatId = $this->getChatUserId();
		$chatText = $this->getChatText();
		$sSQL = "INSERT INTO chats VALUES('NULL','$chatId','$chatText')";	
		$miDB->ejecutarQuery($sSQL);

	}

	/**
	 * Method for inserting private chat
	 */
	public function insertPrivateChat(){
		require_once 'BD.class.php';
		$miDB = new DB();
		$chatId = $this->getChatUserId();
		$chatText = $this->getChatText();
		$sSQL = "INSERT INTO chatprivate VALUES('NULL','$chatId','$chatText')";	
		$miDB->ejecutarQuery($sSQL);

	}

	/**
	 * Method display all the messeges
	 */
	public function displayMesseges(){
		require_once "BD.class.php";
		$miDB = new DB();
		//joining the tables for getting just the name and text messege
		$sSQL = "select users.username,chats.chatText FROM users INNER JOIN chats ON users.id = chats.chatusersid ORDER BY chats.id ASC";
		$chatData = $miDB->obtenerResultado($sSQL);
		foreach ($chatData as $value) {
			 echo "<span class='green'>".$userId = $value[0]."</span> :- ";
			 echo $userText = $value[1]."<br>";
		}
		

	}

}






 ?>