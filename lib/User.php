<?php 
	include_once "Session.php";
	include "Database.php";


	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	// require 'PHPMailer/PHPMailerAutoload.php';
	// require 'vendor/autoload.php';


	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';


	// user class start================================
	class User{
		private $db;
		
		public function __construct(){
			$this->db = new Database();
		}

// 01.Registration start====================================================================================================
// 01.Registration start====================================================================================================

		//01. userRegistration method start=========================
		public function userRegistration($data){

			$name     = $data['name'];
			$username = $data['username'];
			$email    = $data['email'];
			$password = $data['password'];

			$chkEmail = $this->emailCheck($email);

			if ($name == '' || $username == '' || $email == '' || $password == '') {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> Fill Must Not Be Empty...! </div>";
				return $msg;
			}

			if (strlen($username) < 4) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> UserName Is Too Short...!</div>";
				return $msg;
			}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> UserName Must only contain alphanumerical, dashes and underscores...!</div>";
				return $msg;
			}

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Email Address is not valid...!</div>";
				return $msg;
			}

			if($chkEmail == true){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Email Address already Exist...!</div>";
				return $msg;
			}

			if (strlen($password) < 6) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> Password Is Too Short.Use Minimum 6 Character...!</div>";
				return $msg;
			}

			$password = md5($data['password']);



			// Data Insert in database=====================================================================================
			// Data Insert in database=====================================================================================
			$sql = 'INSERT INTO tbl_user(name, username, email, password) VALUE(:name, :username, :email, :password)';
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':name', $name);
			$query->bindValue(':username', $username);
			$query->bindValue(':email', $email);
			$query->bindValue(':password', $password);
			$result = $query->execute();

			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success !</strong> Thank You, You Have Been Registered...!</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Sorry, Your Data Not Inserted...!</div>";
				return $msg;
			}
			// Data Insert in database=====================================================================================
			// Data Insert in database=====================================================================================


		}// userRegistration method end==========================



		// email check method start=============================
		public function emailCheck($email){
			$sql = "SELECT email FROM tbl_user WHERE email = :email";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email', $email);
			$query->execute();

			if ($query->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		}// email check method end====================================

		// password check method start=============================
		public function passCheck($password){
			$sql = "SELECT password FROM tbl_user WHERE password = :password";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':password', $password);
			$query->execute();

			if ($query->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		}// password check method end====================================

// 01.Registration end======================================================================================================
// 01.Registration end======================================================================================================



// 02.LogIn start=====================================================================================================================
// 02.LogIn start=====================================================================================================================


		// declare a method for get login user all data start=================
		public function getLoginUser($email, $password){

			$sql = "SELECT * FROM tbl_user WHERE email = :email AND password = :password LIMIT 1";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email', $email);
			$query->bindValue(':password', $password);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;

		}// declare a method for get login user all data end=================


		//userLogin() method for login=========(login.php)================
		public function userLogin($data){

			$email    = $data['email'];
			$password = md5($data['password']);

			$chkEmail = $this->emailCheck($email);

			$chkPass = $this->passCheck($password);

			if ($email == '' || $password == '') {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> Fill Must Not Be Empty...! </div>";
				return $msg;
			}
 
			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Email Address is not valid...!</div>";
				return $msg;
			}

			if($chkEmail == false){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Email Address Not Exist...!</div>";
				return $msg;
			}

			if($chkPass == false){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Email Address And Password Don't Match...!</div>";
				return $msg;
			}


			// create a object for getLoginUser() method on 121 line==============================
			$result = $this->getLoginUser($email, $password);

			if ($result) {

				// session init/Start from Session.php page
				Session::init();
				Session::set("login", true);
				Session::set("id", $result->id);
				Session::set("name", $result->name);
				Session::set("username", $result->username);
				Session::set("loginMsg", "<h4 class='alert alert-success text-center'><strong>Success !</strong>You Are LogedIn...!</h4>");
				header("Location: index.php");

			}else{

				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Data Not Found...!</div>";

				return $msg;
			}


		}//userLogin() method for login=========(login.php)================

