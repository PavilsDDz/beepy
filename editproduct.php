<?php


    include ('assets/connect.php');
	include 'assets/setup.php';

    if(isset($_SESSION['uid'])){
        $productQuery = "SELECT * FROM products WHERE id = :id";
        $productPayload["id"] = $_GET['id'];
        $productResult = getAllDataFromDatabase($productQuery, $productPayload);

        //print_r($productResult);
        //echo "<br><br><br>";
        $productRow =   $productResult[0];
    }

       // print_r($_POST);


    if (isset($_POST['files_stay'])) {
        $fileDestString = $_POST['files_stay'];
    }else{
        $fileDestString ='';
    }


    if(isset($_POST['btn-update'])){

       // echo "<br><br><br>";
       // echo "<br><br><br>";
       // print_r($_FILES);

        for ($i=0; $i < count($_FILES['img']['name']); $i  ++) { 

                $fileName = $_FILES['img']['name'][$i];
                $fileTmpName = $_FILES['img']['tmp_name'][$i];
                $fileSize = $_FILES['img']['size'][$i];
                $fileError = $_FILES['img']['error'][$i];
                $fileType = $_FILES['img']['type'][$i];
                $fileExt = explode('.', $fileName);
                $fileActualyExt = strtolower(end($fileExt));

                $allowed = array('jpg', 'jpeg', 'png', 'pdf');

                    if ($fileTmpName != "") {
                        $fileNameNew = date('YmdHis'). $_SESSION['uid'].$i.'.'.$fileActualyExt;

                        $fileDestination = 'uploads/'.$fileNameNew;
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $fileDestString = $fileDestString.$fileDestination.";";
                       // echo "<br><br>".$fileDestString."<br><br>";


                    }
                }
            }
        if(isset($_POST['files_del'])){
            $files_to_del = explode(';', $_POST['files_del']);
            foreach ($files_to_del as $file_del) {
             //   echo '<br>'.$file_del;
                unlink($file_del);
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

        //echo "<br><br><br><br>".$additional."<br><br><br>";


        $payload["id"] = $_GET['id'];
        $payload["cartype"] = $_POST['carType'];
       
        $payload["model"] = $_POST['model'];
        $payload["year"] = $_POST['year'];
        $payload["millage"] = $_POST['millage'];
        $payload["fueltype"] = $_POST['fuelType'];
        $payload["color"] = $_POST['color'];
        $payload["price"] = $_POST['price'];
        $payload["enginecapacity"] = $_POST['engineCapacity'];
        $payload["gearbox"] = $_POST['gearBox'];
        $payload["info"] = $_POST['info'];
        $payload["registrationnumber"] = $_POST['registrationnumber'];
        $payload["technicalinspection"] = $_POST['technicalinspection'];
        $payload["additional"] = $additional;
        $payload["photoid"] = $fileDestString;
        

        $update = "UPDATE products SET cartype = :cartype, model = :model, year = :year, millage = :millage,
        fueltype = :fueltype, color = :color, price = :price, enginecapacity = :enginecapacity, gearbox = :gearbox,
        info = :info, registrationnumber = :registrationnumber, technicalinspection = :technicalinspection, additional = :additional, photoid =:photoid WHERE id = :id";

        //echo insertDataInToDataBase($update, $payload);

        if(insertDataInToDataBase($update, $payload)){
          header("location: product.php?id=".$_GET['id']);
        }
    }


?>

<!doctype html>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <?php include 'assets/head.php' ?>
        <script>console.log('GOing')
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
                            // alert('GOing')

                        }
                    }
                    xmlhttp.open("GET", "assets/caroption+.php?for=sell&brand=" + str, true);
                    xmlhttp.send();
                }
            }
            var launch_req = function () {

               // var brand_select = document.getElementById("brand");
                var brand = <?php echo '"'.$productResult[0]["brand"].'"'?>

                showHint(brand)
            }

            launch_req() 
        </script>
		<style>
