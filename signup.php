<?php
    include ('assets/connect.php');
    include 'assets/setup.php';

    $texts = [];

    $texts['lv'] = [];
    $texts['en'] = [];
    $texts['ru'] = [];

    $texts['lv']['signup_f'] = 'Ieiet caur FACEBOOK';
    $texts['lv']['fname'] = 'Vārds';
    $texts['lv']['lname'] = 'Uzvārds';
    $texts['lv']['uname'] = 'Lietotājs';
    $texts['lv']['email'] = 'E-Pasts';
    $texts['lv']['phone'] = 'Telefona numurs';
    $texts['lv']['country'] = 'Valsts';
    $texts['lv']['pass'] = 'Parole';
    $texts['lv']['re_pass'] = 'Parole atkārtoti';
    $texts['lv']['reg'] = 'Reģistrēties';

    $texts['lv']['nameErrorA'] = 'Lūdzu, ievadiet savu PILNO VĀRDU.';
    $texts['lv']['nameErrorB'] = 'Vārds nedrīkst saturēt mazāk kā 3 burtus.';
    $texts['lv']['nameErrorC'] = 'Name must contain alphabets and space.';

    $texts['lv']['lNameErrorA'] = 'Lūdzu, ievadiet savu PILNO UZVĀRDU.';
    $texts['lv']['lNameErrorB'] = 'Uzvārds nedrīkst saturēt mazāk kā 3 burtus.';
    $texts['lv']['lNameErrorC'] = 'Name must contain alphabets and space.';

    $texts['lv']['uNameErrorA'] = 'Lūdzu ievadiet savu LIETOTĀJ VĀRDU.';  
    $texts['lv']['uNameErrorB'] = 'Lietotāja vārds nedrīkst saturēt mazāk kā 3 burtus.';
    $texts['lv']['uNameErrorC'] = 'Atvainojiet, Jūsu LIETOTĀJ VĀRDS ir jau aizņemts!';

    $texts['lv']['emailErr'] = 'Atvainojiet, Jūsu E-PASTS mūsu sistēmā jau pastāv!';

    $texts['lv']['passErrorA'] = 'Lūdzu ievadiet savu paroli.';
    $texts['lv']['passErrorB'] = 'Jusu parole nedrīkst saturēt mazāk kā 6 simbolus.';

    $texts['lv']['passErrorC'] = 'Paroles nesakrīt!';

    $texts['lv']['succErr'] = 'Jūs esat veiksmīgi piereģistrējies!';
// ------------------------------------------------------>
    $texts['en']['signup_f'] = 'Sing Up with FACEBOOK';
    $texts['en']['fname'] = 'First Name';
    $texts['en']['lname'] = 'Last Name';
    $texts['en']['uname'] = 'User Name';
    $texts['en']['email'] = 'E-mail';
    $texts['en']['phone'] = 'Phone';
    $texts['en']['country'] = 'Country';
    $texts['en']['pass'] = 'password';
    $texts['en']['re_pass'] = 'Re-enter Password';
    $texts['en']['reg'] = 'Register';

    $texts['en']['nameErrorA'] = 'Please enter your full NAME.';
    $texts['en']['nameErrorB'] = 'Name must have atleat 3 characters.';
    $texts['en']['nameErrorC'] = 'Name must contain alphabets and space.';

    $texts['en']['lNameErrorA'] = 'Please enter your full LASTNAME.';
    $texts['en']['lNameErrorB'] = 'Name must have atleat 3 characters.';
    $texts['en']['lNameErrorC'] = 'Name must contain alphabets and space.';

    $texts['en']['uNameErrorA'] = 'Please enter your USERNAME.';  
    $texts['en']['uNameErrorB'] = 'Name must have atleat 3 characters.';
    $texts['en']['uNameErrorC'] = 'Sorry USERNAME already taken!';

    $texts['en']['emailErr'] = 'Sorry EMAIL id already taken!';

    $texts['en']['passErrorA'] = 'Please enter password.';
    $texts['en']['passErrorB'] = 'Password must have atleast 6 characters.';

    $texts['en']['passErrorC'] = 'Password does not match!';

    $texts['en']['succErr'] = 'You are successfully registered!';
