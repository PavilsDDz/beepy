<?php
// yooo looooo 
include ('assets/connect.php');
include ('assets/setup.php');
include('assets/addcarLang.php');

include ('assets/functions.php');
include("assets/brandsandmodels.php");
    if (!isset($_SESSION['uid'])) {
        echo"not Loged in";
        header("location:login.php?dir=sell");
        die();
    }

//print_r($_POST);

//print_r($_SESSION);
$success = false;
$userId = $_SESSION['uid'];
$fileDestString ='';
// ---- > submits.
    if (isset($_POST["submit"])) {
          

        if(
            (
                isset($_POST['carType'])&&
                isset($_POST['brand'])&&
                isset($_POST['model'])&&
                isset($_POST['year'])&&
                isset($_POST['fuelType'])&&
                isset($_POST['color'])&&
                isset($_POST['price'])&&
                isset($_POST['engineCapacity'])&&
                isset($_POST['gearBox'])&&
                isset($_POST['millage'])
            )
            &&
            (
                !empty($_POST['carType'])&&
                !empty($_POST['brand'])&&
                !empty($_POST['model'])&&
                !empty($_POST['year'])&&
                !empty($_POST['fuelType'])&&
                !empty($_POST['color'])&&
                !empty($_POST['price'])&&
                !empty($_POST['engineCapacity'])&&
                !empty($_POST['gearBox'])&&
                !empty($_POST['millage'])
             )
             &&
            (
               $_POST['carType']!=''&&
               strlen($_POST['carType'])>1&&
               $_POST['brand']!=''&&
               $_POST['model']!=''&&
               $_POST['year']!=''&&
               $_POST['fuelType']!=''&&
               $_POST['color']!=''&&
               $_POST['price']!=''&&
               $_POST['engineCapacity']!=''&&
               $_POST['gearBox']!=''&&
               $_POST['millage']!=''
             )
            
        ){
           

            //print_r($_POST);
            $error = array();
            $carType = $_POST["carType"];
            $brand = $_POST["brand"];
            $model = $_POST["model"];
            $year = $_POST["year"];
            $fuelType = $_POST["fuelType"];
            $color = $_POST['color'];
            $price = $_POST["price"];
            $engineCapacity = $_POST["engineCapacity"];
            $gearBox = $_POST['gearBox'];
            $info = $_POST["info"];
            $registrationNumber = $_POST["registrationNumber"];
            $technicalInspection = $_POST["technicalInspection"];
            $date = date('Y-m-d H:i:s');
            $newcar = $_GET["newcar"];
            $millage = $newcar ? null : $_POST["millage"];
    
        // // CheBox Stuff
        // $additional = $_POST['additional'];
        
        // $equipment = $_POST['equipment'];
        // $lights = $_POST['lights'];
        // $interior = $_POST['interior'];
        // $steering = $_POST['steering'];
        // $safety = $_POST['safety'];
        // $mirrors = $_POST['mirrors'];
        // $audiosystem = $_POST['audiosystem'];
        // $seats = $_POST['seats'];
    
        // 
            for ($i=0; $i < count($_FILES['file']['name']); $i  ++) { 

                $fileName = $_FILES['file']['name'][$i];
                $fileTmpName = $_FILES['file']['tmp_name'][$i];
                $fileSize = $_FILES['file']['size'][$i];
                $fileError = $_FILES['file']['error'][$i];
                $fileType = $_FILES['file']['type'][$i];
                $fileExt = explode('.', $fileName);
                $fileActualyExt = strtolower(end($fileExt));

                $allowed = array('jpg', 'jpeg', 'png', 'pdf');

                    if ($fileTmpName != "") {
                        $fileNameNew = date('YmdHis'). $_SESSION['uid'].$i.'.'.$fileActualyExt;

                        $fileDestination = 'uploads/'.$fileNameNew;
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        // echo "Uploaded";
                        $fileDestString = $fileDestString.$fileDestination.";";
                    }
                }
            }
    
            $allIndexNames = array('equipment', 'lights', 'interior', 'steering', 'safety', 'mirrors', 'audiosystem', 'seats');
            $allIndexSeperator = array('Equipment', 'Lights', 'Interior', 'Steering', 'Safety', 'Mirrors', 'Audiosystem', 'Seats');
            $additional = "";
            $equ_counter = 0;
            foreach($allIndexNames as $index){
                $i = 0;
                foreach($_POST[$index] as $value){
                    if($i==0){
                    $additional = $additional.$value;
                    }else{
                           $additional = $additional.' '.$value;
                    }     
                    $i++;
                }
                $additional = $additional.$allIndexSeperator[$equ_counter];
                $equ_counter++;
            }
    
            //echo($additional);
    
            // Beidzas!
    
            if(empty($carType)) {
                //$error["carType"] = "Aizpildi cartype";
            }
            
            // Uz serveri!!!
            
            if(empty($error)) {
                $sql = "INSERT INTO 
                        products(userid, cartype, brand, model, year, millage, fueltype, color, price, enginecapacity, gearbox, info, date, photoid, registrationnumber, technicalinspection, newcar, additional)
                        VALUES(:userid, :carType, :brand, :model, :year, :millage, :fuelType, :color, :price, :engineCapacity, :gearBox, :info, :date, :photoId, :registrationNumber, :technicalInspection, :newcar, :additional)";

                $row = insertDataInToDataBaseDemo($sql, [
                    'userid' => $userId,
                    'carType'   => $carType,
                    'brand'   => $brand,
                    'model'   => $model,
                    'year'    => $year,
                    'millage' => $millage, 
                    'fuelType' => $fuelType,
                    'color' => $color,
                    'price' => $price,
                    'engineCapacity' => $engineCapacity,
                    'gearBox' => $gearBox,
                    'info' => $info,
                    'date' => $date,
                    'photoId' => $fileDestString,
                    'registrationNumber' => $registrationNumber,
                    'technicalInspection' => $technicalInspection,
                    'additional' => $additional,
                    'newcar' => $newcar,
                ]);

                $success = true;
            }
            
        }else {
            $error = 'Fill in all fields';
        }
    }

