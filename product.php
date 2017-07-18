<?php
    include ('assets/connect.php');
    include 'assets/setup.php';

    // include ('oldcardeleter.php');

    if(isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
    } else{
       header("location: ".$SiteUrl."searching.php");
    }
  

    $timeNow = date("Y-m-d H:i:s");

    $query = "SELECT id, date FROM `products` WHERE id = :id ";
    $playload["id"] = $_GET['id'];
    $result = getAllDataFromDatabase($query, $playload);
    if (count($result)<1) {
        header("location: ".$SiteUrl."searching.php");
    }

    $postTime = $result[0]['date'];

    // echo "TIME NOW:";
    // var_dump($timeNow);
    // echo "</br> </br>";
    // echo "TIME POST CAR:";
    // var_dump($postTime);

    if($timeNow < $result ){
        $query = "SELECT * FROM `products` WHERE id = :id ";
        $playload["id"] = $_GET['id'];
        $result = getAllDataFromDatabase($query, $playload);
    }else{
        die();
    }

	$sellerQuery = "SELECT * FROM `users` WHERE id = :id ";
        $userPlayload["id"] = $result[0]["userid"];
        $sellerResult = getAllDataFromDatabase($sellerQuery, $userPlayload);

    // echo "<pre>";
    // var_dump($result[0]);
    // echo "</pre>";
        
	foreach($sellerResult as $sellerRow ){
		
		}
		if (isset($_SESSION['uid'])) {
	
	$userQuery = "SELECT * FROM `users` WHERE id = :id ";
        $userPlayload["id"] = $_SESSION['uid'];
        $userResult = getAllDataFromDatabase($userQuery, $userPlayload);

			foreach($userResult as $userRow ){
		
			}
		}
?>

<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/product.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
	
	<script src="scripts/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="jquery.autocolumnlist.js" type="text/javascript"></script>

<!--for buttons-->	
	<script>
	var img_count
$(function(){
		img_count = $("#imgs img").length
		
     $("#imgs img").hide();     
     var select= $("#imgs img:eq(0)");
	 console.log($("#imgs img:eq(0)"))
	 
     select.show();     
	 
		counter = 0 
		
     $("#next").click(function(){
		 
		counter++
		
		if(counter==img_count){
			counter =0
		}
		console.log(counter)
		 
        select.hide();
        select=$("#imgs img:eq("+counter+")");
        select.show();
		$('#num').text(counter+1);				
     });

     $("#forward").click(function(){
        
		counter--
		
		if(counter<0){
			counter=img_count-1
		}
		console.log(counter)
		
		
		
        select.hide();
        select=$("#imgs img:eq("+counter+")");
        select.show();  
		$('#num').text(counter+1);		
     }); 
	 
});  

$(function(){
		img_count
    var number = 1;
     $('#next').click(function(){
        ++number;
		number = number > img_count ? img_count: number;
  
    });
});

$(function(){
	var img_count = $("#imgs img").length
	$('#num_count').html(img_count)
});

	</script>
<!--for hided table-->
	<script>
$(document).ready(function() { 
      $("A#trigger").toggle(function() { 
      $("DIV#box").fadeIn();
        return false;
      },  
      function() { 
        $("DIV#box").fadeOut();
        return false;
      });
	  
	   $('A#trigger').click(function(){
       $('html, body').animate({scrollTop:$(document).height()}, 'slow');
        return false;
    });
});
	</script>
<!--for float block-->
	<script>	
$(function(){
	var ww = $(window).width()

	var offset = $('.submit_button').offset()

	 top_ = offset.top-$(".information_table").height()-ww*0

	 $(window).scroll(function () {
	  if ($(this).scrollTop() > top_) {
	   $('.information_table').css({'position': 'absolute', 'top': top_});
	  } else {
	   $('.information_table').attr('style','');
	  }
	 $('.information_table').show('slow', {animation:'slide'})
	 });
	 $(window).resize(function(){
		 ww = $(window).width()
		 offset = $('.submit_button').offset()
		 top_ = offset.top-$(".information_table").height()-ww*0
 })
 })
	</script>
		
</head>

