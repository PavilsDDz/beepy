<?php
    include ('assets/connect.php');
    include 'assets/setup.php';

    if(isset($_GET["logout"])){
        unset($_SESSION['uid']);
        header('Location: index.php');
        exit;
    }
    //print_r($_POST);
    //print_r($_SESSION);
    $_POST = array();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
<link rel="stylesheet" type="text/css" href="css/style.css">
    <?php include"assets/head.php" ?>



        <title>index</title>
    </head>

    <body>
<?php
    if(isset($_SESSION)){
        //print_r($_SESSION);
    }
    include"assets/header.php"
    
?>

<div id="fixed" class="content_container">

        <div id="header">
        <!--    -->
            
            <div class="header_content">
                <div class="findcar">
                    <a href="searching.php"><img src="img/findacar.png" width="34%"></a> 
                </div>
                  
                <!--<form style="text-align: center" class="header_form">
                    <input type="text" placeholder="Find a car" maxlength="" size="" value="">
                </form>-->

                <!--<div class="search_buttons" style="text-align: center">
                    <div class="button_search_new">
                        <button type="button">search new</button>
                    </div>

                    <div class="button_search_used">
                        <button type="button"><a href="searching.php">search used</a></button>
                    </div>
                </div>-->

            </div>  
            
            <div class="cut"></div>
        </div>
    
        <div id="chooseabrand" style="text-align: center">
            <div class="margins">
                <h4 class="choose_style">Choose a brand</h4></div>

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
                <h2>Find the right<br>car for you</h2>
            </div>
                <div class="cut2"></div>
        </div>
        
        <div id="table_about_cars" align="center">
                <table class="first_tablecars">
                <tr class="img_wrap">
                <th><div class="img_cont"><img src="img/1car.png" width="297" height="296"></div></th>
                <th><div class="img_cont"><img src="img/2car.png" width="297" height="296"></div></th>
                <th><div class="img_cont"><img src="img/3car.png" width="297" height="296"></div></th>
                </tr>
                <tr class="text_wrap">
                <th>
                <h3 class="text_under_cars_caption">All in one-auto; motto; trucks; service.<br></h3>
                <p class="text_under_cars">Beepy is a revolutionary digital car sales portal what offers the most complete for users and easily understandable car purchase experience in the Baltics.</p>
                </th>
                <th>
                <h3 class="text_under_cars_caption">Always in contact with the new<br></h3>
                <p class="text_under_cars">With an unused car design types you may click on "Auto show" where are all the brand models support portal, allowing potential client find a best fit, without leaving home comfort.</p>
                </th>
                <th>
                <h3 class="text_under_cars_caption">A new car trading system<br></h3>
                <p class="text_under_cars">To the analysis and publication of information on the real price indicators, the necessary parameters fair transactions and mutual trust between buyers and sellers of car.</p>
                </th>
                </tr>
                </table>
        </div>
    
        <div id="beepylogo">
          <!---  <div class="beepylogo">
                <img src="img/logo2.png" width="20%">
            </div>-->
            <div class="why_beepy_link beepylogo">
               <a href="downloads/Beepy_prezentācija2.pdf" download="Beepy_prezentācija2"><h2>Why Beepy?</h2></a>
               <p>See our presentation</p>
            </div>
            <div class="cut3"></div>
        </div>
        
        <div id="blog">
            <div class="blog">
                <h4 class="blog_style">Blog</h4>
            </div>      
    
            <div align="center">
                <table class="second_tablecars">
                <tr class="img_wrap2">
                <th><div class="img_cont2"><img src="img/4car.png" width="418" height="345"></div></th>
                <th><div class="img_cont2"><img src="img/5car.png" width="418" height="345"></div></th>
                <th><div class="img_cont2"><img src="img/6car.png" width="418" height="345"></div></th>
                </tr>
                <tr class="text_wrap2">
                <th>
                <h3 class="text_under_cars_caption2">The wider car business opportunities in Baltics<br></h3>
                <p class="text_under_cars2">The site offers some new and used cars. Provides a wide range of business opportunities in the lead car opportunities in Baltics.</p>
                </th>
                <th>
                <h3 class="text_under_cars_caption2">Your ideal car one click away<br></h3>
                <p class="text_under_cars2">User convenience available “Smart seeker”, which allows you to select the most appropriate car models, according to customer needs, desires and options. In addition to the proposed model descriptions with the opportunity to compare them.</p>
                </th>
                <th>
                <h3 class="text_under_cars_caption2">Comfortable. Faster. Easier.<br></h3>
                <p class="text_under_cars2">Comfortable – online catalog with each new car brand. Present your brand among the leading car dealers in Latvia. Faster – allows car enthusiasts to come to you. To customers who are already interested in purchasing the car. Easier – saving time and money administering your home page. The exhibition will offer in blank and begin to trade today.</p>
                </th>
                </tr>
                </table>    
            </div>
            
        </div>
        
        <?php include 'assets/footer.php'; ?>  
</div>  
    </body>
</html>