<?php
  
include ('assets/connect.php');
include ('assets/setup.php');

include("assets/brandsandmodels.php");
include("assets/functions.php");
include("assets/searchingLang.php");
include("assets/searchingTwoLang.php");
include("assets/addcarLang.php");


//search data by submited values

if (isset($_POST['search']) OR isset($_POST['brand'])) {
    $query = "SELECT * FROM products WHERE";
    $playload = array();
    
    // CAR TYPE
    if (notEmpty("carType")) {
        //$query = $query . " cartype = :carType AND";
        //$playload["carType"] = $_POST['carType'];
        $carType = $_POST['carType'];
        $carType_count = count($carType);

            $c = 0;
        foreach ($carType as $ct) {
            $c++;

            if($carType_count>1){
                if ($c == $carType_count) {
                    $query = $query . " cartype = :cartype".$c.") AND";
                }else if($c==1){
                    $query = $query . " (cartype = :cartype".$c." OR";
                }else{
                     $query = $query . " cartype = :cartype".$c." OR";
                }
            }else{
                $query = $query . " cartype = :cartype".$c." AND";
            }

                $playload["cartype".$c] = $ct;
        }
    }

    // BRAND
    if (notEmpty("brand")) {

        $brand = $_POST['brand'];
        $brand_conut = count($brand);
        $b = 0;

        foreach ($brand as $br) {
        $b++;
            // if ($brand_conut == $b) {

            //     $query = $query . " brand = :brand".$b." AND";
            //     $playload["brand".$b] = $br;


            // }else{

            //     $query = $query . " brand = :brand".$b." OR";
            //     $playload["brand".$b] = $br;

            // }

             if($brand_conut>1){
                if ($b == $brand_conut) {
                    $query = $query . " brand = :brand".$b.") AND";
                }else if($b==1){
                    $query = $query . " (brand = :brand".$b." OR";
                }else{
                     $query = $query . " brand = :brand".$b." OR";
                }
            }else{
                    $query = $query . " brand = :brand".$b." AND";
            }

                $playload["brand".$b] = $br;
        }
    }

    // MODEL
    if (notEmpty("model")) {

        $model = $_POST['model'];
        $model_count = count($model);
        $m = 0;

        foreach ($model as $md) {
            $m++;

            if($model_count>1){
                if ($m == $model_count) {
                    $query = $query . " model = :model".$m.") AND";
                }else if($m==1){
                    $query = $query . " (model = :model".$m." OR";
                }else{
                     $query = $query . " model = :model".$m." OR";
                }
            }else{
                    $query = $query . " model = :model".$m." AND";
            }

                $playload["model".$m] = $md;
        }

    }

    // YEAR
    if (notEmpty("year_from")) {
        $query = $query . " year >= :year_from AND";
        $playload["year_from"] = $_POST['year_from'];
    }

    if (notEmpty("year_to")) {
        $query = $query . " year <= :year_to AND";
        $playload["year_to"] = $_POST['year_to'];
    }

    // MILLAGE
    if (notEmpty("millage_from")) {
        $query = $query . " millage <= :millage_from AND";
        $playload["millage_from"] = $_POST['millage_from'];
    }

    if (notEmpty("millage_to")) {
        $query = $query . " millage >= :millage_to AND";
        $playload["millage_to"] = $_POST['millage_to'];
    }

// FUEL TYPE

    if (notEmpty("fuelType")) {
        $query = $query . " fuelType = :fueltype AND";
        $playload["fueltype"] = $_POST['fuelType'];
    }

// COLOR

    if (notEmpty("color")) {
        $query = $query . " color = :color AND";
        $playload["color"] = $_POST['color'];
    }

    
    // PRICE FROM
    if (notEmpty("price_from") ) {
        $query = $query . " price >= :price_from AND";
        $playload["price_from"] = $_POST['price_from'];
    }
    
    // PRICE TO
    if (notEmpty("price_to")) {
        $query = $query . " price <= :price_to AND";
        $playload["price_to"] = $_POST['price_to'];
    }

    // ENGINE CAPACITY

    if (notEmpty("engineCapacity_from")) {
        $query = $query . " enginecapacity >= :engineCapacity_from AND";
        $playload["engineCapacity_from"] = $_POST['engineCapacity_from'];
    }

    if (notEmpty("engineCapacity_to")) {
        $query = $query . " enginecapacity <= :engineCapacity_to AND";
        $playload["engineCapacity_to"] = $_POST['engineCapacity_to'];
    }

    // GEAR GEAR

    if (notEmpty("gearBox")) {
        $query = $query . " gearbox = :gearbox AND";
        $playload["gearbox"] = $_POST['gearBox'];
    }

// ORDER

    if (notEmpty("sort")) {
        $query = substr($query, 0, -4);
        $query .= " ORDER BY ".$_POST['sort'];
    }else{
        $query = substr($query, 0, -4);
        $query .= " ORDER BY price";
    }
   
    if (notEmpty("order")) {
        $query .= " ".$_POST['order'];
        
    }else{
         $query .= " ASC";
    }

    $searchStmt = getAllDataFromDatabase($query, $playload);
    // print_r($_POST);
    // echo'<br>';
    // echo $query.'<br>';
    // print_r($playload);
}

