<?php
include ('assets/connect.php');
include('assets/setup.php');
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
                echo "Re-try or Singin";
            }
        }else{
           echo "Re-try or Singin";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800" rel="stylesheet">
<style>
html {
    overflow: hidden;
      height: 100%;
    width:100%;
}
body{
    background-color: white;
    font-family: 'Montserrat', sans-serif;
    margin: 0;
    padding: 0;
    overflow: hidden;
      height: 100%;
    width:100%;
}
.content_container {
    height: 100%;
    width:100%;
}
ul, li{
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
    font-size: 0.9vw;
    font-weight: 600;
  
 
}
span{
    font-weight: 600;
}
h1{
    font-family: 'Montserrat', sans-serif;
    color: white;
    font-size: 6vw;
    font-weight:600;    
}
input {
    border-right: none;
    border-left: none;
    border-top: none;
    border-bottom: 1px solid rgb(203,210,223);
    font-size: 1vw;
    font-family: 'Source Sans Pro', sans-serif;
    background-color: rgba(255,255,255,0.8) !important;
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
    height: 100%;
    width: 100%;
    position: relative;
    padding-top: 30px;
    
    display: flex;
    flex-direction: column;
}


.hello_style{
    position: relative;
    left: 18vw;
}
.borders{
    line-height: 1vw;
    color: white;
    font-size: 1vw;
    font-weight:300;
    
    margin: 5px;
}
.forms{
    text-align: right;
    position: relative;
    top: -7vw;
    right: 42vw;
}
.forms button {
    background-color: #00c6ff;
    border: none;
    color: #fff;
    height: 30px;
    width: 75px;
    border-radius: 15px;


}
.links_under_forms{
    position: relative;
    top: -4vw;
    left: 46vw;
}
.sign_in{
    width: 20%;
}
.sign_in button{
    background-color: #00c6ff;
    color: rgba(255,255,255,1);
    border: none;
    font-size: 1vw;

    padding: 0 19px;
    height: 30px;

    border-radius: 15px;
   
    

    font-family: 'Montserrat', sans-serif;
    
}
button:focus{
    outline:none;
}

@media screen and (max-width: 1400px){
    .links{
    font-size: 1.2em;
    }
    .hello_style h1{
    font-size: 4em;
    }
    .forms p{
    font-size: 1em;
    padding: 1em;
    }
    .borders{
    font-size: 1em;
    }
    .sign_in button{
    font-size: 1em;
    height: 23px;
    width: 78px;
    }
}
</style>
</head>

<body class="login_page">
<div id="fixed" class="content_container">

        <div id="header">
            <?php include"assets/header.php" ?>
            
                <div class="hello_style">
                    <h1>Hello.</h1>
                </div>
                
                
                
                <form class="forms" action="login.php<?php if (isset($_GET['dir'])&&$_GET['dir']=='sell') {echo"?dir=sell";} ?>" method="POST">
                <p class="borders">username: <input type="text" name="username" class="inputs_style"/></p><br>
                <p class="borders" >password: <input type="password" name="password" class="inputs_style"/></p>
                <button class="button_two">Login</button>

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
                        
                         <a class="fb_link" onclick="fbclick()">Login with Facebook</a>
                    </li>
                    <li class="borders">
                        <span href="">Not a member</span>
                        <a href="signup.php" class="sign_in"><button type="button">Sign up</button></a>
                        
                    </li>
                    </ul>
                </div>
            
        </div>
</div>
</body>
</html>