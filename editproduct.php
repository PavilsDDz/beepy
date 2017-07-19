<?php


    include ('assets/connect.php');

    if(isset($_SESSION['uid'])){
        $productQuery = "SELECT * FROM products WHERE id = :id";
        $productPayload["id"] = $_GET['id'];
        $productResult = getAllDataFromDatabase($productQuery, $productPayload);

        foreach($productResult as $productRow){

        }

    }

    $fileDestString ='';

    if(isset($_POST['btn-update'])){
        $extrindex = ['Equipment', 'Lights', 'Interior', 'Safety', 'Steering', 'Mirrors', 'Audiosystem', 'Seats'];

        foreach($extrindex as $index){
        }

        $extrindexarray = [];

        foreach($extrindexarray[$index] as $extrindexone){
            $i = 0;
            foreach($_POST[$extrindexone] as $value){

                if($i==0){
                    $additional = $additional.$value;
                }else{
                    $additional = $additional.' '.$value;
                }     
                $i++;

            }
            $additional = $additional.$addionalindex[0];
        }

        print_r($_POST);

        $payload["id"] = $_GET['id'];
        $payload["cartype"] = $_POST['cartype'];
        $payload["brand"] = $_POST['brand'];
        $payload["model"] = $_POST['model'];
        $payload["year"] = $_POST['year'];
        $payload["millage"] = $_POST['millage'];
        $payload["fueltype"] = $_POST['fueltype'];
        $payload["color"] = $_POST['color'];
        $payload["price"] = $_POST['price'];
        $payload["enginecapacity"] = $_POST['enginecapacity'];
        $payload["gearbox"] = $_POST['gearbox'];
        $payload["info"] = $_POST['info'];
        $payload["registrationnumber"] = $_POST['registrationnumber'];
        $payload["technicalinspection"] = $_POST['technicalinspection'];
        $payload["additional"] = $additional;
        $payload ["additional"]= $_POST[$extrindexone];

        $update = "UPDATE products SET cartype = :cartype, brand = :brand, model = :model, year = :year, millage = :millage,
        fueltype = :fueltype, color = :color, price = :price, enginecapacity = :enginecapacity, gearbox = :gearbox,
        info = :info, registrationnumber = :registrationnumber, technicalinspection = :technicalinspection, additional = :additional WHERE id = :id";

        insertDataInToDataBaseDemo($update, $payload);

        if(isset($productQuery)){
            header("location: editproduct.php?id=".$_GET['id']);
        }
    }


?>

<!doctype html>
<html>
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


    <body>
        <form method="POST" enctype="multipart/form-data">
            <h1>EDIT</h1>

                    <?php foreach ($productResult as $productRow){ ?>
                    <?php $imgLinks = explode(";", substr($productRow['photoid'], 0, -1)); ?>
					<?php } ?>

					<?php
                        foreach($imgLinks as $oneimg){
                            echo "<img src='".$oneimg."' height='50' width='50'>";

                        }
                    ?>
                    
            <label>Car Type:</label>
            <?php $cartype = array("-", "convertible", "coupe", "hatchback", "minivan", "van", "pickup", "offroad", "sedan", "unversal", "sport", "other");?>
            <select name="carType" placeholder="cartype" value="<?php echo $productRow['cartype']; ?>"><br/><br/>
                <?php foreach($cartype as $onecartype){
                    if($onecartype === $productRow['cartype'] ){ ?>
                        <option value="<?php echo $onecartype; ?>" selected><?php echo $onecartype;?></option>
                        <?php
                    }else{ ?>
                        <option value="<?php echo $onecartype; ?>"><?php echo $onecartype;?></option>
                        <?php
                    }
                } ?>

            </select><br/><br/>


            <span>Model:</span>
                <select id="models_list" name="model" placeholder="model" value="<?php echo $productRow['model']; ?>"></select><br/><br/>

            <label>Year:</label>
            <input type="text" name="year" maxlength="4" size="4" placeholder="year" value="<?php echo $productRow['year']; ?>"><br/><br/>

            <label>Millage:</label><input type="text" name="millage" placeholder="millage" value="<?php echo $productRow['millage']; ?>"><br/><br/>

            <label>Fuel Type:</label>
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
         
            </select><br/><br/>

            <label>Color:</label>
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

            </select><br/><br/>

            <label>Price:</label><input type="text" name="price" placeholder="price" value="<?php echo $productRow['price']; ?>"><br/><br/>

            <label>Engine Capacity:</label>
            <input type="number" name="engineCapacity"  pattern="[0-9]+([\.,][0-9]+)?" step="0.1" placeholder="enginecapacity" value="<?php echo $productRow['enginecapacity']; ?>"></input><br/><br/>

            <label>Transmission:</label>
            <?php $transmission = array("-", "manual", "automatic", "continuously variable", "semi_automatic_and_dual_clutch");?>
            <select name="gearBox" placeholder="gearbox" value="<?php echo $productRow['gearbox']; ?>">

                <?php foreach($transmission as $onetransmission){
                    if($onetransmission === $productRow['gearbox'] ){ ?>
                        <option value="<?php echo $onetransmission; ?>" selected><?php echo$onetransmission;?></option>
                        <?php
                    }else{ ?>
                        <option value="<?php echo $onetransmission; ?>"><?php echo $onetransmission;?></option>
                        <?php
                    }
                } ?>

            </select><br><br>

            <label>Info:</label><input type="text" name="info" placeholder="info" value="<?php echo $productRow['info']; ?>"><br/><br/>
            
            <label>Registration Number:</label><input type="text" name="registrationnumber" placeholder="registrationnumber" value="<?php echo $productRow['registrationnumber']; ?>"><br/><br/>

            <label>Tehnical Inspection:</label><input type="text" name="technicalinspection" placeholder="technicalinspection" value="<?php echo $productRow['technicalinspection']; ?>"><br/><br/>

            <label>additional:</label><input type="text" name="additional" placeholder="additional" value="<?php echo $productRow['additional']; ?> "selected><br/><br/>

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
                
                <div class="additional_checkbox">
                    <label>Equipment</label><br>
                        <input type="checkbox" name="equipment[]" value="hydraulic_steerimg_booster" <?php if(in_array('hydraulic_steerimg_booster', $extrindexarray['Equipment'])){echo "checked";} ?>> hydrplic booster<br>