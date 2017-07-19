<?php
    include ('assets/connect.php');
    include 'assets/setup.php';

	$texts = [];

	$texts['lv'] = [];
	$texts['en'] = [];
	$texts['ru'] = [];

	$texts['lv']['Personal_info'] = 'Par Mani';
	$texts['lv']['Edit_info'] = 'rediģēt profilu';
	$texts['lv']['Your_cars'] = 'Manas Mašīnas';

	$texts['en']['Personal_info'] = 'Personal Info';
	$texts['en']['Edit_info'] = 'Edit info';
	$texts['en']['Your_cars'] = 'Your cars';
	
	$texts['ru']['Personal_info'] = 'Про Меня';
	$texts['ru']['Edit_info'] = 'Редактировать профиль';
	$texts['ru']['Your_cars'] = 'Мойи Машини';

    if(isset($_SESSION['uid']) && $_SESSION['uid'] > 0){
        $id = $_SESSION['uid'];
    } else{
		//$_SESSION['uid'] = $_GET[0]['id'];
        header("location: login.php");
        die();
		
	// if(isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_SESSION['uid']) && $_SESSION['uid'] > 0){
	// 		$_SESSION['uid'] = $_GET[0]['id'];
	// 		header("location: profile.php");
	// 		die();
	// 	}
    }

    $userQuery = "SELECT * FROM `users` WHERE id = :id ";
    $userPayload["id"] = $_SESSION['uid'];
    $userResult = getAllDataFromDatabase($userQuery, $userPayload);
   // print_r($userResult);
    //  Sākas likepage...
    if(isset($_SESSION['uid'])){
        //$userQuery = "SELECT * FROM `users` WHERE id = :id ";
        //$userPayload["id"] = $_SESSION['uid'];
        //$userResult = getAllDataFromDatabase($userQuery, $userPayload);
    }

    $query = "SELECT id, brand, model, year, price, photoId, engineCapacity FROM products WHERE userid = :userid ";
     $Qply = [];
    $Qply['userid']  = $_SESSION['uid'];
    $result = getAllDataFromDatabase($query,$Qply);

    //$userQuery = "SELECT postid FROM 'users'";
    //$usersResult = getAllDataFromDatabase($userQuery);

?>


<?php
    foreach($userResult as $userRow){

        $imgLinks = explode(";", $userRow['image']);?>
        
  <?php  }?>

        <?php /*
            if(isset($_POST['like'])){

                $selectid = "SELECT postid FROM users WHERE id = :id ";
                $selectPayload["id"] = $_SESSION['uid'];
                $selectidResult = getAllDataFromDatabase($selectid, $selectPayload);

                $payload['postid'] = $_POST['like'];
                $payload['id'] = $_SESSION['uid'];

                $userQuery = "UPDATE users SET postid = :postid WHERE id = :id";
                $userResult = insertDataInToDataBase($userQuery, $payload);

                $resultall = $selectidResult[0]["postid"].";".$_POST['like'];

                $resultQuery = "UPDATE users SET postid = :postid WHERE id = :id";
                $resultPayload["id"] = $_SESSION['uid'];
                $resultPayload["postid"] = $resultall;

                insertDataInToDataBase($resultQuery, $resultPayload);

                $likeArray = (explode( ";", $resultall)); 
                echo "<br>";
            }
                // $getid = "SELECT postid FROM users WHERE id = :id ";
                // $resultPayload["id"] = $_SESSION['uid'];
                // $alldata = getAllDataFromDatabase($getid, $resultPayload);
        

                $q = "SELECT * FROM `products` WHERE";
                $counter = 0;
                $pa = [];

                foreach($likeArray as $onelikeArray){
                    $q = $q." id =:id".$counter." AND";
                    $pa["id".$counter] = $onelikeArray;  
                    $counter++;
                    echo "<br>";
                }

                $q = substr($q, 0, -4);

                $resultlike = getAllDataFromDatabase($q, $pa);

               print_r($resultlike);
                echo "yoo";

                foreach($resultlike as $one){
                    echo "<br>";
                    echo "<br>";
                    echo "<br>";
                    echo $one['brand'];
                    echo $one['model'];
                    echo $one['year'];
                    echo "<br>";
                    echo $one['price'];
                }
       */ ?>


