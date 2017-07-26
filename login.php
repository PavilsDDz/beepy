<?php
include ('assets/connect.php');
include('assets/setup.php');

    $texts = [];

    $texts['lv'] = [];
    $texts['en'] = [];
    $texts['ru'] = [];

    $texts['lv']['hello'] = 'Sveiki.';

    $texts['lv']['signup_f'] = 'Ieiet caur FACEBOOK';
    $texts['lv']['uname'] = 'Lietotājs';
    $texts['lv']['pass'] = 'Parole';
    $texts['lv']['reg'] = 'Reģistrēties';

    $texts['lv']['succErr'] = 'Jūs esat veiksmīgi piereģistrējies!';

    $texts['lv']['lgin'] = 'Ieiet';

    $texts['lv']['mem'] = 'Jūs neesat reģistrējies';
    
    $texts['lv']['erre'] = 'Mēģiniet vēlreiz vai reģistrējaties';

// ------------------------------------------------------>

    $texts['en']['hello'] = 'Hello.';

    $texts['en']['signup_f'] = 'Sing Up with FACEBOOK';
    $texts['en']['uname'] = 'User Name';
    $texts['en']['email'] = 'E-mail';
    $texts['en']['pass'] = 'password';
    $texts['en']['reg'] = 'Register';

    $texts['en']['succErr'] = 'You are successfully registered!';

    $texts['en']['lgin'] = 'Login';

    $texts['en']['mem'] = 'Not a member';

    $texts['en']['erre'] = 'Re-try or Singin';
// --------------------------------------------------------->
    $texts['ru']['hello'] = 'Привет.';

    $texts['ru']['signup_f'] = 'Вход через FACEBOOK';
    $texts['ru']['uname'] = 'Пользователь';
    $texts['ru']['pass'] = 'Пароль';

    $texts['ru']['reg'] = 'Зарегистрироваться';

    $texts['ru']['succErr'] = 'Вы успешно зарегистрированы!';

    $texts['ru']['lgin'] = 'Bойти';

    $texts['ru']['mem'] = 'Вы не зарегистрированы';

    $texts['ru']['erre'] = 'попробуйте еще раз или зарегистрируйтесь';

require_once __DIR__ . '/assets/Facebook/autoload.php';
$fb = new \Facebook\Facebook([
  'app_id' => '1909014619367137',
  'app_secret' => '871ba471caa0efdf4b990c6a992b778c',
  'default_graph_version' => 'v2.9',
]);
   $permissions = []; // optional
   $helper = $fb->getRedirectLoginHelper();
   $accessToken = $helper->getAccessToken();
   
   $loginUrl = $helper->getLoginUrl($SiteUrl.'assets/fbprofile.php', $permissions);
   // echo '<a href="' . $loginUrl . '">Login with Facebook</a>';


function dumpAndDie($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}



   if( isset($_POST['username']) && $_SERVER["REQUEST_METHOD"] == "POST") {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $row = getDataFromDatabase("SELECT username, password,id FROM users WHERE username=:username", [
            'username' => $username,
        ]);


        if ($row){
            if(verifyPass($password, $row["password"] )){
                session_start();
                $_SESSION['uid'] = $row['id'];
                 if (isset($_GET['dir'])&&$_GET['dir']=='sell') {
                        header('Location: '.$SiteUrl.'addcar.php');  
                        exit;
                    }else{
                        header('Location: '.$SiteUrl.'index.php');  

                    }
                   
            }else{
                echo $texts[$lang]['erre'];
            }
        }else{
           echo $texts[$lang]['erre'];
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

    <?php include"assets/head.php" ?>

<style>
html {
    overflow: hidden;
    height: 100%;
}
body{
    background-color: white;
    font-family: 'Montserrat', sans-serif;
    margin: 0;
    padding: 0;
    overflow: hidden;
	width: 100%;
	height: 100%;
}
.content_container {
    height: 100%;
    width:100%;
}
#header ul, li{
    list-style: none;
    margin: 0;
    padding: 0;
}
a {
    text-decoration: none;
    color:inherit;
}
p{
    font-family: 'Montserrat', sans-serif;
    color: #939393;
    font-size: 20px;
    font-weight: 600;
}
#header span{
    font-weight: 600;
}
h1{
    font-family: 'Montserrat', sans-serif;
    color: white;
    font-size: 120px;
    font-weight:600;    
}
input {
    border-right: none;
    border-left: none;
    border-top: none;
    border-bottom: 1px solid rgb(203,210,223);
    font-size: 1vw;
    background-color: rgba(255,255,255,0) !important;
	color: white;
	margin-left: 25px;
    text-align: center;
}
input:focus{
    outline: none;
}

