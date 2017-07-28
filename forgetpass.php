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

<style>
.div{
	text-align: center;
	padding: 5vw;
}
.div p{
	font-family: 'Montserrat', sans-serif;
    color: #00c6ff;
    font-size: 20px;
    line-height: 1;
    font-weight: 500;
}
.div h2{
	font-family: 'Montserrat', sans-serif;
    color: #00c6ff;
    font-size: 30px;
    font-weight: 600;
}
.submit_button button{
	background-color: #00c6ff;
    color: rgba(255,255,255,1);
    border: none;
    font-size: 22px;
    height: 50px;
    width: 250px;
    padding: 10px 20px;
    border-radius: 30vw;
    font-weight: 500;
    line-height: 2px;
    font-family: 'Montserrat', sans-serif;
    opacity: 0.8;
}
.borders input{
	border: 1px solid #00c6ff;
    width: 257px;
    height: 4px;
    border-radius: 20px;
    background-color: transparent;
    padding: 17px 12px;
    font-size: 20px;
}
button:focus {
	outline: none;
}
input:focus {
	outline: none;
}
</style>

<div class="div">
<h2>Sveiki, šeit top recovery pass</h2>

<form method="post">
	<p class="borders"> Jūsu E-pasts:   <input name="to" type="text" value="" /></p></p>

	<div class="submit_button">
		<a><button type="submit" value="Submit" name="sub">Sūtīt uz E</button></a>
	</div>
</form>
</div>