h1{
	color: #00c6ff;
    font-size: 2.5vw;
    text-align: center;
    margin-bottom: 20px;
    margin-top: 140px;
}
file_input input{
	background-color: #fff;
    cursor: pointer;
    color: #00c6ff;
    border: solid 1px #00c6ff;
    font-size: 25px;
    padding: 6px 20px;
}

label, .car_info span{
	font-family: 'Montserrat', sans-serif;
    color: #00c6ff;
    font-size: 18px;
    line-height: 1.8vw;
    font-weight: 500;
    text-align: center;
}
input, textarea, select, button {
    text-rendering: auto;
    color: initial;
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    display: inline-block;
    text-align: start;
    margin: 0em;
    font: 13.3333px Arial;
}
select, .car_info input{
	width: 172px;
}

.car_info{
	width: 20%;
	margin-bottom: 2vw;
	margin-top: 2vw;
}
#additional_checkbox{
	display: flex;
    justify-content: center;
    text-align: left;
	
	font-family: 'Montserrat', sans-serif;
    color: #00c6ff;
    font-size: 14px;
    line-height: 1.3vw;
    font-weight: 500;
	margin-bottom: 2vw;
}
#additional_checkbox label{
	font-family: 'Montserrat', sans-serif;
    color: #00c6ff;
    font-size: 20px;
	line-height: 1.3vw;
    font-weight: 600;
    text-align: left;
	text-transform: uppercase;
}
.additional_checkbox{
	width: 13%;
}



#btn-update, .btn-update{
	background-color: #00c6ff;
    color: rgba(255,255,255,1);
    border: none;
    font-size: 18px;
    height: 40px;
    width: 120px;
    padding: 10px 30px;
    border-radius: 20px;
    font-weight: 500;
    line-height: 0.5vw;
    font-family: 'Montserrat', sans-serif;
    opacity: 0.8;
    min-width: 70px;
    min-height: 20px;
}
.bottom_borders{
	margin-bottom:3vw;
}

select{
    width: 172px;
    border: 1px solid #00c6ff;
    width: 200px;
    height: 25px;
    color: #00c6ff;
    font-family: 'Montserrat', sans-serif;
}
input[type="text" i],input[type="number" i] {
    width: 172px;
    border: 1px solid #00c6ff;
    width: 200px;
    height: 25px;
    color: #00c6ff;
    font-family: 'Montserrat', sans-serif;
}
input[type="date" i]{
    width: 172px;
    border: 1px solid #00c6ff;
    width: 200px;
    height: 25px;
    color: #00c6ff;
    font-family: 'Montserrat', sans-serif;
}
.input_capacity{
    width: 172px;
    border: 1px solid #00c6ff;
    width: 200px;
    height: 50px;
    color: #00c6ff;
    font-family: 'Montserrat', sans-serif;
}
textarea{
    width: 210px;
    border: 1px solid #00c6ff;
    height: 150px;
    color: #00c6ff;
    font-family: 'Montserrat', sans-serif;
}
form select, form input {
    border-radius: 20px;
    padding: 0 7px;
}
form select {
    box-sizing: content-box;
}
form select:focus, form input:focus {
    outline: none;
}

		</style>
    </head>

    <body>
	<?php include"assets/header.php" ?>
	<div align="center" style="margin-top: 6vw;">
        <form method="POST" action="editproduct.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
            <h1>EDIT</h1>
            
            <?php include "assets/img_upload.php" ?>
                    
<table class="car_info">
<tr>
	<td><label>Car Type:</label></td>
    <td>
	<?php $cartype = array("-", "convertible", "coupe", "hatchback", "minivan", "van", "pickup", "offroad", "sedan", "unversal", "sport", "other");?>
            <select name="carType" placeholder="cartype" ?>">
                <?php foreach($cartype as $onecartype){
                    if($onecartype == $productRow['cartype'] ){ ?>
                        <option value="<?php echo $onecartype; ?>" selected><?php echo $onecartype;?></option>
                        <?php
                    }else{ ?>
                        <option value="<?php echo $onecartype; ?>"><?php echo $onecartype;?></option>
                        <?php
                    }
                } ?></select>
	</td>
