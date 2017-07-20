<?php
	include ('assets/connect.php');	
    include 'assets/setup.php';

if($_POST['Mail']){

	$query = "SELECT username, email, password FROM `users` WHERE email = :email";
    $playload["email"] = $_POST['to'];
    $result = getAllDataFromDatabase($query, $playload);

	foreach($result as $row){
		
	}

	if(count($result > 0)){


	}
}

$to      = $_POST['to'];
$subject = 'the subject';

$pass = $row['password'];
$email = $row['email'];
$username = $row['username'];

$message = "Username:".$username."----------->"."Password:".$pass; 

$headers = 'From: BEEPY' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>

<h2>Sveiki, šeit top recovery pass</h2>

<form method="post">
	<p class="borders"> Jūsu E-pasts:   <input name="to" type="text" value="" /></p></p>

	<div class="submit_button">
		<a><button type="submit" value="Submit" name="Mail">Sūtīt uz E</button></a>
	</div>
					
</form>	