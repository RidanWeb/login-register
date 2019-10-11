<?php 

// session class start======================================
	class Session{

		// init method start========================
		public static function init(){
			if (version_compare(phpversion(), '5.4.0', '<')) {
				if (sessiom_id() == '') {
					session_start();
				}
			}else{
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
			}
		}// init method end========================

		// set method start========================
		public static function set($key, $val){

			$_SESSION[$key] = $val;

		}// set method end========================


		// get method start========================
		public static function get($key){

			if (isset($_SESSION[$key])) {

				return $_SESSION[$key];

			}else{

				return false;

			}
		}// get method end========================


		public static function checkSession(){
			if (self::get("login") == false) {
				self::destroy();
				header("location: login.php");
			}
		}

		public static function checkLogin(){
			if (self::get("login") == true) {
				header("location: index.php");
			}
		}


		// create a method destroy() for logout================
		public static function destroy(){
			session_destroy();
			session_unset();
			header("location: login.php");
		}


	}// session class end======================================

?>