</tr>
<tr>
    <td><span>Model:</span></td>
    <td>
	<select id="models_list" name="model"><option value="<?php echo $productRow['model']; ?>" selected><?php echo $productRow['model']; ?></option></select>
	<?php
         // print_r($productRow['model']);
    ?>
	</td>
</tr>
<tr>
    <td><label>Year:</label></td>
    <td><input type="text" name="year" maxlength="4" size="4" placeholder="year" value="<?php echo $productRow['year']; ?>"></td>
</tr>
<tr>
    <td><label>Millage:</label></td>
    <td><input type="text" name="millage" placeholder="millage" value="<?php echo $productRow['millage']; ?>"></td>
</tr>
<tr>
    <td><label>Fuel Type:</label></td>
    <td>
	<?php $fueltype = array("-", "petrol", "diesel", "gas", "electricity");?>
            <select name="fuelType" placeholder="fueltype" value="<?php echo $productRow['fueltype']; ?>">
                <?php foreach($fueltype as $onefueltype){
                    if($onefueltype === $productRow['fueltype'] ){ ?>
                        <option value="<?php echo $onefueltype; ?>" selected><?php echo $onefueltype;?></option>
                        <?php
                    }else{ ?>
                        <option value="<?php echo $onefueltype; ?>"><?php echo $onefueltype;?></option>
                        <?php
                    }
                } ?>
         
    </select>
	</td>
</tr>
<tr>
    <td><label>Color:</label></td>
    <td>
	<?php $color = array("-", "white", "black", "red", "yellow", "green", "gray", "blue", "another", "other");?>
            <select name="color" placeholder="color" value="<?php echo $productRow['color']; ?>">
                <?php foreach($color as $onecolor){
                    if($onecolor === $productRow['color'] ){ ?>
                        <option value="<?php echo $onecolor; ?>" selected><?php echo $onecolor;?></option>
                        <?php
                    }else{ ?>
                        <option value="<?php echo $onecolor; ?>"><?php echo $onecolor;?></option>
                        <?php 
                    }
                } ?>
    </select>
	</td>
</tr>
<tr>
    <td><label>Price:</label></td>
    <td><input type="text" name="price" placeholder="price" value="<?php echo $productRow['price']; ?>"></td>
</tr>
<tr>
    <td><label>Engine Capacity:</label></td>
    <td><input type="number" name="engineCapacity"  pattern="[0-9]+([\.,][0-9]+)?" step="0.1" placeholder="enginecapacity" value="<?php echo $productRow['enginecapacity']; ?>"></input></td>
</tr>
<tr>
    <td><label>Transmission:</label></td>
    <td>
	<?php $transmission = array("-", "manual", "automatic", "semi_automatic_and_dual_clutch");?>
            <select name="gearBox" placeholder="gearbox">
                    <option value="manual" <?php if($productRow['gearbox']=='manual'){echo 'selected';} ?>>manual</option>
                    <option value="automatic" <?php if($productRow['gearbox']=='automatic'){echo 'selected';} ?>>automatic</option>
                    <option value="semi_automatic_and_dual_clutch" <?php if($productRow['gearbox']=='semi_automatic_and_dual_clutch'){echo 'selected';} ?>>semi_automatic_and_dual_clutch</option>
                    
    </select>
	</td>
</tr>
<tr>
    <td><label>Info:</label></td>
    <td><textarea name="info"><?php echo $productRow['info']; ?></textarea></td>
</tr>
<tr>
    <td><label>Registration Number:</label></td>
    <td><input type="text" name="registrationnumber" placeholder="registrationnumber" value="<?php echo $productRow['registrationnumber']; ?>"></td>
</tr>
<tr>
    <td><label>Tehnical Inspection:</label></td>
    <td><input type="text" name="technicalinspection" placeholder="technicalinspection" value="<?php echo $productRow['technicalinspection']; ?>"></td>
</tr>
<tr>
    <td><label>Additional:</label></td>
	<td><input type="text" name="additional" placeholder="additional" value="<?php echo $productRow['additional']; ?> "selected></td>