?>
<html>
    <head>
        <meta charset="utf-8">

        <link rel="stylesheet" type="text/css" href="css/search_style.css">
    <?php include"assets/head.php" ?>
        
        <script type="text/javascript" src="scripts/checkbox.js"></script>
        <script type="text/javascript" src="scripts/handles.js"></script>
        <script type="text/javascript" src="scripts/ui/jquery-ui.js"></script>

        <link rel="stylesheet" type="text/css" href="scripts/ui/jquery-ui.css">
    </head>

    <script type="text/javascript">
        var launch_req
    </script>
    <script type="text/javascript">

    $(function(){

            var showHint = function (str) {
               // console.log(str)
                if (str.length == 0) {
                    document.getElementById("models_list").innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("models_list").innerHTML = this.responseText;
                            //console.log(this.responseText)
                        }
                    }
                    xmlhttp.open("GET", "assets/caroption+.php?for=buy&" + str, true);
                    xmlhttp.send();
                }
            }

            launch_req = function () {

               // console.log('Brand Chosen')

                var brand_select = document.getElementsByName("brand[]");
                var brands = [];
                var brands_str = '';
                var models_selected<?php if (isset($_POST['model'])) { echo ' = '.json_encode($_POST['model']);}else echo' = []' ?>;


                for(var i = 0; i<brand_select.length;i++){
                    if (brand_select[i].checked) {
                        brands.push(brand_select[i].value)
                }
                    }

                for(var a=0; a<brands.length;a++){
                    if (a==brands.length-1) { brands_str += 'brand[]='+brands[a]}else{
                        brands_str += 'brand[]='+brands[a]+'&'
                    }
                }

                if (models_selected.length>0) {

                    for(m=0;m<models_selected.length;m++){
                        if (m==0) {brands_str +='&model[]='+models_selected[m]+'&'}
                            else if(m==models_selected.length-1){brands_str +='model[]='+models_selected[m]}
                                else{
                                    brands_str +='model[]='+models_selected[m]+'&'
                                }
                    }
                    
                }

                    //console.log(brands_str)
               //var brand = brand_select.options[brand_select.selectedIndex].value;

                showHint(brands_str);

            }
            launch_req()

    })
    </script>
    
