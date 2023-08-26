<?php 
session_start();

// user
if (isset($_SESSION['auth_users_session']) || isset($_COOKIE['auth_users_cookie'])) {
	session_destroy();
	if (isset($_COOKIE['auth_users_cookie'])) {
		setcookie('auth_users_cookie','', time()-(3600),'/');
	}
	header("location:signin.php");
}

else {
	header("location:signin.php");
}
?>