<body>
<div id="class_container">
<?php 
    include ('assets/header.php');
	
 ?>
	<div id="header">
		<div id="car_photo_block">
			<div id="imgs" class="photos_wrap">

				<?php foreach ($result as $row){ ?>
                    <?php $imgLinks = explode(";", $row['photoid']); ?>
                    	<!--<img src="<?php echo $imgLinks[0];?>" alt="Smiley face" height="50" width="50"><br>-->
					<?php } ?>

					<?php
						$a=0;
						while($a <= count($imgLinks)-2){
							//print_r($imgLinks);
								
							echo "<td>";?> <img src="<?php echo $imgLinks[$a]; ?>" height="50" width="50"> <?php echo "</td";
							$a++;
						}
					?>
			</div>

			<div id="next" class="gonext">
			<button type="button"></button>
			</div>
			
			<div id="forward" class="goforward">
			<button type="button"></button>
			</div>
			
			<div class="photo_counter">
			<span id="num" class="numbers_style">1</span>
			<span class="numbers_style">/</span>
			<span id="num_count" class="numbers_style"></span>
			</div>
			</div>

		<div id="information_block">
			<table class="information_table">
			  
			<tr>
				<th>				
					<?php echo '<h1>'.$row['price']."$".'</h1>' ?>
					<?php echo'<h2>'.$row['brand']." ".$row['model']." ".$row['enginecapacity']." | ".$row['year'].'</h2>' ?>
				</th>
				<th></th>
			</tr>
			<tr><td><p>Car type:</p></td> <td><span class="small_car_image"><img src="img/car_types/<?php echo $row['cartype']?>.png" width="35%"></span></td></tr>
			<tr><td><p>Mileage:</p></td> <td><p><?php echo $row['millage']?></p></td></tr>
			<tr><td><p>Fuel type:</p></td> <td><p><?php echo $row['fueltype']." ".$row['enginecapacity'] ?></p></td></tr>
			<tr><td><p>Gear box:</p></td> <td><p><?php echo $row['gearbox']?></p></td></tr>
			<tr><td><p>Color:</p></td> <td><div class="color" style="background-color: <?php echo $row['color'] ?>"></div></td></tr>
			<tr><td><p>VIN:</p></td> <td><p><?php echo $row['registrationnumber'] ?></p></td></tr>
			<tr><td><p>Tehniska skate:</p></td> <td><p><?php echo $row['technicalinspection'] ?></p></td></tr>
				
			<tr>
			<th>				
				<div class="tech_spec">
				<a href='#' id='trigger'><button type="button">Tech spech</button></a>
				</div>
			</th>
			<th></th>
			</tr>
			   
			</table>
		</div>
	</div>
		
	<div id="second_div">	
		<table class="second_table">
		   <tr>
			<th class="photo_td" >				
				<img src="<?php if(isset($sellerRow['image'])&&$sellerRow['image']!=''){echo $sellerRow['image'];}else{echo "img/unset.png";} ?>" width="100%">
				<p class="seller_name"><?php echo $sellerResult[0]["firstname"];?></p>
			</th>
			<th>	
				<p class="text_under"><?php echo $row['info'] ?></p>
			</th>
		   </tr>
		   <tr>
			<td>
			</td>
			<td>
				<ul class="list1">
					<li>
						<a><img src="img/mobile.png" width="2.8%"><?php echo  $sellerResult[0]["telephone"];?></a>
					<!--	<a href="/beepy/send_email.php" src="img/email.png" width="2%">Send email</a>-->
					<!--	<a><img src="img/map.png" width="1.8%"><?php// echo $row['placewherecarat']?></a>-->
					<!--	<a><img src="img/share.png" width="2%">Share</a>-->
					</li>
				</ul>

			</td>
			</tr>
		</table>
	</div>
	
	<div id="send_email_form">
	<form method="post">
		<p class="borders">Email:  <?php echo $sellerResult[0]["email"]; ?></p>
		
			<?php
			if(isset($_SESSION['uid']) && $_SESSION['uid'] > 0){ ?>
				<!--<p class="borders">	Subject: <input name="subject" type="text" value="" /><br /></p>-->
			<?php   } else{ ?>
				<!--	<p class="borders">Subject: <input name="subject" type="text" /><br /></p>-->
			<?php   }
			?>
		
			<p class="borders">Message:</p>
			<p><textarea name="comment" rows="15" cols="40"></textarea></p>
			<div class="submit_button">
			<a><button type="submit" value="Submit">Submit</button></a>
			</div>
			
	</form>	
	</div>
	
	<?php
		// EMAIL STUFF
		//if "email" variable is filled out, send email
		if (isset($_REQUEST['email']))  {
		//Email information
			$admin_email = $userRow['email'];
			$email = $_REQUEST['email'];
			$subject = $_REQUEST['subject'];
			$comment = $_REQUEST['comment'];
		//send email
		mail($admin_email, "$subject", $comment, "From:" . $email);
		
		//Email response
		echo "Thank you for contacting us!";
		}
		//if "email" variable is not filled out, display the form
		else  {
		?>

		
	<?php
	}
	?>

	<div id="box">
		<table class="table" align="center">
			<?php
			
				$allIndexNames = array('equipment', 'lights', 'interior', 'steering', 'safety', 'mirrors', 'audiosystem', 'seats');
				$explodeindex = array('Equipment', 'Lights', 'Interior', 'Steering', 'Safety', 'Mirrors', 'Audiosystem', 'Seats');
				$additional = $row['additional'];
				$extraStuff = [];
				//echo $additional;
				foreach($explodeindex as $index){

					$extraStuffString = explode($index, $additional);
					$additional = $extraStuffString[1];
					$extraStuff[$index] = explode(" ", $extraStuffString[0]);
				}
			?>

			<?php 
				if (isset($additional)) {
					foreach($explodeindex as $value){
						$save_values[$value]=array();
			?>
						<?php foreach($extraStuff[$value] as $extra){
							array_push($save_values[$value],$extra);
						?>
						<?php }
					}
				} else {
					// echo "NEKAS NAV chill";
					die();
				}
			?>
			
			<?php	
				$explodeindexname = array('Equipment', 'Interior', 'Steering', 'Seats', 'Lights', 'Mirrors', 'Safety', 'Audiosystem');

				if (isset($additional)) {?>

			<tr> <?php
				foreach($explodeindexname as $value){ ?> 
				
				<th class=>
					<h4><?php echo $value ?></h4>

					<?php foreach($extraStuff[$value] as $extra){?>
						<h3><?php echo $extra;?></h3>
					<?php } ?>
				</th>

				<?php } ?>
			</tr>

			<?php
			} else {
				// echo "NEKAS NAV chill";
				die();
			}
			?>
		</table>
	</div> 

<div id="botDiv"></div>
</div>
</body>
</html>