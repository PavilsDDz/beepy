<?php
	include ('assets/connect.php');	
    include 'assets/setup.php';

	$playload["email"] = "";

	$query = "SELECT username, email, password FROM `users` WHERE email = :email";
	$playload["email"] = $_POST['to'];
	$result = getAllDataFromDatabase($query, $playload);

	if($_POST['sub'] && isset($_POST['to']) == $result){
		$newPassword = randomPassword();
		$hashedPassword = hashPass($newPassword);

		$update = "UPDATE users SET password = :hashedPassword WHERE email = :email";
		$payL["email"] = $_POST['to'];
		$payL['hashedPassword'] = $hashedPassword;

		insertDataInToDataBase($update, $payL);
		$to      = $_POST['to'];
		$subject = 'the subject';

		$message = $newPassword; 

		$headers = 'From: BEEPY' . "\r\n" .
		'Reply-To: webmaster@example.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);

		echo "Email was send to email:    ".$_POST['to']; 

	}else{
			echo "e-mail in Beepy system does exist. If you dont have a account please signup!";
		
		
	}

	function randomPassword() {

		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array();
		$alphaLength = strlen($alphabet) - 1;

		for ($i = 0; $i < 8; $i++) {

			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}

		return implode($pass);
	}
?>

<h2>Sveiki, šeit top recovery pass</h2>

<form method="post">
	<p class="borders"> Jūsu E-pasts:   <input name="to" type="text" value="" /></p></p>

	<div class="submit_button">
		<a><button type="submit" value="Submit" name="sub">Sūtīt uz E</button></a>
	</div>
					
</form>	