// --------------------------------------------------------->
    $texts['ru']['signup_f'] = 'Вход чериз FACEBOOK';
    $texts['ru']['fname'] = 'Имя';
    $texts['ru']['lname'] = 'Фамилия';
    $texts['ru']['uname'] = 'Пользователь';
    $texts['ru']['email'] = 'Злектронойпочтa';
    $texts['ru']['phone'] = 'Номер телефона';
    $texts['ru']['country'] = 'Страна';
    $texts['ru']['pass'] = 'Пароль';
    $texts['ru']['re_pass'] = 'Повтор пароля';
    $texts['ru']['reg'] = 'Мой профиль';

    $texts['ru']['nameErrorA'] = 'Пожалуйста, введите ваше полное имя.';
    $texts['ru']['nameErrorB'] = 'Имя должно иметь 3 символа.';
    $texts['ru']['nameErrorC'] = 'Имя должно содержать буквы и пробел.';

    $texts['ru']['lNameErrorA'] = 'Введите вашу ФАМИЛИЮ.';
    $texts['ru']['lNameErrorB'] = 'ФАМИЛИЯ должно иметь 3 символа.';
    $texts['ru']['lNameErrorC'] = 'ФАМИЛИЯ должно содержать буквы и пробел.';

    $texts['ru']['uNameErrorA'] = 'Пожалуйста, введите Ваш логин.';  
    $texts['ru']['uNameErrorB'] = 'Имя должно иметь 3 символа.';
    $texts['ru']['uNameErrorC'] = 'К сожалению, такое имя пользователя уже занято!';

    $texts['ru']['emailErr'] = 'Извините электронная уже занята!';

    $texts['ru']['passErrorA'] = 'Пожалуйста введите пароль.';
    $texts['ru']['passErrorB'] = 'Пароль должен содержать не менее 6 символов.';

    $texts['ru']['passErrorC'] = 'Пароль не подходит!';

    $texts['ru']['succErr'] = 'Вы успешно зарегистрированы!';

    if(isset($_SESSION['uid']) && $_SESSION['uid'] > 0){
        $id = $_SESSION['uid'];
        header('location: index.php');
    }
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

    $fileDestString ='';

    function dumpAndDie($data) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        
        die();
}

    $error = "";
    // $FnameError = "";
    // $LnameError = "";
    // $userError = "";
    $emailError = "";
    $passError = "";
    $trueError = false;

    if(isset($_POST["submit"]))
    {
        $firstName = $_POST["firstname"];
        $lastName = $_POST["lastname"];
        $userName = $_POST["username"];
        $email = $_POST["email"]; 
        $telephone = $_POST["telephone"];
        $country = $_POST["country"];
        $password = $_POST['password'];
        $passwordConfirm = $_POST["passwordConfirm"] ;
        $date = date('Y-m-d H:i:s');



// FIRST NAME
        $nameError = '';
        if (empty($firstName)) {
            $trueError = true;
            // $FnameError = "Please enter your full name.";
            $nameError = 'nameErrorA';

        } else if (strlen($firstName) < 3) {
            $trueError = true;
            // $FnameError = "Name must have atleat 3 characters.";
            $nameError = 'nameErrorB';

        } else if (!preg_match("/^[a-zA-Z ]+$/",$firstName)) {
            $trueError = true;
            // $FnameError = "Name must contain alphabets and space.";
            $nameError = 'nameErrorC';
        }

// LAST NAME
        $lNameError = '';
        if (empty($lastName)) {
            $trueError = true;
            // $LnameError = "Please enter your full last name.";
            $lNameError = 'lNameErrorA';


        } else if (strlen($lastName) < 3) {
            $trueError = true;
            // $LnameError = "Name must have atleat 3 characters.";
            $lNameError = 'lNameErrorB';

        } else if (!preg_match("/^[a-zA-Z ]+$/",$lastName)) {
            $trueError = true;
            // $LnameError = "Name must contain alphabets and space.";
            $lNameError = 'lNameErrorC';
        }

// USER NAME

            else{
                $row = getDataFromDatabase("SELECT username FROM users WHERE username=:username", [
                    'username' => $userName,
                ]);

                $uNameError = '';
                if($row['username']==$userName) {
                    // $userError = "sorry USERNAME already taken ! ".$row['username'];
                    $trueError = true;
                    $uNameError = 'uNameErrorC'.$row['username'];
                }

            }
            
            if (empty($userName)) {
                $trueError = true;
                // $userError = "Please enter your User name.";
                $uNameError = 'uNameErrorA';


            } else if (strlen($userName) < 3) {
                $trueError = true;
                // $userError = "Name must have atleat 3 characters.";
                $uNameError = 'uNameErrorB';
            }

// E-MAIL
        else{
            $row = getDataFromDatabase("SELECT email FROM users WHERE email=:email", [
                'email' => $email,
            ]);

            // dumpAndDie($row);
            $emailErr = '';
            if($row['email']==$email) {
                // $emailError = "sorry EMAIL id already taken ! ".$row['email'];
                $trueError = true;
                $emailErr = 'emailErr'.$row['email'];
            }

        }

// password validation
        $passError = '';
        if (empty($password)){
            $trueError = true;
            // $passError = "Please enter password.";
            $passError = 'passErrorA';

        } else if(strlen($password) < 6) {
            $trueError = true;
            // $passError = "Password must have atleast 6 characters.";
            $passError = 'passErrorB';
        }

        //  $pass = hash('sha256', $password);  < --- kmp dēļ šītās rindiņās met eroru??

        else if($password !== $passwordConfirm)
        {
            // $passError = "Password does not match!";
            $passError = 'passErrorC';
        }

        if(!$trueError){
            $sql = "INSERT INTO 
                users(firstName, lastName, userName, email, telephone, country, password, image, date) 
                VALUES(:firstName, :lastName, :userName, :email, :telephone, :country, :password, :image, :date)";

            $row = insertDataInToDataBase($sql, [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'userName' => $userName,
                'email' => $email,
                'telephone' => $telephone, 
                'country' => $country,
                'password' => hashPass($password),
                'image' => $fileDestString,
                "date" => $date,
            ]);

            $error = "You are successfully registered";


   
        // EMAIL STUFF
        //if "email" variable is filled out, send email
        
        //Email information
          //  $admin_email = $userRow['email'];
            
            
           // $comment = 'you have successfully registered';
        //send email
        
        //Email response
           
        
        //if "email" variable is not filled out, display the form
       
    
    }
        if (!$trueError) {
            
        $qe = "SELECT id FROM users WHERE email=:email AND date =:date";
                $pay['email'] = $email;
                $pay['date'] = $date;
                $getID = getDataFromDatabase($qe,$pay);
                $_SESSION['uid'] = $getID['id'];
                print_r( $_SESSION['uid']);
                $link = $SiteUrl."profile.php";
                header('location:'.$link);
                exit;
        }
    }
           if( mail('pavilsdzi@gmail.com', "$subject", $comment, "From:" . 'Beepy')){
            echo "We cool now!";
             }