<html>
<head>
<meta charset="utf-8">
    <?php include"assets/head.php" ?>

<link rel="stylesheet" type="text/css" href="css/profile.css">


</head>

<body>
<?php include"assets/header.php" ?>
<div id="fixed" class="content_container">

			

			<div id="second_block">
				<table><tr>
					<th class="personal_info">
						
					<table align="center" width="70%">
					<tr>
						<th><h2 class="personal_info_style"><?php echo $texts[$lang]['Personal_info'] ?></h2></th>
						<th style="vertical-align: top;">
							<div class="edit_info">
							<a href='editprofile.php'><button type="button"><?php echo $texts[$lang]['Edit_info'] ?></button></a>
							</div>
						</th>
					</tr>
					<tr>
						<td class="photo_td">
						<div id="user_img">				
							<img src="<?php if ($userRow['image']=='') {echo "img/unset.png";}else{echo $userRow['image'];} ?>" width="100%">
						</div>
						</td>
						<td class="ul_td">
						  <table class="list1">
						   <tr>
							<th class="center"><img src="img/profile.png" width="45%"></th>
							<th><a><span><?php echo ($userRow['firstname'].' '.$userRow['lastname']); ?></span></a></th>
						   </tr>
						   <tr>
							<td class="center"><img src="img/mobile.png" width="60%"></td>
							<td><a><?php echo ($userRow['telephone']); ?></a><br></td>
						  </tr>
							<tr>
							<td class="center"><img src="img/email.png" width="45%"></td>
							<td><a><?php echo ($userRow['email']); ?></a><br></td>
						  </tr>
							<tr>
							<td class="center"><img src="img/map.png" width="40%"></td>
							<td><a> <?php echo ($userRow['country']); ?></a></td>
						  </tr>
						 </table>
						</td>
					</tr>
					</table>
				</th></tr></table>	
					
					
					
					<div class="your_cars"><h2><?php echo $texts[$lang]['Your_cars'] ?></h2></div>
					<div id="table_cars">
						<div class="wrap flex">

						 <?php foreach ($result as $row){
						 		$imgLinks = explode(';', $row['photoId'])
						 		?>



							  


						 				<a class="logo_wrap" href="product.php?id=<?php echo $row['id'] ?>">
	                                        <div class="logo1 " style="background-image: url(<?php echo $imgLinks[0] ?>);">
												<div class="text">
													<h3><?php echo $row['brand'].' '.$row['model'].' '.$row['engineCapacity'].' '.$row['year']?></h3>
													<p><?php echo $row['price']; ?></p>
												</div>
											</div>
										</a>




					        
					        <?php
					            echo "<br>";
					            echo "<br>";
					        } ?>

							
						</div>
					</div>
					
					
					
				<!--	<th class="table_cars_th">
					
						<table>
						<tr>
							<th><h2>Favourites</h2></th>
						    </tr>
						    <tr>
							<td>
								<ul>
									<li class="list2">
										<a><img src="img/delete.png" width="2.3%">Delete</a>
										<a><img src="img/compare.png" width="2.5%">Compare</a>
										<a> <img src="img/share.png" width="1.8%">Share</a>
									</li>
								</ul>
							</td>
						    </tr>
						    <tr>
							<td>
					
					<div id="table_cars">
				
					<div class="wrap">
					<div class="logo car_1">
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					<div class="logo car_2">
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					<div class="logo car_3">
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					<div class="logo car_1">
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					<div class="logo car_2">
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					<div class="logo car_3">
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					<div class="logo car_1">
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					<div class="logo car_2">
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					<div class="logo car_3">
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					<div class="logo car_1">
					
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					<div class="logo car_2">
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					<div class="logo car_3">
						<div class="text">
							<br><h3>Audi A7 3.0 | 2013</h3>
							<p>20 000$</p>
						</div>
					</div>
					</div>
					</div>
					
					</td></tr></table>
					
					</th>
				</tr></table>-->
			</div>
			
</div>
<?php include'assets/footer.php' ?>
</body>
</html>