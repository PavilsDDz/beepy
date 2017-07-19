<?php

    include ('assets/connect.php');
    include ('assets/setup.php');
    include ('assets/brandsandmodels.php');
    include ('assets/functions.php');


    include ('assets/searchingLang.php');






    if(isset($_GET["logout"])){
        unset($_SESSION['uid']);
        header('Location: index.php');
        exit;
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
   
   $loginUrl = $helper->getLoginUrl('http: '.$SiteUrl.'assets/fbprofile.php', $permissions);


   $postsQ = "SELECT brand, model, year,millage, enginecapacity, price, id, photoid FROM products WHERE price > 3000 ORDER BY RAND() LIMIT 4";
   $postsR = getAllDataFromDatabase($postsQ);
  // print_r($postsR);

?>
<!DOCTYPE html> 
<html>
    <head>
    <?php include"assets/head.php" ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
<link rel="stylesheet" type="text/css" href="css/style.css">
        
        <script type="text/javascript" src="scripts/ui/jquery-ui.js"></script>

        <link rel="stylesheet" type="text/css" href="scripts/ui/jquery-ui.css">
        <script type="text/javascript" src="scripts/handles.js"></script>


        <title>index</title>
    </head>

    <body>

<?php


    include("assets/header.php");

    $error = "";
    $FnameError = "";
    $LnameError = "";
    $userError = "";
    $emailError = "";
    $passError = "";
    $trueError = false;

    if(isset($_POST["signup"]))
    {
        $firstName = $_POST["firstname"];
        $lastName = $_POST["lastname"];
        $userName = $_POST["username"];
        $email = $_POST["email"];
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
            // $LnameError = "Please enter your full first name.";
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

        // else if($password !== $passwordConfirm)
        // {
        //     $passError = "Password does not match";
        // }

        if(!$trueError){
            $sql = "INSERT INTO 
                users(firstName, lastName, userName, email, password, date) 
                VALUES(:firstName, :lastName, :userName, :email, :password, :date)";

            $row = insertDataInToDataBase($sql, [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'userName' => $userName,
                'email' => $email,
                'password' => hashPass($password),
                "date" => $date,
            ]);

            $error = "You are successfully registered";
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
    
?>

 <script>
            var showHint = function (str) {
                if (str.length == 0) {
                    document.getElementById("models_list").innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("models_list").innerHTML = this.responseText;
                            console.log(this.responseText)
                            //alert('GOing')

                        }
                    }
                    xmlhttp.open("GET", "assets/caroption+.php?for=sell&brand=" + str, true);
                    xmlhttp.send();
                }
            }
            var launch_req = function () {

                var brand_select = document.getElementById("brand");
                var brand = brand_select.options[brand_select.selectedIndex].value;

                showHint(brand)
            }
        </script>

<div id="fixed" class="content_container">
<?php include 'assets/menu_block.php'; ?>
<div class="logoo"><img src="img/beepylogo.png" style="width: 30%; margin: auto;"></div>
        <div id="header">
        <!--    -->
            
            <div class="header_content">
                <div class="findcar">

                    <h2><a href="searching.php"><?php echo $texts[$lang]['findcar'] ?></a></h2> 

                    <div class="header_forms flexx">
                        <div class="small_search">
                            <form action="<?php echo $SiteUrl; ?>searching.php" method="POST">
                                <div class="search_top flexx">
                                    <!-- CARTYPE -->
                                    <div class="select_input">
                                        <label><?php echo $texts[$lang]['type'] ?></label>
                                        <select name="carType[]" >
                                            <option value=""></option>  
                                            <?php  $car_types = ['coupe','hatchback','minivan','van','pickup','sedan','unversal','offroad','sport','other'];
                                            foreach ($car_types as $type) {
                                               ?>
                                               <option value="<?php echo $type ?>"><?php echo $texts[$lang][$type];?></option>
                                               <?php } ?>
                                        </select>
                                    </div>

                                    <!-- BRAND -->
                                    <div class="select_input">
                                        <label><?php echo $texts[$lang]['brands'] ?></label>
                                        <select name="brand[]" id="brand" onchange="launch_req()">
                                            <option value=""></option>
                                            <?php
                                            foreach ($cars as $brand) {
                                            echo "<option value='" . $brand . "'>" . $brand . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- MODELS -->
                                    <div class="select_input">
                                        <label><?php echo $texts[$lang]['model'] ?></label>
                                        <select id="models_list" name="model[]">
                                            
                                        </select>
                                    </div>
                                </div>
                                 <!--MILLAGE-->
                                <div class="range_select millage_select line_select">   
                                    <div class="groupLabel flexx"><label ><?php echo $texts[$lang]['millage'] ?></label></div>
                                    <div class="inputs flexx">
                                        <label class="left"><?php echo $texts[$lang]['from'] ?></label><input type="text" name="millage_from" id="millage_from" placeholder="0" value="" ><div class="middle flexx"><label style="margin-right: 5px;"><?php echo $texts[$lang]['km'] ?></label>
                                        <label><?php echo $texts[$lang]['to'] ?></label></div>
                                        <input type="text" name="millage_to" placeholder="300000" id="millage_to" value="" ><label class="right"><?php echo $texts[$lang]['km'] ?></label>
                                    </div>
                                    <div id="millage-range" class="slider"></div>
                                </div>

                                <!--PRICE-->
                                <div class="range_select price_select line_select">
                                    <div class="groupLabel flexx"><label ><?php echo $texts[$lang]['price'] ?></label></div>
                                    <div class="inputs flexx">
                                        <label class="left"><?php echo getData("year_from"); ?><?php echo $texts[$lang]['from'] ?></label>
                                        <input type="text" name="price_from" id="price_from" value="" ><div class="middle flexx">
                                        <label style="margin-right: 5px;">€</label><label><?php echo getData("year_to"); ?><?php echo $texts[$lang]['to'] ?></label></div>
                                        <input type="text" name="price_to" id="price_to" value="" ><label  class="right">€</label>
                                    </div>
                                    <div id="price-range" class="slider"></div>

                                </div>

                                 <!--YEARS-->

                                    <div class="range_select year_select line_select">
                                            <label class="groupLabel flexx"><?php echo $texts[$lang]['year'] ?></label>
                                        <div class="inputs flexx">
                                            <label class="left"><?php echo $texts[$lang]['from'] ?></label>
<<<<<<< HEAD
                                            <input type="text" name="year_from" id="year_from" placeholder="1970" value="" ><div class="middle flexx" >
                                            <label></label>
                                            <label>-</label>
                                            <label><?php echo $texts[$lang]['to']?></label></div>
=======
                                            <input type="text" name="year_from" id="year_from" placeholder="1970" value="" ><div class="middle flexx" style="justify-content: center;-webkit-justify-content: center;">
                                            <label>-</label></div>
                                            <label><?php echo $texts[$lang]['to']?> </label>
>>>>>>> fe32f42be224787e5650aba491d3692858e37e6b
                                            <input type="text" name="year_to" id="year_to" placeholder="2017" value="" >
                                        </div>
                                        <div id="year-range" class="slider"></div>
                                    </div>

                               
                                <input class="submit_search" type="submit" name="search" value="<?php echo $texts[$lang]['search']?>">
                            </form>  
                        </div>
                        <?php if(isset($_SESSION['uid']) && $_SESSION['uid'] > 0){ }else{ ?>

                        <!-- FORMAS SIGN UP SĀKUMS-->
                        <div class="signup_form">
                            <div id="error"><h3><?php echo $error ?></h3></div>
                            <div id="second_form">
                                <form method="POST" class="flex" action="" autocomplete="false" enctype="multipart/form-data">

                                    <span class="text-danger"><?php if(isset($_POST['submit'])&&!empty($nameError)) {echo $texts[$lang][$nameError];} ?></span>
                                    <!--<span class="text-agree"><?php echo $trueError; ?></span><br/>-->
                                    <label><?php echo $texts[$lang]['fname'] ?></label>
                                    <input type="text" value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];} ?>" name="firstname">

                                    <span class="text-danger"><?php if(isset($_POST['submit'])&&!empty($lNameError)) {echo $texts[$lang][$lNameError];} ?></span><br/>
                                    <label><?php echo $texts[$lang]['lname'] ?></label>
                                    <input type="text" value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname'];} ?>" name="lastname">

                                    <span class="text-danger"><?php if(isset($_POST['submit'])&&!empty($uNameError)) {echo $texts[$lang][$uNameError];} ?></span><br/>
                                    <label><?php echo $texts[$lang]['uname'] ?></label>
                                    <input type="text" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" name="username">

                                    <span class="text-danger"><?php if(isset($_POST['submit'])&&!empty($emailErr)) {echo $texts[$lang]["emailErr"];} ?></span><br/>
                                    <label><?php echo $texts[$lang]['email'] ?></label>
                                    <input type="email" autocomplete="false" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" name="email">

                                    <span class="text-danger"><?php if(isset($_POST['submit'])&&!empty($passError)) {echo $texts[$lang][$passError];} ?></span><br/>
                                    <label><?php echo $texts[$lang]['pass'] ?></label>
                                    <input type="password" autocomplete="new-password" name="password">


                                    <a class="fb_link" href="<?php echo $loginUrl; ?>"><?php echo $texts[$lang]['signup_f'] ?></a>

                                            <div  id="submit" class="flex" style="float:left"><input class="signup_submit" type="submit" name="signup" value="<?php echo $texts[$lang]['reg'] ?>"></div>
                                </form>

                            </div>
                        </div>
                    </div>
					
					

                        <?php  } ?>
                </div>
            </div>  
			
            <div class="cut"></div>
            <div class="add_banner">
                <div class="flex ">
                    <?php foreach ($postsR as $post) { 
                        $imglist = explode(';',$post['photoid']);
                        $firstimg = $imglist[0];
                        //echo $firstimg;
                        ?>

                    <a class="post_wrap_link" href="product.php?id=<?php echo $post['id'] ?>"><div class="post_wrap flex" style="background-image: url(<?php echo $firstimg ?>);">
                     
                        <div class="background_grad"></div>
                        <div class="post_info flex">
                            <div class="post_brnd_price">
                                <h3><?php echo $post['brand'].'  '.$post['price'].'€'; ?></h3>
                            </div>
                            <div class="model flex">
                                <p><?php echo $post['model'].' '.$post['enginecapacity'].'l';?></p>
                                <p><?php echo $post['year'].' | <b>'.$post['millage'].'km</b>';?></p>
                            </div>
                            
                        </div>
                    </div></a>
                    <?php } ?>
                </div>
            </div>
            </div>
        </div>

        <div id="chooseabrand" style="text-align: center">
            <div class="margins">
                <h4 class="choose_style"><?php echo $texts[$lang]['choose'] ?></h4></div>

            <form class="wrap" action="searching.php" method="POST">
                <input class="logo volvo" type="submit" value="Volvo" name="brand[]">
                <input class="logo mazda" type="submit" value="Mazda" name="brand[]">
                <input class="logo opel" type="submit" value="Opel" name="brand[]">
                <input class="logo hyundai" type="submit" value="Hyundai" name="brand[]">
                <input class="logo mercedes" type="submit" value="Mercedes" name="brand[]">
                <input class="logo bmw" type="submit" value="BMW" name="brand[]">
                <input class="logo lexus" type="submit" value="Lexus" name="brand[]">
                
                <input class="logo landrover" type="submit" value="Landover" name="brand[]">
                <input class="logo porsche" type="submit" value="Porsche" name="brand[]">
                <input class="logo audi" type="submit" value="Audi" name="brand[]"> 
                <input class="logo jaguar" type="submit" value="Jaguar" name="brand[]">
                <input class="logo volkswagen" type="submit" value="Volkswagen" name="brand[]">
                <input class="logo ford" type="submit" value="Ford" name="brand[]">
                <input class="logo honda" type="submit" value="Honda" name="brand[]">
                <input class="logo subaru" type="submit" value="Subaru" name="brand[]">
                <input class="logo mitsubishi" type="submit" value="Mitsubishi" name="brand[]">
                <input class="logo peugeot" type="submit" value="Peugeot" name="brand[]">
                <input class="logo nissan" type="submit" value="Nissan" name="brand[]">
                
            </form>
        </div>
        
        <div id="findcarforyou" style="text-align: center">     
            <div class="findcarlogo">
                <h2><?php echo $texts[$lang]['chooseThebest'] ?></h2>
            </div>
                <div class="cut2"></div>
        </div>
        
        <div id="table_about_cars">
			<div class="first_tablecars flex3">
				<table class="img_wrap" id="columns_wrapping">
				<tr><th><div class="img_cont"><img src="img/1car.png" width= "80%"></div></th></tr>
				<tr><th><h3 class="text_under_cars_caption"><?php echo $texts[$lang]['text1name'] ?><br></h3></th></tr>
				<tr><th><p class="text_under_cars"><?php echo $texts[$lang]['text4'] ?></p></th></tr>
				</table>
							
				<table class="text_wrap" id="columns_wrapping">
				<tr><th><div class="img_cont"><img src="img/2car.png" width= "80%"></div></th></tr>
				<tr><th><h3 class="text_under_cars_caption"><?php echo $texts[$lang]['text2name'] ?><br></h3></th></tr>
				<tr><th><p class="text_under_cars"><?php echo $texts[$lang]['text5'] ?></p></th></tr>
				</table>
							
				<table class="text_wrap" id="columns_wrapping">
				<tr><th><div class="img_cont"><img src="img/3car.png" width= "80%"></div></th></tr>
				<tr><th><h3 class="text_under_cars_caption"><?php echo $texts[$lang]['text3name'] ?><br></h3></th></tr>
				<tr><th><p class="text_under_cars"><?php echo $texts[$lang]['text6'] ?></p></th></tr>
				</table>
			</div>
        </div>
    
        <div id="beepylogo">
          <!---  <div class="beepylogo">
                <img src="img/logo2.png" width="20%">
            </div>-->
            <div class="why_beepy_link beepylogo">
               <a href="downloads/Beepy_prezentācija2.pdf" download="Beepy_prezentācija2"><h2><?php echo $texts[$lang]['why'] ?></h2></a>
               <button class="seeourpresentation"><a href="downloads/Beepy_prezentācija2.pdf" download="Beepy_prezentācija2"><p><?php echo $texts[$lang]['present'] ?></p></a></button>
            </div>
            <div class="cut3"></div>
        </div>
        
        <div id="blog">
            <div class="blog">
                <h4 class="blog_style"><?php echo $texts[$lang]['blog'] ?></h4>
            </div>      
    
            <div class="second_tablecars flex3">
			<table class="img_wrap2" id="columns_wrapping">
				<tr><th><div class="img_cont2"><img src="img/4car.png" width="418" height="345"></div></th></tr>
				<tr><th><h3 class="text_under_cars_caption2"><?php echo $texts[$lang]['text4name'] ?><br></h3></th></tr>
				<tr><th><p class="text_under_cars2"><?php echo $texts[$lang]['text1'] ?></p></th></tr>
			</table>
			 <table class="text_wrap2" id="columns_wrapping">
				<tr><th><div class="img_cont2"><img src="img/5car.png" width="418" height="345"></div></th></tr>
				<tr><th><h3 class="text_under_cars_caption2"><?php echo $texts[$lang]['text5name'] ?><br></h3></th></tr>
				<tr><th><p class="text_under_cars2"><?php echo $texts[$lang]['text2'] ?></p></th></tr>
			</table>			
			<table class="text_wrap2" id="columns_wrapping">
				<tr><th><div class="img_cont2"><img src="img/6car.png" width="418" height="345"></div></th></tr>
				<tr><th><h3 class="text_under_cars_caption2"><?php echo $texts[$lang]['text6name'] ?><br></h3></th></tr>
				<tr><th><p class="text_under_cars2"><?php echo $texts[$lang]['text3'] ?></p></th></tr>
			</table>				
			</div>
   
        </div>
        
        <?php include 'assets/footer.php'; ?>  
</div>  
    </body>

</html>