if ($success) {
                   
                    $P=[];
                    $Q = "SELECT id FROM products WHERE userid=:id AND date =:date";
                    $P['id'] = $_SESSION['uid'];
                    $P['date'] = $date;

                    $addedID = getDataFromDatabase($Q,$P);

                     //print_r($addedID);

                    $link = $SiteUrl."product.php?id=".$addedID['id'];
                    header('location:'.$link);


                }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/addcar.css">

		<script src="https://code.jquery.com/jquery-2.2.3.js" crossorigin="anonymous"></script>
		<link href="scripts/jquery.fileuploader.css" media="all" rel="stylesheet">
        <script src="scripts/jquery.fileuploader.min.js" type="text/javascript"></script>
        <script src="scripts/photo_upload.js" type="text/javascript"></script>

        <title>Add Products</title>

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

    </head>

    <body>
     <?php 
    include"assets/header.php"
     ?>
	 
		
        <div id="error">
           <?php
                if(isset($error) && !empty($error)) {   
                    
                        echo $error;
                    
                } elseif ($success) {
                    echo "Veiksmigi pievienots!";
                    $P=[];
                    $Q = "SELECT id FROM products WHERE userid=:id AND date =:date";
                    $P['id'] = $_SESSION['uid'];
                    $P['date'] = $date;

                    $addedID = getDataFromDatabase($Q,$P);

                   // print_r($addedID);

                    $link = $SiteUrl."product.php?id=".$addedID['id'];

                } else {
                    echo "Aizpildiet Formu:";
                    
                }
           ?>
        </div>
        <div class="container" align="center"> 
            <form method="POST" action="addcar.php?newcar=<?php echo isset($_GET['newcar']) && $_GET['newcar'] > 0 ? 1 : 0; ?>" enctype="multipart/form-data" >

            <label><?php echo $texts[$lang]['type'] ?></label>
            <div class="carType">
                <input type="hidden" name="carType" value=" ">
                <input type="checkbox" <?php if(isset($_POST['carType'])&&$_POST['carType']=='coupe'){echo'checked';} ?> id="coupe" name="carType" value="coupe"><label class="label2" for="coupe" id="label_coupe"><?php echo $texts[$lang]['coupe'] ?></label>
                <input type="checkbox" <?php if(isset($_POST['carType'])&&$_POST['carType']=='hatchback'){echo'checked';} ?> id="hatchback" name="carType" value="hatchback"><label class="label2" for="hatchback" id="label_hatchback"><?php echo $texts[$lang]['hatchback'] ?></label>
                <input type="checkbox" <?php if(isset($_POST['carType'])&&$_POST['carType']=='minivan'){echo'checked';} ?> id="minivan" name="carType" value="minivan"><label class="label2" for="minivan" id="label_minivan"><?php echo $texts[$lang]['minivan'] ?></label>
                <input type="checkbox" <?php if(isset($_POST['carType'])&&$_POST['carType']=='van'){echo'checked';} ?> id="van" name="carType" value="van"><label class="label2" for="van" id="label_van"><?php echo $texts[$lang]['van'] ?></label>
                <input type="checkbox" <?php if(isset($_POST['carType'])&&$_POST['carType']=='pickup'){echo'checked';} ?> id="pickup" name="carType" value="pickup"><label class="label2" for="pickup" id="label_pickup"><?php echo $texts[$lang]['pickup'] ?></label>
                <input type="checkbox" <?php if(isset($_POST['carType'])&&$_POST['carType']=='sedan'){echo'checked';} ?> id="sedan" name="carType" value="sedan"><label class="label2" for="sedan" id="label_sedan"><?php echo $texts[$lang]['sedan'] ?></label>
                <input type="checkbox" <?php if(isset($_POST['carType'])&&$_POST['carType']=='unversal'){echo'checked';} ?> id="unversal" name="carType" value="unversal"><label class="label2" for="unversal" id="label_unversal"><?php echo $texts[$lang]['unversal'] ?></label>
                <input type="checkbox" <?php if(isset($_POST['carType'])&&$_POST['carType']=='offroad'){echo'checked';} ?> id="offroad" name="carType" value="offroad"><label class="label2" for="offroad" id="label_offroad"><?php echo $texts[$lang]['offroad'] ?></label>
                <input type="checkbox" <?php if(isset($_POST['carType'])&&$_POST['carType']=='sport'){echo'checked';} ?> id="sport" name="carType" value="sport"><label class="label2" for="sport" id="label_sport"><?php echo $texts[$lang]['sport'] ?></label>
                <input type="checkbox" <?php if(isset($_POST['carType'])&&$_POST['carType']=='other'){echo'checked';} ?> id="other" name="carType" value="other"><label class="label2" for="other" id="label_other"><?php echo $texts[$lang]['other'] ?></label>
            </div>