<body>
<div id="fixed" class="content_container">
<?php 
    include"assets/header.php"
     ?>

    <div class="compare_box">
        <div class="compare_toggle">
            <a><?php echo $searchL[$lang]['compare'] ?></a>
        </div>
        <div class="compare_content">
            <div class="car flex"><div class="comp_icon"> </div></div>
            <div class="car flex"><div class="comp_icon"> </div></div>
            <div class="car flex"><div class="comp_icon"> </div></div>
            <div class="compare_link">
                <a id="compare_link" href="">comp</a>
            </div>
        </div>
    </div>
    <div id="header">
        
            
       <div class="header_content">
           <div class="usedcars">
               <img src="img/findacar.png" width="34%">
           </div>

           <!--<form style="text-align: center" class="header_form">
               <input type="text" placeholder="Find a car" maxlength="" size="" value="">
           </form>-->
       </div>
            
        <div class="cut"></div>
        </div>
        <div id="sell_search">
    <!--Table Search--> 
    <div class="search">

    </div>
    <div class="search_ext">

        <form action="searching.php" method="POST">
        <div class="large_filters">
            <!--Car TYPE-->

                <div class="groupLabel flex"><label > <?php echo $texts[$lang]['type'] ?> </label></div>
                <div class="carType">
                    <?php 
                     
                    $car_types = ['coupe','hatchback','minivan','van','pickup','sedan','unversal','offroad','sport','other'];

                    foreach ($car_types as $type) {
                        ?>


                    <input type="checkbox" id="input_<?php echo $type;?>" name="carType[]" value="<?php echo $type;?>"<?php if(isset($_POST['carType'])){if (in_array($type,$_POST['carType'])) {echo 'checked="checked"';}} ?>><label class="label2" for="input_<?php echo $type;?>" id="label_<?php echo $type;?>"><?php echo $texts[$lang][$type];?></label>

                    <?php
                    }
                     ?>
             
                </div>

    <!-- līdz šij vietai strādā ideāli-->

                <!--BRANDS--> 
                <div class="groupLabel flex"><label> <?php echo $texts[$lang]['brands'] ?> </label></div>

                <div id="brand" class="">
                    <div class='prev'><</div>
                    <div class='next'>></div>
                    <div class="wrap">

                    <?php


                        $selected = '';
                        $c = 1;
                        foreach ($cars as $brand) {
                            $select = getData("brand") == $brand ? "selected" : "";

                            if(isset( $_POST['brand'])&&in_array($brand, $_POST['brand'])){
                                echo "<input class='checkbox1' type='checkbox' id='input_".$brand."' name='brand[]' value='".$brand."' checked='checked' onchange='launch_req()'><label class='lable1' id='labe_".$brand."' for='input_".$brand."' style='background-image:url(logos/".strtolower($brand).".png)' brand='".strtolower($brand).")'></label>";
                            }else{
                                echo "<input class='checkbox1' type='checkbox' id='input_".$brand."' name='brand[]' value='".$brand."' onchange='launch_req()'><label class='label1' id='labe_".$brand."' for='input_".$brand."' style='background-image:url(logos/".strtolower($brand)."_g.png)' 
                                brand='".strtolower($brand).")' ></label>";
                            }
                                echo"<style>#brand input[type=checkbox]:checked + #labe_".$brand." {

                                background-image:url( logos/".strtolower($brand).".png )!important;opacity: 1;}</style>"; 
                                $c++;
                        }

                    ?>
                    </div>
                </div>
            <!--MODELS-->
                <div class="groupLabel flex"><label ><?php echo $texts[$lang]['model'] ?></label></div>
                <div id="models_list"></div>
            </div>
            <!--YEARS-->

            <div class="small_filters flex">
                <div class="range_select year_select line_select">
                    <label class="groupLabel flex"> <?php echo $texts[$lang]['year'] ?> </label>
                    <input type="text" name="year_from" id="year_from" placeholder="1970" value="<?php echo getData("year_from"); ?>" >
                    <label>-</label>
                    <input type="text" name="year_to" id="year_to" placeholder="2017" value="<?php echo getData("year_to"); ?>" >
                    <div id="year-range"></div>
                </div>


                <!--MILLAGE-->
                <div class="range_select millage_select line_select">   
                    <div class="groupLabel flex"><label ><?php echo $texts[$lang]['millage'] ?></label></div>
                    <div>
                        <label><?php echo $texts[$lang]['from'] ?></label><input type="text" name="millage_from" id="millage_from" placeholder="0" value="<?php echo getData("millage_from"); ?>" ><label style="margin-right: 5px;"><?php echo $texts[$lang]['km'] ?></label>
                        <label><?php echo $texts[$lang]['to'] ?></label>
                        <input type="text" name="millage_to" placeholder="300000" id="millage_to" value="<?php echo getData("millage_to"); ?>" ><label><?php echo $texts[$lang]['km'] ?></label>
                    </div>
                    <div id="millage-range"></div>
                </div>
                <!--FUEL TYPE-->
                <div class="fuel_select optionselect flex">
                    <div class="groupLabel flex"><label ><?php echo $texts[$lang]['fuel_type'] ?></label></div>
                    <select name="fuelType" id="fuelType">
                        <option value="" >-</option>
                        <option value="petrol" <?php echo getData("fuelType") == "petrol" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['petrol'] ?> </option>
                        <option value="diesel" <?php echo getData("fuelType") == "diesel" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['diesel'] ?> </option>
                        <option value="gas" <?php echo getData("fuelType") == "gas" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['gas'] ?> </option>
                        <option value="electricity" <?php echo getData("fuelType") == "electricity" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['electric'] ?> </option>
                    </select>
                </div>

                <!--COLOR-->
                <div class="color_select optionselect flex">
                    <div class="groupLabel flex"><label > <?php echo $texts[$lang]['color'] ?> </label></div>
                    <select name="color" id="color">
                        <option value="">-</option>
                        <option value="white" <?php echo getData("color") == "white" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['white'] ?> </option>
                        <option value="black" <?php echo getData("color") == "black" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['black'] ?> </option>
                        <option value="red" <?php echo getData("color") == "red" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['red'] ?> </option>
                        <option value="yellow" <?php echo getData("color") == "yellow" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['yellow'] ?> </option>
                        <option value="green" <?php echo getData("color") == "green" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['green'] ?> </option>
                        <option value="Gray" <?php echo getData("color") == "Gray" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['gray'] ?> </option>
                        <option value="Blue" <?php echo getData("color") == "Blue" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['blue'] ?> </option>
                    </select>
                </div>

                <!--PRICE-->
                <div class="range_select price_select line_select">
                    <div class="groupLabel flex"><label ><?php echo $texts[$lang]['price'] ?></label></div>
                    <div>
                        <label><?php echo $texts[$lang]['from'] ?></label>
                        <input type="text" name="price_from" id="price_from" value="<?php echo getData("price_from"); ?>" >
                        <label style="margin-right: 5px;">€</label><label><?php echo $texts[$lang]['to'] ?></label>
                        <input type="text" name="price_to" id="price_to" value="<?php echo getData("price_to"); ?>" >€</label>
                    </div>
                    <div id="price-range"></div>

                </div>

                <!--ENIGNE CAPACITY-->
                <div class="range_select engineCapacity_select line_select">
                    <div class="groupLabel flex"><label > <?php echo $texts[$lang]['engine_capacity'] ?> </label></div>
                    <input type="number" id="engineCapacity_from" name="engineCapacity_from"  pattern="[0-9]+([\.,][0-9]+)?" step="0.1" value="<?php echo getData('engineCapacity_from') ?>"></input>
                    <label>-</label>
                    <input type="number" id="engineCapacity_to" name="engineCapacity_to"  pattern="[0-9]+([\.,][0-9]+)?" step="0.1" value="<?php echo getData('engineCapacity_to') ?>"> </input>
                    <div id="engineCapacity-range"></div>

                </div>

            <!--GEAR_BOX-->
                    <div class="optionselect flex gearboxselect">

                        <div class="groupLabel flex"><label ><?php echo $texts[$lang]['transmission'] ?></label></div>
                        <select name="gearBox" id="gearBox">
                            <option value="">-</option>
                            <option value="manual" <?php echo getData("gearBox") == "manual" ? "selected='selected'" : ""; ?> ><?php echo $texts[$lang]['manual'] ?></option>
                            <option value="automatic" <?php echo getData("gearBox") == "automatic" ? "selected='selected'" : ""; ?> ><?php echo $texts[$lang]['automatic'] ?></option>
                            <option value="semi_automatic_and_dual_clutch" <?php echo getData("gearBox") == "semi_automatic_and_dual_clutch" ? "selected='selected'" : ""; ?> ><?php echo $texts[$lang]['semi'] ?></option>
                        </select>
                    </div>
                </div>

            <label><?php echo $searchL[$lang]['sort'] ?></label>

            <select name="sort">
                <option value="price"><?php echo $searchL[$lang]['sortpice'] ?></option>
                <option value="millage"><?php echo $searchL[$lang]['sortmillage'] ?></option>
                <option value="year"><?php echo $searchL[$lang]['sortyear'] ?></option>
            </select>

            <label><?php echo $searchL[$lang]['order'] ?></label>

            <select name="order">
                <option value="DESC"><?php echo $searchL[$lang]['orderto'] ?></option>
                <option value="ASC"><?php echo $searchL[$lang]['orderfrom'] ?></option>
            </select>
            
            <br/>
            <!--CHASSIS SERIAL-->
            </br>

            <div class="selected_filters">
                <h2><?php echo $searchL[$lang]['selectf'] ?></h2>
                
                <?php include"assets/filters.php"; ?>
            </div>

            <input name="search" type="submit" value="<?php echo $searchL[$lang]['search'] ?>" >

        </form>
    </div>
        <!--<div><p class="search_text">Search</p></div>-->

        <div id="table_cars">
            <div class="wrap">

                <?php if(isset($searchStmt) && !empty($searchStmt)) { ?>
                    <div class="inline_blocks">
                        <?php foreach($searchStmt as $item) { ?>
                            <?php $imgLinks = explode(";", $item['photoid']); ?>

                                    <div class="logo" >
                                        <div class="compare_butt" info="<?php echo $item['id']; ?>" infopic="<?php echo $imgLinks[0] ?>" infomodel='<?php echo $item['model']; ?>' infobrand='<?php echo $item['brand']; ?>' infomillage='<?php echo $item['millage']; ?>' infoprice='<?php echo $item['price']; ?>'>
                                            
                                        </div>
                                    
                                        <div class="img"><div class="img_wrap flex"><img src="<?php echo $imgLinks[0] ?>"></div><div class="bg_cover"></div></div>
                                        <a href="product.php?id=<?php echo $item['id'] ?>" target="blank">
                                        <div class="text" >
                                            <br><h3><?php echo $item['brand'].' '.$item['model'].' '.$item['enginecapacity'].' '.$item['year']?></h3>
                                            
                                            <p><?php echo $item['price']; ?></p>
                                        </div>
                                        </a>
                                    </div>

                        <?php } ?>
                    </div>
                <?php } ?>

            </div>

        </div>
        <?php include"assets/footer.php" ?>