?>

<!DOCTYPE html>
<html>
    <head>
	
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
    <?php include"assets/head.php" ?>
        

        <title>SIGNUP</title>
		
<style>
#signup{
	text-align: center;
}
#background{
    padding: 60px 0;
}
label{
	font-family: 'Montserrat', sans-serif;
	color: #00c6ff;
	font-size: 22px;
	line-height: 1;
	font-weight:500;
	text-align: left;
}
input{
	font-family: 'Montserrat', sans-serif;
	color: black;
	font-size: 1vw;
	line-height: 1;
	font-weight:500;
	text-align: left;
	color: #00c6ff;
}
.back button{
	background-color: #00c6ff;
    color: rgba(255,255,255,1);
    border: none;
    font-size: 1vw;
    height: 5%;
    width: 100%;
    padding: 0.7vw 1.7vw;
    border-radius: 2vw;
    font-weight: 500;
    line-height: 0.5vw;
    font-family: 'Montserrat', sans-serif;
    opacity: 0.8;
    margin-right: 1vw;
}
#form input {
	border: 1px solid #00c6ff;
    width: 250px;
    height: 27px;
    border-radius: 30px;
    padding: 9px;
    background-color: transparent;
}
input:focus{
	outline: none;
}
.button{
	background-color: #00c6ff;
    color: rgba(255,255,255,1);
    border: none;
    font-size: 1vw;
    height: 5%;
    width: 40%;
    padding: 0.4vw 2.9vw;
    border-radius: 2vw;
    font-weight: 500;
    line-height: 2.2vw;
    font-family: 'Montserrat', sans-serif;
    opacity: 0.8;
}
.file_upload input[type=file]{
    position: absolute;
    width: 1%;
    height: 1%;
    -ms-transform: scale(20);
    opacity: 0;
}
form #submit input{
	background-color: #00c6ff;
    color: rgba(255,255,255,1);
    border: none;
    font-size: 22px;
    height: 50px;
    width: 100%;
        padding: 10px 20px;
    border-radius: 30vw;
    font-weight: 500;
    line-height: 2px;
    font-family: 'Montserrat', sans-serif;
    opacity: 0.8;
}
.fb_link {
    position: relative;
    top: 0;
    right: 25%;
    color: #00c6ff;
    transition: ease all 0.3s;
	    font-size: 22px;
}
.fb_link:hover {
    color: #00aacc
}
.wraper {
    position: relative;
}
#submit {
    width: 100%;
    position: relative;
    bottom: 0px;
    left: 0;
	
}
</style>
		
    </head>

    <body>
    <?php 
        include"assets/header.php"
    ?>

	<div id="signup">
	
	<div id="background"></div>
        
        <div class="wraper">

