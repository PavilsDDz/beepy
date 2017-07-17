<?php 
	
include'connect.php';
include 'setup.php';

//session_start();
require_once __DIR__ . '/Facebook/autoload.php';
$fb = new \Facebook\Facebook([
  'app_id' => '1909014619367137',
  'app_secret' => '871ba471caa0efdf4b990c6a992b778c',
  'default_graph_version' => 'v2.9',
]);
   $permissions = []; // optional
   $helper = $fb->getRedirectLoginHelper();
   $accessToken = $helper->getAccessToken();
   
if (isset($accessToken)) {

		//GET DATA FROM FB
	



 		// $url = "https://graph.facebook.com/v2.6/me?fields=id,first_name,middle_name,last_name,hometown,email,picture.width(300).height(300)&access_token=";
 		$url = "https://graph.facebook.com/v2.9/me?fields=id%2Cemail%2Cfirst_name%2Clast_name%2Cmiddle_name%2Chometown%2Cpicture.width(300).height(300)&access_token={$accessToken}";
		$headers = array("Content-type: application/json");
		
			 
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		 curl_setopt($ch, CURLOPT_URL, $url);
	         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		 curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
		 curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		   
		 $st=curl_exec($ch); 

		 $result=json_decode($st,TRUE); //ARRAY THAT CONTAINS FB DATA

		 // echo "My name: ".$result['first_name'];
		 // echo "<img src=".$result['picture']['data']['url'].">";
		 // print_r($result);

		//CHECK IF USER WITH FB_ID IS REGISTRED
		
		$Query = "SELECT id FROM users WHERE fb_id=:fb_id ";
		$ply['fb_id'] = $result['id']; 
		$Qresult = getAllDataFromDatabase($Query,$ply);

		//print_r($Qresult);

		if(count($Qresult)>0){			//IF DB HAS USER WITH THIS FB ID: LOG IN
			$_SESSION['uid']=$Qresult[0]['id'];
			echo "Your Iuser Id is ".$_SESSION['uid'];
			header("location: ".$SiteUrl."/profile.php");
			//echo "<script>window.location = </script>";
		}else{							//IF DB DOSENT HAVE USER WHIT THIS FB ID: SIGN UP
			$Qinsert ="INSERT INTO  users(firstName, lastName, userName, email, country, image, date, fb_id) 
                VALUES(:firstName, :lastName, :userName, :email, :country, :image, :date, :fb_id)"; 

            $Iply['userName'] = 'fb_'.$result['id'];

            if (isset($result['middle_name'])) {
           		$Iply['firstName'] = $result['first_name'].' '.$result['middle_name'];
            }else {
            	$Iply['firstName'] = $result['first_name'];}
            if (isset($result['email'])) {
            	$Iply['email'] = $result['email'];
            }else{
            	$Iply['email'] = '';
            }
            if (isset($result['country'])) {
            	$Iply['country'] = $result['hometown'];
            }else{
            	$Iply['country'] = '';
            }
            $Iply['image'] = $result['picture']['data']['url'];
            $Iply['date'] =  date('Y-m-d H:i:s');
            $Iply['lastName'] = $result['last_name'];
            $Iply['fb_id'] = $result['id'];

            insertDataInToDataBase($Qinsert,$Iply);

            $BackQuery = "SELECT id FROM users WHERE fb_id =:fb_id";
            $Bply['fb_id'] = $result['id'];

			$new_user_data = getAllDataFromDatabase($BackQuery,$Bply);

            //print_r($new_user_data);

			//echo "You been added to db";
			//echo $new_user_data[0]['id'];
			$_SESSION['uid'] = $new_user_data[0]['id'];
			$NewUserlocation = 'http: '.$SiteUrl.'editprofile.php?id='.$new_user_data[0]['id']."&";

			header("location: ".$NewUserlocation);
			//echo"<script></script>"
		}
		
} else {
	$loginUrl = $helper->getLoginUrl('http: '.$SiteUrl.'fbprofile.php', $permissions);
	echo '<a href="' . $loginUrl . '">Login with Facebook</a>';
}




?>