</div>
<script type="text/javascript">
    var visable = 0;
    $(function(){
        $('.compare_toggle a').click(function(){
            if(visable==0){
            $('.compare_butt').css('display','block');

            $('.compare_content').slideToggle()
                visable=1
            }else{
                $('.compare_butt').css('display','none');
                visable = 0
                $('.compare_content').slideToggle()

            }
        })
        var counter = []
        function upadet_link(){
              var linkStr= "compare.php?"
                for (var i = 0; i < counter.length; i++) {
                    if (i==counter.length-1) {
                        linkStr = linkStr+"idc[]="+counter[i]
                    }else{
                        linkStr = linkStr+"idc[]="+counter[i]+'&'
                    }
                }
                $('#compare_link').attr('href',linkStr)
        }

        $('.compare_butt').click(function(){
            that = $(this)

            if (counter.length<3) {

                id = that.attr('info')
                millage = that.attr('infomillage')
                brand = that.attr('infobrand')
                model = that.attr('infomodel')
                price = that.attr('infoprice')
                img = that.attr('infopic')
                counter.push(id)

                upadet_link();
                //alert(linkStr)

                $('.compare_box .car:eq('+(counter.length-1)+')').append('<div class="comp_icon" style="background-image:url('+img+')"></div><div class="comp_info"></div><div class="remove_comp"></div>')


            }


        })
        $('.compare_box .car').delegate($('.remove_comp'),'click',function(){

            that = $(this)
            that.html('')
            index = that.index()

            counter.splice(index-1,1)

            upadet_link()

            console.log(counter)

        })

    })

</script>
</body>
</html>