// 02.LogIn end=====================================================================================================================
// 02.LogIn end=====================================================================================================================
	
	// create a getUserData() method for read data from database in index page
	public function getUserData(){
		$sql = "SELECT * FROM tbl_user ORDER BY id DESC";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}


	// create a getUserById($userId) method for read data from database in profile page
	public function getUserById($userId){
		$sql = "SELECT * FROM tbl_user WHERE id = :id LIMIT 1";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':id', $userId);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
	}

	// create a updateUserData($userId, $_POST) method for update data from database in profile page start
	public function updateUserData($id, $data){

			$name     = $data['name'];
			$username = $data['username'];
			$email    = $data['email'];

			$chkEmail = $this->emailCheck($email);

			if ($name == '' || $username == '' || $email == '') {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> Fill Must Not Be Empty...! </div>";
				return $msg;
			}

			if (strlen($username) < 4) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> UserName Is Too Short...!</div>";
				return $msg;
			}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> UserName Must only contain alphanumerical, dashes and underscores...!</div>";
				return $msg;
			}

			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Email Address is not valid...!</div>";
				return $msg;
			}

			if($chkEmail == true){
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Email Address already Exist...!</div>";
				return $msg;
			}
			
			$sql = 'UPDATE tbl_user SET name = :name, username = :username, email = :email WHERE id = :id';

			$query = $this->db->pdo->prepare($sql);

			$query->bindValue(':name', $name);
			$query->bindValue(':username', $username);
			$query->bindValue(':email', $email);
			$query->bindValue(':id', $id);
			$result = $query->execute();

			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success !</strong>User Data Updated Successfully...!</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Sorry, Your Data Not Updated...!</div>";
				return $msg;
			}
	}
	// create a updateUserData($userId, $_POST) method for update data from database in profile page end




	// create a updatepassword($userId, $_POST) method for update password from database in profile page start
	public function updatepassword($id, $data){
		$old_pass = $data['old_pass'];
		$new_pass = $data['new_pass'];

		$chkPass = $this->oldPassCheck($id, $old_pass);

		if ($old_pass == "" || $new_pass == "") {
			$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field Must Not Be Empty...!</div>";
				return $msg;
		}

		if ($chkPass == false) {
			$msg = "<div class='alert alert-danger'><strong>Error !</strong>Old Password Not Exist...!</div>";
				return $msg;
		}

		if (strlen($new_pass) < 6) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> Password Is Too Short.Use Minimum 6 Character...!</div>";
				return $msg;
			}

			$password = md5($new_pass);


			$sql = 'UPDATE tbl_user SET password = :password WHERE id = :id';

			$query = $this->db->pdo->prepare($sql);

			$query->bindValue(':password', $password);
			$query->bindValue(':id', $id);
			$result = $query->execute();

			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success !</strong>Password Updated Successfully...!</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Error !</strong>Sorry, Password Not Updated...!</div>";
				return $msg;
			}

	}// create a updatepassword($userId, $_POST) method for update password from database in profile page start









	// password check method start=============================
		public function oldPassCheck($id, $old_pass){
			$password = md5($old_pass);
			$sql = "SELECT password FROM tbl_user WHERE id = :id AND password = :password";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':id', $id);
			$query->bindValue(':password', $password);
			$query->execute();

			if ($query->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		}// password check method end====================================





	// create a userForgetPassword($_POST) method for update password from database in profile page start

	public function userForgetPassword($data){

		$email    = $data['email'];

		$chkEmail = $this->emailCheck($email);

		if ($chkEmail == false) {

			$msg = "<div class='alert alert-danger'><strong>Error !</strong>Can't find that email, sorry...!</div>";

			return $msg;
		}


		// Instantiation and passing `true` enables exceptions

        $mail = new PHPMailer();

        try {
            $mail->isSMTP();// Send using SMTP
            $mail->Host       = 'smtp.gmail.com';// Set the SMTP server to send through
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = 'ridankabir0wr@gmail.com';// SMTP username
            $mail->Password   = 'Ridan&&Kabir1650';// SMTP password
            $mail->SMTPSecure = "tls";// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;// TCP port to connect to

            //Recipients
            $mail->setFrom('ridankabir0wr@gmail.com', 'localhost');
            $mail->addAddress($email);// Add a recipient
            $mail->addReplyTo('No-reply@ridan.com', 'No Reply');

            // Content
            $mail->isHTML(true);// Set email format to HTML
            $mail->Subject = "Changed Password";
            $mail->Body    = "Your login password has been changed. If you believe this is an error, please click on the button below to visit our support portal, through which you can contact our support team";
            $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

            $mail->send();

            $msg ="<div class='alert alert-success'><strong>Success !</strong>Message has been sent...!</div>";

			return $msg;

        } catch (Exception $e) {

        	$msg = "<div class='alert alert-danger'><strong>Error !</strong>Message could not be sent. Mailer Error: {$mail->ErrorInfo}...!</div>";

			return $msg;
        }

	}

	}// user class end=================

?>