</tr>
</table>

            <div class="additional_checkbox_inline">

                <?php 
                    $extrindex = ['Equipment', 'Lights', 'Interior', 'Safety', 'Steering', 'Mirrors', 'Audiosystem', 'Seats'];

                    $str = $productResult[0]["additional"];
                    $extrindexarray = [];

                    foreach($extrindex as $index){

                        $addionalindex = explode($index, $str);
                        $extrindexarray[$index] = explode(' ',$addionalindex[0]);

                        if(isset($addionalindex[1])){

                            $str = $addionalindex[1];

                        }else{

                            $str = $addionalindex[0];
                        }
                    // print_r($addionalindex);
                    // echo "<br>";
                    }
                    // print_r($extrindexarray);
                    // echo "<br>";
                ?> 
            <div id="additional_checkbox">    
				<div class="additional_checkbox">
                    <label>Equipment</label><br>
                        <input type="hidden" name="equipment[]" value=" ">
                        <input type="checkbox" name="equipment[]" value="hydraulic_steerimg_booster" <?php if(in_array('hydraulic_steerimg_booster', $extrindexarray['Equipment'])){echo "checked";} ?>> hydrplic booster<br>
                        <input type="checkbox" name="equipment[]" value="electronic_steerimg_booster"<?php if(in_array('electronic_steerimg_booster', $extrindexarray['Equipment'])){echo "checked";} ?>> electronic booster<br>
                        <input type="checkbox" name="equipment[]" value="conditioner"<?php if(in_array('conditioner', $extrindexarray['Equipment'])){echo "checked";} ?>>conditioner<br>
                        <input type="checkbox" name="equipment[]" value="climat_control"<?php if(in_array('climat_control', $extrindexarray['Equipment'])){echo "checked";} ?>>climat control<br>
                        <input type="checkbox" name="equipment[]" value="salon_air_filter"<?php if(in_array('salon_air_filter', $extrindexarray['Equipment'])){echo "checked";} ?>>salon ari filter<br>
                        <input type="checkbox" name="equipment[]" value="onboard_computer"<?php if(in_array('onboard_computer', $extrindexarray['Equipment'])){echo "checked";} ?>>onboard computre<br>
                        <input type="checkbox" name="equipment[]" value="tire_presure_control"<?php if(in_array('tire_presure_control', $extrindexarray['Equipment'])){echo "checked";} ?>>tire presure control<br>
                        <input type="checkbox" name="equipment[]" value="parking_sensors"<?php if(in_array('parking_sensors', $extrindexarray['Equipment'])){echo "checked";} ?>>parking sensor<br>
                        <input type="checkbox" name="equipment[]" value="rear_view_camera"<?php if(in_array('rear_view_camera', $extrindexarray['Equipment'])){echo "checked";} ?>>rear view camera<br>

                    <label>Lights</label><br>
                        <input type="hidden" name="lights[]" value=" ">

                        <input type="checkbox" name="lights[]" value="xenon"<?php if(in_array('xenon', $extrindexarray['Lights'])){echo "checked";} ?>>xenon<br>
                        <input type="checkbox" name="lights[]" value="bi_xenon"<?php if(in_array('bi_xenon', $extrindexarray['Lights'])){echo "checked";} ?>>bi xenon<br>
                        <input type="checkbox" name="lights[]" value="led"<?php if(in_array('led', $extrindexarray['Lights'])){echo "checked";} ?>>led<br>
                        <input type="checkbox" name="lights[]" value="led_braking_lights"<?php if(in_array('led_braking_lights', $extrindexarray['Lights'])){echo "checked";} ?>>led braking lights<br>
                        <input type="checkbox" name="lights[]" value="fog_lights"<?php if(in_array('fog_lights', $extrindexarray['Lights'])){echo "checked";} ?>>fog lights<br>
                        <input type="checkbox" name="lights[]" value="light_cleaners"<?php if(in_array('light_cleaners', $extrindexarray['Lights'])){echo "checked";} ?>>light cleaners<br>
				</div>

                <div class="additional_checkbox">
                    <label>Interior</label><br>
                        <input type="hidden" name="interior[]" value=" ">

                        <input type="checkbox" name="interior[]" value="leather_interior"<?php if(in_array('light_cleaners', $extrindexarray['Interior'])){echo "checked";} ?>>leather interior<br>
                        <input type="checkbox" name="interior[]" value="hand_stand"<?php if(in_array('hand_stand', $extrindexarray['Interior'])){echo "checked";} ?>>hand stand<br>
                        <input type="checkbox" name="interior[]" value="tinted_windows"<?php if(in_array('tinted_windows', $extrindexarray['Interior'])){echo "checked";} ?>>tinted windows<br>
                        <input type="checkbox" name="interior[]" value="refrigerator"<?php if(in_array('refrigerator', $extrindexarray['Interior'])){echo "checked";} ?>>refrigerator<br>


                    <label>Safety</label><br>
                        <input type="hidden" name="safety[]" value=" ">

                        <input type="checkbox" name="safety[]" value="abs"<?php if(in_array('abs', $extrindexarray['Safety'])){echo "checked";} ?>>abs<br>
                        <input type="checkbox" name="safety[]" value="central_key"<?php if(in_array('central_key', $extrindexarray['Safety'])){echo "checked";} ?>>central key<br>
                        <input type="checkbox" name="safety[]" value="alarm"<?php if(in_array('alarm', $extrindexarray['Safety'])){echo "checked";} ?>>alarm<br>
                        <input type="checkbox" name="safety[]" value="imobilazer"<?php if(in_array('imobilazer', $extrindexarray['Safety'])){echo "checked";} ?>>imobilazer<br>
                        <input type="checkbox" name="safety[]" value="air_bag"<?php if(in_array('air_bag', $extrindexarray['Safety'])){echo "checked";} ?>>air bag<br>
                        <input type="checkbox" name="safety[]" value="esp"<?php if(in_array('esp', $extrindexarray['Safety'])){echo "checked";} ?>>esp<br>
                        <input type="checkbox" name="safety[]" value="asr"<?php if(in_array('asr', $extrindexarray['Safety'])){echo "checked";} ?>>asr<br>
                        <input type="checkbox" name="safety[]" value="marking"<?php if(in_array('marking', $extrindexarray['Safety'])){echo "checked";} ?>>marking<br>
                        
                </div>

                <div class="additional_checkbox">
                    <label>Steering</label><br>
                        <input type="hidden" name="steering[]" value=" ">

                        <input type="checkbox" name="steering[]" value="addaptable_steering"<?php if(in_array('addaptable_steering', $extrindexarray['Steering'])){echo "checked";} ?>>addaptable steering<br>
                        <input type="checkbox" name="steering[]" value="electronicly_addaptable_steeringwheel"<?php if(in_array('electronicly_addaptable_steeringwheel', $extrindexarray['Steering'])){echo "checked";} ?>>electronicly addaptable steeringwheel<br>
                        <input type="checkbox" name="steering[]" value="multi_functional"<?php if(in_array('multi_functional', $extrindexarray['Steering'])){echo "checked";} ?>>multi functional wheel<br>
                        <input type="checkbox" name="steering[]" value="sport"<?php if(in_array('sport', $extrindexarray['Steering'])){echo "checked";} ?>>sports steering wheel<br>
                        <input type="checkbox" name="steering[]" value="heated_steeringwheel"<?php if(in_array('heated_steeringwheel', $extrindexarray['Steering'])){echo "checked";} ?>>heated steering wheel<br>
                        
                    <label>Mirrors</label><br>
                        <input type="hidden" name="mirrors[]" value=" ">

                        <input type="checkbox" name="mirrors[]" value="electronicly_addaptable_mirrors"<?php if(in_array('electronicly_addaptable_mirrors', $extrindexarray['Mirrors'])){echo "checked";} ?>>electronicly addaptable mirrors<br>
                        <input type="checkbox" name="mirrors[]" value="heated_mirors"<?php if(in_array('heated_mirors', $extrindexarray['Mirrors'])){echo "checked";} ?>>heated mirorrs<br>
                        <input type="checkbox" name="mirrors[]" value="sport"<?php if(in_array('sport', $extrindexarray['Mirrors'])){echo "checked";} ?>>sports mirrors<br>
                        <input type="checkbox" name="mirrors[]" value="automatic_bend"<?php if(in_array('automatic_bend', $extrindexarray['Mirrors'])){echo "checked";} ?>>automatic bend<br>
                </div>

                <div class="additional_checkbox">

                    <label>Audio System</label><br>
                        <input type="hidden" name="audiosystem[]" value=" ">

                        <input type="checkbox" name="audiosystem[]" value="fm_am"<?php if(in_array('fm_am', $extrindexarray['Audiosystem'])){echo "checked";} ?>>fm / am<br>
                        <input type="checkbox" name="audiosystem[]" value="cd"<?php if(in_array('cd', $extrindexarray['Audiosystem'])){echo "checked";} ?>>cd<br>
                        <input type="checkbox" name="audiosystem[]" value="dvd"<?php if(in_array('dvd', $extrindexarray['Audiosystem'])){echo "checked";} ?>>dvd<br>
                        <input type="checkbox" name="audiosystem[]" value="mp3"<?php if(in_array('mp3', $extrindexarray['Audiosystem'])){echo "checked";} ?>>mp3<br>
                        <input type="checkbox" name="audiosystem[]" value="gps"<?php if(in_array('gps', $extrindexarray['Audiosystem'])){echo "checked";} ?>>gps<br>
                        <input type="checkbox" name="audiosystem[]" value="bluetooth"<?php if(in_array('bluetooth', $extrindexarray['Audiosystem'])){echo "checked";} ?>>bluetooth<br>
                        <input type="checkbox" name="audiosystem[]" value="hands_free"<?php if(in_array('hands_free', $extrindexarray['Audiosystem'])){echo "checked";} ?>>hands free<br>
                        <input type="checkbox" name="audiosystem[]" value="subwoofer"<?php if(in_array('subwoofer', $extrindexarray['Audiosystem'])){echo "checked";} ?>>subwoofer<br>
                        <input type="checkbox" name="audiosystem[]" value="lcd"<?php if(in_array('lcd', $extrindexarray['Audiosystem'])){echo "checked";} ?>>lcd<br>
                        <input type="checkbox" name="audiosystem[]" value="tv"<?php if(in_array('tv', $extrindexarray['Audiosystem'])){echo "checked";} ?>>tv<br>

                    <label>Seats</label><br>
                        <input type="hidden" name="seats[]" value=" ">

                        <input type="checkbox" name="seats[]" value="electronicly_addaptable_seats"<?php if(in_array('electronicly_addaptable_seats', $extrindexarray['Seats'])){echo "checked";} ?>>electonicly addaptable seats<br>
                        <input type="checkbox" name="seats[]" value="heated"<?php if(in_array('heated', $extrindexarray['Seats'])){echo "checked";} ?>>heated seats<br>
                        <input type="checkbox" name="seats[]" value="sport"<?php if(in_array('sport', $extrindexarray['Seats'])){echo "checked";} ?>>sport seats<br>
                        <input type="checkbox" name="seats[]" value="recaro"<?php if(in_array('recaro', $extrindexarray['Seats'])){echo "checked";} ?>>recaro<br>
                        <input type="checkbox" name="seats[]" value="ventable"<?php if(in_array('ventable', $extrindexarray['Seats'])){echo "checked";} ?>>ventable seats<br>
                        <input type="checkbox" name="seats[]" value="massage"<?php if(in_array('massage', $extrindexarray['Seats'])){echo "checked";} ?>>massage seats<br>
                </div>
            </div>
			<div class="bottom_borders">
            <input type="submit" name="btn-update" id="btn-update" onClick="update()"></input>
            <a href="product.php"><button class="btn-update" type="button" value="button">Cancel</button></a>
			</div>
        </form>
		 <?php include"assets/footer.php" ?>
		</div>
        </body>
    <!-- Alert for Updating -->
        <script>
            function update(){
                var x;

                if(confirm("Updated data Sucessfully") == true){
                    x = "update";
                }
            }
        </script>
        <script type="text/javascript" src='scripts/pic_uploader.js'></script>
        </html>