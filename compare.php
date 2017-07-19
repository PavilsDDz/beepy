<?php 
	include "assets/setup.php";
	include "assets/connect.php";
	include "assets/searchingLang.php";
	include "assets/extras.php";
	//include "assets/session.php"; 
	
	$texts['lv']['TechnicalInsp'] = 'Tehniskā apskate';

	$texts['en']['TechnicalInsp'] = 'Tehnical inspection';

	$texts['ru']['TechnicalInsp'] = 'Технический просмотр';

	$ids;

	$query = "SELECT * FROM products LIMIT 3";
	//print_r($result);

	if (isset($_GET['idc'])) {
		$ids = $_GET['idc'];

		$Q="SELECT * FROM products WHERE ";
		$counter1 = 0;
		foreach ($ids as $value) {
			$Q = $Q.' id = '.$value;
			if($counter1<count($ids)-1){
				$Q .= " OR";
			}
		$counter1++;
		}
	$result = getAllDataFromDatabase($Q);

	}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800" rel="stylesheet">
        <script type="text/javascript" src="scripts/jquery-2.2.3.js"></script>
        <link rel="stylesheet" type="text/css" href="css/compare.css">
 </head>
 <body>
 	<?php include "assets/header.php" ?>
 		<div class="content_container">
 			<div class="compare_view flex">
 				<div class="properites">
 					<div class="back"></div>
 					<p class="title" style="background-color: rgba(0,0,0,0);"></p>
 					<div class="properites_list">
	 					<p><?php echo $texts[$lang]['year'] ?></p>
	 					<p><?php echo $texts[$lang]['type'] ?></p>
	 					<p><?php echo $texts[$lang]['likes'] ?></p>
	 					<p><?php echo $texts[$lang]['millage'] ?></p>
	 					<p><?php echo $texts[$lang]['fuel_type'] ?></p>
	 					<p><?php echo $texts[$lang]['engine_capacity'] ?></p>
	 					<p><?php echo $texts[$lang]['transmission'] ?></p>
	 					<p><?php echo $texts[$lang]['color'] ?></p>
	 					<p><?php echo $texts[$lang]['TechnicalInsp'] ?></p>
 					</div>
 				</div>
 				<div class="cars_wrap flex">
 				<?php 
					include "assets/eqip.php";
 					$counter = 0;
 					$ekstras = [];
 					$extraStuff = [];
 					$additional;
 					foreach ($result as $car) { 

 					$ekstras[$counter] = $car['additional'];
 					$extraStuff[$counter] = [];

 					$explodeindex = array('Equipment', 'Lights', 'Interior', 'Steering', 'Safety', 'Mirrors', 'Audiosystem', 'Seats');
 					

 						foreach($explodeindex as $index){

							$extraStuffString = explode($index, $ekstras[$counter]);
							$ekstras[$counter]  = $extraStuffString[1];
							$extraStuff[$counter][$index] = explode(" ", $extraStuffString[0]);
						}


 					$imgs = explode(';',$car['photoid'])
 					?>
 					<div class="car_overview <?php echo "c".$counter." ";if ($counter==0) {
 						echo'first';
 					}else if($counter==count($result)-1){echo "last";} ?>">
 						<div class="imgs">
	 						<div class="next" counter='<?php echo $counter; ?>'></div>
	 						<div class="prev" counter='<?php echo $counter; ?>'></div>
	 							<?php foreach ($imgs as $img) { if(!empty($img)){?>
	 							<div class="img" style="background-image: url(<?php echo $img ?>);"></div>
	 							<?php }} ?>
 						</div>
 						<p class="title"><?php echo $car['brand'].' '.$car['model'] ?></p>
 						<div class="stats">
 							<p><?php echo $car['year']; ?></p>
							<p><?php echo $texts[$lang][$car['cartype']]; ?></p>
 							<p><?php echo $car['price']; ?> €</p>
 							<p><?php echo $car['millage']; ?> <?php echo $texts[$lang]['km']; ?></p>
							<p><?php echo $texts[$lang][$car['fueltype']]; ?></p>
 							<p><?php echo $car['enginecapacity']; ?></p>
 							<p><?php echo $texts[$lang][$car['gearbox']]; ?></p>
 							<p><?php echo $car['color']; ?></p>
 							<p><?php echo $car['technicalinspection']; ?></p>

 						</div>
 					</div>
 					<?php $counter++; } ?>
 					<div class="eqip">
 					






 					<?php foreach ($eqipament_list as $list_key => $list) { ?>
 						<p class="title"><?php echo $langu[$lang][$list_key] ?></p>
 						<div class="stuff_in_eqip">
 						<?php foreach ($list as $thing) { ?>
 							<div class="slingle_stuff flex">
 							<p class="thing"><?php echo $langu[$lang][$thing] ?></p>
 								<?php $counter2=0;
 									while($counter2<=count($result)-1){
 										if (in_array($thing, $extraStuff[$counter2][$list_key])) {?>
 											<div class="checked flex"><div class="check"></div></div>
 										<?php }
 										?>

 								<?php $counter2++;} ?>
 							</div>
 						<?php } ?>
 						</div>
 					<?php } ?>








 					</div>
 				</div>
 			</div>
 		</div>
 	<?php include "assets/footer.php" ?>
 </body>
 <script type="text/javascript">
 $(function(){	

 	var counter = [0,0,0]

   	function pictures(dir,that){
   		siblings = that.siblings('.img');
   		siblings.css('display','none')
   		c = that.attr('counter')
   		$('.c'+c+' .img:eq('+counter[c]+')').css('display','block');

   		if (dir==1) {
	   		if (counter[c]<$('.c'+c+' .img').length-1) {
	   			counter[c]++
	   		}else{
	   			counter[c]=0
	   		}
   		}
   		if (dir==-1) {
   			if (counter[c]>0) {
	   			counter[c]--
	   		}else{
	   			counter[c]=$('.c'+c+' .img').length-1
	   		}
   		}
   		console.log($('.c'+c+' .img:eq('+counter[c]+')'), counter[c])
   		
   		
   	}
   	$('.next').click(function(){
   		//alert('go');
   		that = $(this);
   		dir = 1;
   		pictures(dir,that);
   		
   	})
   	$('.prev').click(function(){
   		//alert('go');
   		that = $(this);
   		dir = -1;
   		pictures(dir,that);
   		
   	})
   })
 </script>
<?php

  ?> 

 <?php echo $Q; ?>
 </html>