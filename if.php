<?php 
    include ('assets/connect.php');	
    include 'assets/setup.php';

    $query = "SELECT username, email FROM `users` WHERE email = :email";
    $playload["email"] = $_POST['to'];
    $result = getAllDataFromDatabase($query, $playload);
    print_r($result);
    

    if($_POST['start'] && isset($_POST['to']) == $result) {

        echo "GO!";

    }else{
        echo "NO!";
        
    }





?>


<form method="post">
	<p class="borders"> Jūsu E-pasts:   <input name="to" type="text" value="" /></p></p>

	<div class="submit_button">
		<a><button type="submit" value="Submit" name="start">Sūtīt uz E</button></a>
	</div>
					
</form>