<script type="text/javascript">
            // the selector will match all input controls of type :checkbox
// and attach a click event handler 
$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    if ($box.attr("name")=='carType') {
        $(group).prop("checked", false);
        $box.prop("checked", true);
    }
  } else {
    $box.prop("checked", false);
  }
});
</script>
			
			<table class="information_about">
			<tr>
				<td><span><?php echo $texts[$lang]['brands'] ?></span></td>
				<td>
					<select id="brand" onchange="launch_req()" name="brand">
                        <option value=""></option>
						<?php
						foreach ($cars as $brand) {
						echo "<option value='" . $brand . "'>" . $brand . "</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><span><?php echo $texts[$lang]['model'] ?></span></td>
				<td><select id="models_list" name="model"></select></td>
			</tr>
			<tr>
				<td><label><?php echo $texts[$lang]['year'] ?></label></td>
				<td><input type="text" name="year" value="<?php if (isset($_POST['year'])) { echo $_POST['year'];} ?>" maxlength="4" size="20"></td>
			</tr>
			<tr>
				<td><label><?php echo $texts[$lang]['millage'] ?></label></td>
				<td>
					<?php if(!isset($_GET['newcar']) || $_GET['newcar'] <= 0) { ?>
					<input type="text" value="<?php if (isset($_POST['millage'])) { echo $_POST['millage'];} ?>" name="millage">
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td><label><?php echo $texts[$lang]['fuel_type'] ?></label></td>
				<td>
					<select name="fuelType">
						<option <?php if (isset($_POST['fuelType'])&&$_POST['fuelType']=='') { echo 'selected';} ?> value="">-</option>
						<option <?php if (isset($_POST['fuelType'])&&$_POST['fuelType']==='petrol') { echo 'selected';} ?> value="petrol"><?php echo $texts[$lang]['petrol'] ?></option>
						<option <?php if (isset($_POST['fuelType'])&&$_POST['fuelType']==='diesel') { echo 'selected';} ?> value="diesel"><?php echo $texts[$lang]['diesel'] ?></option>
						<option <?php if (isset($_POST['fuelType'])&&$_POST['fuelType']==='gas') { echo 'selected';} ?> value="gas"><?php echo $texts[$lang]['gas'] ?></option>
						<option <?php if (isset($_POST['fuelType'])&&$_POST['fuelType']==='electricity') { echo 'selected';} ?> value="electricity"><?php echo $texts[$lang]['electric'] ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label><?php echo $texts[$lang]['color'] ?></label></td>
				<td>
				<select name="color">
					<option <?php if (isset($_POST['color'])&&$_POST['color']=='') { echo 'selected';} ?> value="">-</option>
					<option <?php if (isset($_POST['color'])&&$_POST['color']=='white') { echo 'selected';} ?> value="white"><?php echo $texts[$lang]['white'] ?></option>
					<option <?php if (isset($_POST['color'])&&$_POST['color']=='black') { echo 'selected';} ?> value="black"><?php echo $texts[$lang]['black'] ?></option>
					<option <?php if (isset($_POST['color'])&&$_POST['color']=='red') { echo 'selected';} ?> value="red"><?php echo $texts[$lang]['red'] ?></option>
					<option <?php if (isset($_POST['color'])&&$_POST['color']=='yellow') { echo 'selected';} ?> value="yellow"><?php echo $texts[$lang]['yellow'] ?></option>
					<option <?php if (isset($_POST['color'])&&$_POST['color']=='green') { echo 'selected';} ?> value="green"><?php echo $texts[$lang]['green'] ?></option>
					<option <?php if (isset($_POST['color'])&&$_POST['color']=='gray') { echo 'selected';} ?> value="gray"><?php echo $texts[$lang]['gray'] ?></option>
					<option <?php if (isset($_POST['color'])&&$_POST['color']=='blue') { echo 'selected';} ?> value="blue"><?php echo $texts[$lang]['blue'] ?></option>
				</select>
				</td>
			</tr>
			<tr>
				<td><label><?php echo $texts[$lang]['engine_capacity'] ?></label></td>
				<td><input type="number" name="engineCapacity" value="<?php if (isset($_POST['engineCapacity'])) { echo $_POST['engineCapacity'];} ?>" pattern="[0-9]+([\.,][0-9]+)?" step="0.1"></input></td>
			</tr>
			<tr>
				<td><label><?php echo $texts[$lang]['transmission'] ?></label></td>
				<td>
				<select name="gearBox">
					<option <?php if (isset($_POST['gearBox'])&&$_POST['gearBox']=='') { echo "selected";}?> value="">-</option>
					<option <?php if (isset($_POST['gearBox'])&&$_POST['gearBox']=='manual') { echo "selected";}?> value="manual"><?php echo $texts[$lang]['manual'] ?></option>
					<option <?php if (isset($_POST['gearBox'])&&$_POST['gearBox']=='automatic') { echo "selected";}?> value="automatic"><?php echo $texts[$lang]['automatic'] ?></option>
					<option <?php if (isset($_POST['gearbox'])&&$_POST['gearbox']=='semi_automatic_and_dual_clutch') { echo "selected";}?> value="semi_automatic_and_dual_clutch"><?php echo $texts[$lang]['semi'] ?></option>
				</select>
				</td>
			</tr>
			<tr>
				<td><label><?php echo $texts[$lang]['RegNum'] ?></label></td>
				<td><input type="text" name="registrationNumber" value="<?php if (isset($_POST['registrationNumber'])) { echo $_POST['registrationNumber'];} ?>"></td>
			</tr>
			<tr>
				<td><label><?php echo $texts[$lang]['TechnicalInsp'] ?></label></td>
				<td><input type="date" name="technicalInspection" value="<?php if (isset($_POST['technicalInspection'])) { echo $_POST['technicalInspection'];} ?>"></td>
			</tr>
			<tr>
				<td style="vertical-align:top;"><label><?php echo $texts[$lang]['info'] ?></label></td>
				<td><textarea name="info" placeholder=""  style="width: 168px; height: 100px"><?php if (isset($_POST['info'])) { echo $_POST['info'];} ?></textarea></td>
			</tr>
			<tr>
				<td><label><?php echo $texts[$lang]['price'] ?></label></td>
				<td><input type="text" name="price"  value="<?php if (isset($_POST['price'])) { echo $_POST['price'];} ?>"></td>
			</tr>
			</table>

                <div class="additional_checkbox_inline">
				
                   	<table class="table" align="center">
						<tr>
						<th>
							<h3><?php echo $texts[$lang]['eq'] ?></h3>
							<input type="checkbox" name="equipment[]" <?php if(isset($_POST['equipment'])&&in_array('hydraulic_steerimg_booster', $_POST['equipment'])){echo'checked';} ?> value="hydraulic_steerimg_booster"><label><?php echo $texts[$lang]['hyd'] ?><br>
                            <input type="checkbox" name="equipment[]" <?php if(isset($_POST['equipment'])&&in_array('electronic_steerimg_booster', $_POST['equipment'])){echo'checked';} ?> value="electronic_steerimg_booster"><label><?php echo $texts[$lang]['elBooster'] ?><br>
                            <input type="checkbox" name="equipment[]" <?php if(isset($_POST['equipment'])&&in_array('conditioner', $_POST['equipment'])){echo'checked';} ?> value="conditioner"><label><?php echo $texts[$lang]['condit'] ?><br>
                            <input type="checkbox" name="equipment[]" <?php if(isset($_POST['equipment'])&&in_array('climat_control', $_POST['equipment'])){echo'checked';} ?> value="climat_control"><label><?php echo $texts[$lang]['clicontr'] ?><br>
                            <input type="checkbox" name="equipment[]" <?php if(isset($_POST['equipment'])&&in_array('salon_air_filter', $_POST['equipment'])){echo'checked';} ?> value="salon_air_filter"><label><?php echo $texts[$lang]['salonFilt'] ?><br>
                            <input type="checkbox" name="equipment[]" <?php if(isset($_POST['equipment'])&&in_array('onboard_computer', $_POST['equipment'])){echo'checked';} ?> value="onboard_computer"><?php echo $texts[$lang]['onboardCom'] ?><br>
                            <input type="checkbox" name="equipment[]" <?php if(isset($_POST['equipment'])&&in_array('tire_presure_control', $_POST['equipment'])){echo'checked';} ?> value="tire_presure_control"><?php echo $texts[$lang]['tirePre'] ?><br>
                            <input type="checkbox" name="equipment[]" <?php if(isset($_POST['equipment'])&&in_array('parking_sensors', $_POST['equipment'])){echo'checked';} ?> value="parking_sensors"><?php echo $texts[$lang]['parkSensor'] ?><br>
                            <input type="checkbox" name="equipment[]" <?php if(isset($_POST['equipment'])&&in_array('rear_view_camera', $_POST['equipment'])){echo'checked';} ?> value="rear_view_camera"><?php echo $texts[$lang]['rearViewCam'] ?><br>
                            <input type="hidden" name="equipment[]" value=" ">
						</th>
						<th>
							<h3><?php echo $texts[$lang]['interior'] ?></h3>
                            <input type="checkbox" name="interior[]" <?php if(isset($_POST['interior'])&&in_array('hand_stand', $_POST['interior'])){echo "checked";} ?> value="hand_stand"><?php echo $texts[$lang]['handstand'] ?><br>
                            <input type="checkbox" name="interior[]" <?php if(isset($_POST['interior'])&&in_array('tinted_windows', $_POST['interior'])){echo "checked";} ?> value="tinted_windows"><?php echo $texts[$lang]['tindWin'] ?><br>
                            <input type="checkbox" name="interior[]" <?php if(isset($_POST['interior'])&&in_array('refrigerator', $_POST['interior'])){echo "checked";} ?> value="refrigerator"><?php echo $texts[$lang]['ref'] ?><br>
                            <input type="hidden" name="interior[]" value=" ">

							<h3><?php echo $texts[$lang]['SW'] ?></h3>
                            <input type="hidden" name="steering[]" value=" ">
							<input type="checkbox" name="steering[]" <?php if(isset($_POST['steering'])&&in_array('addaptable_steering', $_POST['steering'])){echo "checked";} ?> value="addaptable_steering"><?php echo $texts[$lang]['addsteer'] ?><br>
                            <input type="checkbox" name="steering[]" <?php if(isset($_POST['steering'])&&in_array('electronicly_addaptable_steeringwheel', $_POST['steering'])){echo "checked";} ?> value="electronicly_addaptable_steeringwheel"><?php echo $texts[$lang]['eladd'] ?><br>
                            <input type="checkbox" name="steering[]" <?php if(isset($_POST['steering'])&&in_array('multi_functional', $_POST['steering'])){echo "checked";} ?> value="multi_functional"><?php echo $texts[$lang]['multifuncwheel'] ?><br>
                            <input type="checkbox" name="steering[]" <?php if(isset($_POST['steering'])&&in_array('sport', $_POST['steering'])){echo "checked";} ?> value="sport"><?php echo $texts[$lang]['sportsteer'] ?><br>
                            <input type="checkbox" name="steering[]" <?php if(isset($_POST['steering'])&&in_array('heated_steeringwheel', $_POST['steering'])){echo "checked";} ?> value="heated_steeringwheel"><?php echo $texts[$lang]['heatedwheel'] ?><br>
							
                            <h3><?php echo $texts[$lang]['seats'] ?></h3>
                            <input type="hidden" name="seats[]" value=" ">
							<input type="checkbox" name="seats[]" <?php if(isset($_POST['seats'])&&in_array('electronicly_addaptable_seats', $_POST['seats'])){echo "checked";} ?> value="electronicly_addaptable_seats"><?php echo $texts[$lang]['eladdseats'] ?><br>
                            <input type="checkbox" name="seats[]" <?php if(isset($_POST['seats'])&&in_array('heated', $_POST['seats'])){echo "checked";} ?> value="heated"><?php echo $texts[$lang]['heatedSeats'] ?><br>
                            <input type="checkbox" name="seats[]" <?php if(isset($_POST['seats'])&&in_array('sport', $_POST['seats'])){echo "checked";} ?> value="sport"><?php echo $texts[$lang]['sportSeats'] ?><br>
                            <input type="checkbox" name="seats[]" <?php if(isset($_POST['seats'])&&in_array('recaro', $_POST['seats'])){echo "checked";} ?> value="recaro"><?php echo $texts[$lang]['rec'] ?><br>
                            <input type="checkbox" name="seats[]" <?php if(isset($_POST['seats'])&&in_array('ventable', $_POST['seats'])){echo "checked";} ?> value="ventable"><?php echo $texts[$lang]['ventSeats'] ?><br>
                            <input type="checkbox" name="seats[]" <?php if(isset($_POST['seats'])&&in_array('massage', $_POST['seats'])){echo "checked";} ?> value="massage"><?php echo $texts[$lang]['massageSeats'] ?><br>
						</th>
						<th>
							<h3><?php echo $texts[$lang]['lights'] ?></h3>
                            <input type="hidden" name="lights[]" value=" ">
							<input type="checkbox" name="lights[]" <?php if(isset($_POST['lights'])&&in_array('xenon',$_POST['lights'])){echo 'checked';} ?> value="xenon"><?php echo $texts[$lang]['xenon'] ?><br>
                            <input type="checkbox" name="lights[]" <?php if(isset($_POST['lights'])&&in_array('bi_xenon',$_POST['lights'])){echo 'checked';} ?> value="bi_xenon"><?php echo $texts[$lang]['bixen'] ?><br>
                            <input type="checkbox" name="lights[]" <?php if(isset($_POST['lights'])&&in_array('led',$_POST['lights'])){echo 'checked';} ?> value="led"><?php echo $texts[$lang]['led'] ?><br>
                            <input type="checkbox" name="lights[]" <?php if(isset($_POST['lights'])&&in_array('led_braking_lights',$_POST['lights'])){echo 'checked';} ?> value="led_braking_lights"><?php echo $texts[$lang]['ledbrakled'] ?><br>
                            <input type="checkbox" name="lights[]" <?php if(isset($_POST['lights'])&&in_array('fog_lights',$_POST['lights'])){echo 'checked';} ?> value="fog_lights"><?php echo $texts[$lang]['foglight'] ?><br>
                            <input type="checkbox" name="lights[]" <?php if(isset($_POST['lights'])&&in_array('light_cleaners',$_POST['lights'])){echo 'checked';} ?> value="light_cleaners"><?php echo $texts[$lang]['lCleaner'] ?><br>
							
                            <h3><?php echo $texts[$lang]['mirrors'] ?></h3>
                            <input type="hidden" name="mirrors[]" value=" ">
							<input type="checkbox" name="mirrors[]" <?php if(isset($_POST['mirrors'])&&in_array('electronicly_addaptable_mirrors',$_POST['mirrors'])){echo 'checked';} ?> value="electronicly_addaptable_mirrors"><?php echo $texts[$lang]['eladdmir'] ?><br>
                            <input type="checkbox" name="mirrors[]" <?php if(isset($_POST['mirrors'])&&in_array('heated_mirors',$_POST['mirrors'])){echo 'checked';} ?> value="heated_mirors"><?php echo $texts[$lang]['heatedMir'] ?><br>
                            <input type="checkbox" name="mirrors[]" <?php if(isset($_POST['mirrors'])&&in_array('sport',$_POST['mirrors'])){echo 'checked';} ?> value="sport"><?php echo $texts[$lang]['sportaMir'] ?><br>
                            <input type="checkbox" name="mirrors[]" <?php if(isset($_POST['mirrors'])&&in_array('automatic_bend',$_POST['mirrors'])){echo 'checked';} ?> value="automatic_bend"><?php echo $texts[$lang]['autoBend'] ?><br>
						</th>
						<th>
							<h3><?php echo $texts[$lang]['safety'] ?></h3>
                            <input type="hidden" name="safety[]" value=" ">
							<input type="checkbox" name="safety[]" <?php if(isset($_POST['safety'])&&in_array('abs',$_POST['safety'])){echo 'checked';} ?> value="abs"><?php echo $texts[$lang]['abs'] ?><br>
                            <input type="checkbox" name="safety[]" <?php if(isset($_POST['safety'])&&in_array('central_key',$_POST['safety'])){echo 'checked';} ?> value="central_key"><?php echo $texts[$lang]['ckey'] ?><br>
                            <input type="checkbox" name="safety[]" <?php if(isset($_POST['safety'])&&in_array('alarm',$_POST['safety'])){echo 'checked';} ?> value="alarm"><?php echo $texts[$lang]['alrm'] ?><br>
                            <input type="checkbox" name="safety[]" <?php if(isset($_POST['safety'])&&in_array('imobilazer',$_POST['safety'])){echo 'checked';} ?> value="imobilazer"><?php echo $texts[$lang]['imob'] ?><br>
                            <input type="checkbox" name="safety[]" <?php if(isset($_POST['safety'])&&in_array('air_bag',$_POST['safety'])){echo 'checked';} ?> value="air_bag"><?php echo $texts[$lang]['airB'] ?><br>
                            <input type="checkbox" name="safety[]" <?php if(isset($_POST['safety'])&&in_array('esp',$_POST['safety'])){echo 'checked';} ?> value="esp"><?php echo $texts[$lang]['esp'] ?><br>
                            <input type="checkbox" name="safety[]" <?php if(isset($_POST['safety'])&&in_array('asr',$_POST['safety'])){echo 'checked';} ?> value="asr"><?php echo $texts[$lang]['asr'] ?><br>
                            <input type="checkbox" name="safety[]" <?php if(isset($_POST['safety'])&&in_array('marking',$_POST['safety'])){echo 'checked';} ?> value="marking"><?php echo $texts[$lang]['marking'] ?><br>
							
                            <h3><?php echo $texts[$lang]['HIFI'] ?></h3>
                            <input type="hidden" name="audiosystem[]" value=" ">
							<input type="checkbox" name="audiosystem[]" <?php if(isset($_POST['audiosystem'])&&in_array('fm_am',$_POST['audiosystem'])){echo 'checked';} ?> value="fm_am"><?php echo $texts[$lang]['fm/am'] ?><br>
                            <input type="checkbox" name="audiosystem[]" <?php if(isset($_POST['audiosystem'])&&in_array('cd',$_POST['audiosystem'])){echo 'checked';} ?> value="cd"><?php echo $texts[$lang]['cd'] ?><br>
                            <input type="checkbox" name="audiosystem[]" <?php if(isset($_POST['audiosystem'])&&in_array('dvd',$_POST['audiosystem'])){echo 'checked';} ?> value="dvd"><?php echo $texts[$lang]['dvd'] ?><br>
                            <input type="checkbox" name="audiosystem[]" <?php if(isset($_POST['audiosystem'])&&in_array('mp3',$_POST['audiosystem'])){echo 'checked';} ?> value="mp3"><?php echo $texts[$lang]['mp3'] ?><br>
                            <input type="checkbox" name="audiosystem[]" <?php if(isset($_POST['audiosystem'])&&in_array('gps',$_POST['audiosystem'])){echo 'checked';} ?> value="gps"><?php echo $texts[$lang]['gps'] ?><br>
                            <input type="checkbox" name="audiosystem[]" <?php if(isset($_POST['audiosystem'])&&in_array('bluetooth',$_POST['audiosystem'])){echo 'checked';} ?> value="bluetooth"><?php echo $texts[$lang]['bluet'] ?><br>
                            <input type="checkbox" name="audiosystem[]" <?php if(isset($_POST['audiosystem'])&&in_array('hands_free',$_POST['audiosystem'])){echo 'checked';} ?> value="hands_free"><?php echo $texts[$lang]['handfree'] ?><br>
                            <input type="checkbox" name="audiosystem[]" <?php if(isset($_POST['audiosystem'])&&in_array('subwoofer',$_POST['audiosystem'])){echo 'checked';} ?> value="subwoofer"><?php echo $texts[$lang]['sub'] ?><br>
                            <input type="checkbox" name="audiosystem[]" <?php if(isset($_POST['audiosystem'])&&in_array('lcd',$_POST['audiosystem'])){echo 'checked';} ?> value="lcd"><?php echo $texts[$lang]['lcd'] ?><br>
                            <input type="checkbox" name="audiosystem[]" <?php if(isset($_POST['audiosystem'])&&in_array('tv',$_POST['audiosystem'])){echo 'checked';} ?> value="tv"><?php echo $texts[$lang]['tv'] ?><br>
						</th>
						</tr>
					</table>
                </div>

                <!--Forma priekš bildes augšuplādes-->
                <!--<div class="img_inline_down">
                    <input type="file" name="file[]">
                    <input type="file" name="file[]">
                    <input type="file" name="file[]">
                    <input type="file" name="file[]">
                    <input type="file" name="file[]">
                    <input type="file" name="file[]">
                    <input type="file" name="file[]">
                    <input type="file" name="file[]">
                    <input type="file" name="file[]">
                </div>-->
                <!--beidzas!-->
                <br>
                <!--<input name="submit" type="submit" value="Submit">-->
				<!--<div class="submit_button"><button name="submit" type="submit">Submit</button></div>-->
				<div class="upload_photo">
                   
                        <input type="file" name="file[]">
                    
                </div>
				<div class="submit_button"><button name="submit" type="submit">Submit</button></div>	
            </form>

		<style>
			.upload_photo {
                font-size: 14px;
                line-height: normal;
                color: #47525d;
                background-color: #fff;
                margin: 0;
                width: 560px;
            }
            .fileuploader-theme-thumbnails .fileuploader-thumbnails-input,
            .fileuploader-theme-thumbnails .fileuploader-items-list li.fileuploader-item {
                display: inline-block;
                width: 30%;
                height: 115px;
                line-height: 110px;
                padding: 5px;
                vertical-align: top;
            }
            .fileuploader-theme-thumbnails .fileuploader-thumbnails-input-inner {
                font-family: 'Montserrat', sans-serif;
                background-color: #dadada;
                text-align: center;
                font-weight: 600;
                color: white;
                vertical-align: top;
                cursor: pointer;
                -webkit-user-select: none;
                   -moz-user-select: none;
                    -ms-user-select: none;
                        user-select: none;
                -webkit-transition: all 0.1s ease;
                        transition: all 0.1s ease;
            }
            .fileuploader-theme-thumbnails .fileuploader-item-inner,
            .fileuploader-theme-thumbnails .fileuploader-item-inner .thumbnail-holder,
            .fileuploader-theme-thumbnails .fileuploader-items-list .fileuploader-item-image {
                width: 100%;
                height: 100%;
            }
            .fileuploader-theme-thumbnails .fileuploader-items-list .fileuploader-item-image {
                position: relative;
                text-align: center;
                overflow: hidden;
            }
            .fileuploader-theme-thumbnails .fileuploader-items-list .fileuploader-item-image img {
                max-height: 100%;
                min-height: 100%;
                max-width: none;
            }
		</style>
            <?php include"assets/footer.php" ?>
        </div>
    </body>
</html>