/*header*/
#header{ 
    background-image:  url("img/login_background.jpg");  
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    height: 101.5%;
    width: 100%;
    position: relative;
    display: flex;
    flex-direction: column;
}
.hello_style{
    position: relative;
    left: 18vw;
	top: 10vw;
}
.borders{
    line-height: 1vw;
    color: white;
    font-weight:300; 
    margin: 5px;
}
.login_forms{
	margin-top: 5vw;
}
.forms{
    text-align: right;
    position: relative;
    top: 0vw;
    right: 42vw;
}
.forms button {
    background-color: #00c6ff;
    padding: 5px 15px;
    border-radius: 40px;
    font-size: 1em;
    color: #fff;
    border: none;
    font-family: 'Montserrat', sans-serif;
    cursor: pointer;
    width: 90px;
}
.links_under_forms{
    position: relative;
    top: 2vw;
    left: 46vw;
}
.sign_in{
    width: 20%;
}
.sign_in button{
    background-color: #00c6ff;
    padding: 5px 15px;
    border-radius: 40px;
    font-size: 1em;
    color: #fff;
    border: none;
    font-family: 'Montserrat', sans-serif;
    cursor: pointer;
    width: auto;
}
button:focus{
    outline:none;
}

.menu{display: none;}
@media screen and (max-width: 800px){
body{
	width: auto;
    height: auto;
	}
#header{
	background-position: 55% 10%;
	padding-top: 0;
	height: 200vw;
}
.hello_style{
    position: relative;
    left: 0vw;
	text-align: center;
}
.hello_style h1 {
    font-size: 8em;
}
.forms {
    text-align: center;
    position: relative;
    top: 0vw;
    right: 0vw;
    margin: 0;
	margin-bottom: 100px;
}
.forms p {
    font-size: 23px;
    padding: 6px;
    justify-content: center;
    display: flex;
}
input {
    font-size: 20px;
}
.forms button {
    height: 40px;
    width: 180px;
    border-radius: 30px;
    font-size: 22px;
    margin-top: 20px;
    margin-left: 200px;
}
.links_under_forms {
    position: relative;
    top: 0;
    text-align: center;
    left: 0;
}
.sign_in button {
    height: 40px;
    width: 180px;
    border-radius: 30px;
    font-size: 22px;
	margin-top: 20px;
}
.borders{
	line-height: 22px;
}
}
</style>
</head>

<body class="login_page">
<div id="fixed" class="content_container">
            <?php include"assets/header.php" ?>
			<?php include 'assets/menu_block.php'; ?>
        <div id="header">

            
                <div class="hello_style">
                    <h1><?php echo $texts[$lang]['hello'] ?></h1>
                </div>
                
                
            <div class="login_forms">    
                <form class="forms" action="login.php<?php if (isset($_GET['dir'])&&$_GET['dir']=='sell') {echo"?dir=sell";} ?>" method="POST">
                <p class="borders"><?php echo $texts[$lang]['uname'] ?><input type="text" name="username" class="inputs_style"/></p><br>
                <p class="borders" ><?php echo $texts[$lang]['pass'] ?><input type="password" name="password" class="inputs_style"/></p>
                <button class="button_two"><?php echo $texts[$lang]['lgin'] ?></button>
                </form>
   
                <div class="links_under_forms">
					<ul>
                    <li class="borders">
                    <script type="text/javascript">
					var couter = 0;
						function fbclick(){if(couter==0){
							window.location = '<?php echo $loginUrl ?>';
							couter++;
						}}
						
					</script>
                        
                         <a class="fb_link" onclick="fbclick()"><?php echo $texts[$lang]['signup_f'] ?></a>
                    </li>
                    <li class="borders">
                        <span href=""><?php echo $texts[$lang]['mem'] ?></span>
                        <a href="signup.php" class="sign_in"><button type="button"><?php echo $texts[$lang]['reg'] ?></button></a>
                        
                    </li>
                    </ul>
                </div>
            </div>
        </div>

</div>
</body>
</html>