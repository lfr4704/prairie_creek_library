<?php
error_reporting(E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if ($post) {
	function ValidateEmail($value)
	{
		$regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
		if ($value == '') {
			return false;
		} else {
			$string = preg_replace($regex, '', $value);
		}
		return empty($string) ? true : false;
	}

	$name = stripslashes($_POST['name']);
	$email = trim($_POST['email']);
	$subject = stripslashes($_POST['subject']);
	$message = stripslashes($_POST['message']);


	$error = '';

// Check name

	if (!$name) {
		$error .= 'Please enter your name.<br />';
	}

// Check email

	if (!$email) {
		$error .= 'Please enter an e-mail address.<br />';
	}

	if ($email && !ValidateEmail($email)) {
		$error .= 'Please enter a valid e-mail address.<br />';
	}

// Check message (length)

	if (!$message || strlen($message) < 10) {
		$error .= "Please enter your message. It should have at least 10 characters.<br />";
	}


	if (!$error) {
		$mail = mail('yourmail@demo.com', $subject, $message, "From: " . $name . " <" . $email . ">\r\n"
			. "Reply-To: " . $email . "\r\n"
			. "X-Mailer: PHP/" . phpversion());


		if ($mail) {
			echo 'OK';
		}
	} else {
		echo '<div class="alert alert-danger">' . $error . '</div>';
	}
}
?>