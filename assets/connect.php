<?php 


session_start();
global $db;
    //print_r($_SESSION);

try {
	$db = new PDO( "mysql:host=127.0.0.1;dbname=beepy;charset=utf8", "root", "" );
	$salt = "o78kb6985g6j9hi9=6uj78kh9ikgjoku9kyrj7r";
	// var_dump($db);
}

catch(Exception $e) {
	// echo $e->getMessage() ;
	echo "An error has occurred";
}


function getDataFromDatabase($sql, $payload = [])
{
	global $db;

	$stmt = $db->prepare($sql);
	$stmt->execute($payload);

	return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAllDataFromDatabase($sql, $payload = [])
{
	global $db;

	$stmt = $db->prepare($sql);
	$stmt->execute($payload);

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertDataInToDataBase($sql, $payload){

	global $db;

	$stmt = $db->prepare($sql);
	$stmt->execute($payload);

	return true;

}

function insertDataInToDataBaseDemo($sql, $payload){
	global $db;

	$stmt = $db->prepare($sql);
	if($stmt->execute($payload)){
		// echo '<br>sucssesfull<br>';
		
	}else{return false;}

	return $db->lastInsertId();

}

function hashPass($password) {
	global $salt;
    return hash('sha512', $salt . $password);
}

function verifyPass($password, $hash) {
	global $salt;
    return ($hash == hashPass($password));
}

?>