<!--Reģistrēšanās FORMA-->
            <div id="error"><h3><?php echo $error ?></h3></div>
            <a class="fb_link" href="<?php echo $loginUrl; ?>"><?php echo $texts[$lang]['signup_f'] ?></a>
            <div id="form">
                <form method="POST" action="signup.php" enctype="multipart/form-data">

                    <span class="text-danger"><?php if(isset($_POST['submit'])&&!empty($nameError)) {echo $texts[$lang][$nameError];} ?></span><br/>
                    <!--<span class="text-agree"><?php echo $trueError; ?></span><br/>-->
                    <label><?php echo $texts[$lang]['fname'] ?></label><br/>
                    <input type="text" value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];} ?>" name="firstname"><br/>

                    <span class="text-danger"><?php if(isset($_POST['submit'])&&!empty($lNameError)) {echo $texts[$lang][$lNameError];} ?></span><br/>
                    <label><?php echo $texts[$lang]['lname'] ?></label><br/>
                    <input type="text" value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname'];} ?>" name="lastname"><br/>

                    <span class="text-danger"><?php if(isset($_POST['submit'])&&!empty($uNameError)) {echo $texts[$lang][$uNameError];} ?></span><br/>
                    <label><?php echo $texts[$lang]['uname'] ?></label><br/>
                    <input type="text" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" name="username"><br/>

                    <span class="text-danger"><?php if(isset($_POST['submit'])&&!empty($emailErr)) {echo $texts[$lang]["emailErr"];} ?></span><br/>
                    <label><?php echo $texts[$lang]['email'] ?></label><br/>
                    <input type="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" name="email"><br/>

                    <br/><label><?php echo $texts[$lang]['phone'] ?></label><br/>
                    <input type="tel" value="<?php if(isset($_POST['telephone'])){echo $_POST['telephone'];} ?>" name="telephone"><br/><br/>

                    <label><?php echo $texts[$lang]['country'] ?></label><br/>
                    <input type="text"  value="<?php if(isset($_POST['country'])){echo $_POST['country'];} ?>" name="country"><br/>

                    <span class="text-danger"><?php if(isset($_POST['submit'])&&!empty($passError)) {echo $texts[$lang][$passError];} ?></span><br/>
                    <label><?php echo $texts[$lang]['pass'] ?></label><br/>
                    <input type="password" name="password"><br/><br/>

                    <label><?php echo $texts[$lang]['re_pass'] ?></label><br/>
                    <input type="password" name="passwordConfirm"><br/>

                    <br/>

                    <table align="center">
                    <tr>
                        <td>
                            <div id="submit" style="float:left"><input type="submit" name="submit" value="<?php echo $texts[$lang]['succErr'] ?>"></div>
                        </td>

                    </tr>
                    </table>
                </form>
            </div>

        </div>
	</div>
    </body>
</html>