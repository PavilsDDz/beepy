<?php
  
include ('assets/connect.php');
include ('assets/setup.php');

include("assets/brandsandmodels.php");
include("assets/functions.php");
include("assets/searchingLang.php");
include("assets/searchingTwoLang.php");
include("assets/addcarLang.php");


//search data by submited values


if (isset($_GET['search']) OR isset($_GET['brand'])) {
    $query = "SELECT * FROM products WHERE";
    $playload = array();
    
    // CAR TYPE
    if (notEmptyGET("carType")) {
        //$query = $query . " cartype = :carType AND";
        //$playload["carType"] = $_GET['carType'];
        $carType = $_GET['carType'];
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
    if (notEmptyGET("brand")) {

        $brand = $_GET['brand'];
        $brand_conut = count($brand);
        $b = 0;

        foreach ($brand as $br) {
            $b++;
           
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
    if (notEmptyGET("model")) {

        $model = $_GET['model'];
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
    if (notEmptyGET("year_from")) {
        $query = $query . " year >= :year_from AND";
        $playload["year_from"] = $_GET['year_from'];
    }

    if (notEmptyGET("year_to")) {
        $query = $query . " year <= :year_to AND";
        $playload["year_to"] = $_GET['year_to'];
    }

    // MILLAGE
    if (notEmptyGET("millage_from")) {
        $query = $query . " millage <= :millage_from AND";
        $playload["millage_from"] = $_GET['millage_from'];
    }

    if (notEmptyGET("millage_to")) {
        $query = $query . " millage >= :millage_to AND";
        $playload["millage_to"] = $_GET['millage_to'];
    }

    // FUEL TYPE

    if (notEmptyGET("fuelType")) {
        $query = $query . " fuelType = :fueltype AND";
        $playload["fueltype"] = $_GET['fuelType'];
    }

    // COLOR

    if (notEmptyGET("color")) {
        $query = $query . " color = :color AND";
        $playload["color"] = $_GET['color'];
    }

    
    // PRICE FROM
    if (notEmptyGET("price_from") ) {
        $query = $query . " price >= :price_from AND";
        $playload["price_from"] = $_GET['price_from'];
    }
    
    // PRICE TO
    if (notEmptyGET("price_to")) {
        $query = $query . " price <= :price_to AND";
        $playload["price_to"] = $_GET['price_to'];
    }

    // ENGINE CAPACITY

    if (notEmptyGET("engineCapacity_from")) {
        $query = $query . " enginecapacity >= :engineCapacity_from AND";
        $playload["engineCapacity_from"] = $_GET['engineCapacity_from'];
    }

    if (notEmptyGET("engineCapacity_to")) {
        $query = $query . " enginecapacity <= :engineCapacity_to AND";
        $playload["engineCapacity_to"] = $_GET['engineCapacity_to'];
    }

    // GEAR GEAR

    if (notEmptyGET("gearBox")) {
        $query = $query . " gearbox = :gearbox AND";
        $playload["gearbox"] = $_GET['gearBox'];
    }

    // ORDER

    if (notEmptyGET("sort")) {
        $query = substr($query, 0, -4);
        $query .= " ORDER BY ".$_GET['sort'];
    }else{
        $query = substr($query, 0, -4);
        $query .= " ORDER BY price";
    }
   
    if (notEmptyGET("order")) {
        $query .= " ".$_GET['order'];
        
    }else{
         $query .= " ASC";
    }


    // Lapas Pārslēgšanas Sākums!!
    $results_per_page = 5;

    if(isset($_GET['per_page']) && $_GET['per_page'] > 0)
    {
     $results_per_page = $_GET['per_page'];     
    }

    
    $countQuery = "SELECT id FROM products";
    $stmtCount = getAllDataFromDatabase($countQuery);

    $number_of_results = count($stmtCount);
    $number_of_pages = ceil($number_of_results/$results_per_page);

    if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
    }

    
    $this_page_first_result = ($page-1)*$results_per_page;

    $query .= " LIMIT ".$this_page_first_result ."," .$results_per_page;

    $searchStmt = getAllDataFromDatabase($query, $playload);

    $new = explode('&page=',$_SERVER['REQUEST_URI']);
    
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
                var models_selected<?php if (isset($_GET['model'])) { echo ' = '.json_encode($_GET['model']);}else echo' = []' ?>;


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

            <?php include"assets/header.php"; ?>
            <?php include 'assets/menu_block.php'; ?>

            <div class="compare_box">

                <div class="compare_toggle">
                    <a><?php echo $searchL[$lang]['compare'] ?></a>
                </div>

                <div class="compare_content">

                    <div class="car flex"><p>Select cars</p> </div>
                    <div class="car flex"> </div>
                    <div class="car flex"> </div>

                    <div class="compare_link">
                        <a id="compare_link" href=""><div>comp</div></a>
                    </div>

                </div>

            </div>

            <div id="header">
        
                <div class="header_content">
                    <div class="usedcars">
                        <h2>Find a car.</h2>
                    </div>

                </div>
            
                <div class="cut"></div>

            </div>

            <div id="sell_search">
                
                <!--Table Search--> 
                <div class="search"></div>

                <div class="search_ext">

                    <form action="searching.php" method="GET">
                        <div class="large_filters">
                            <!--Car TYPE-->

                            <div class="groupLabel flex"><label > <?php echo $texts[$lang]['type'] ?> </label></div>
                            <div class="carType">

                                <?php 
                                
                                    $car_types = ['coupe','hatchback','minivan','van','pickup','sedan','unversal','offroad','sport','other'];

                                    foreach ($car_types as $type) { ?>

                                    <input type="checkbox" id="input_<?php echo $type;?>" name="carType[]" value="<?php echo $type;?>"<?php if(isset($_GET['carType'])){if (in_array($type,$_GET['carType'])) {echo 'checked="checked"';}} ?>><label class="label2" for="input_<?php echo $type;?>" id="label_<?php echo $type;?>"><?php echo $texts[$lang][$type];?></label>

                                    <?php
                                    }
                                ?>
                        
                            </div>

            

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
                                            $select = getDataGET("brand") == $brand ? "selected" : "";

                                            if(isset( $_GET['brand'])&&in_array($brand, $_GET['brand'])){
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
                                <input type="text" name="year_from" id="year_from" placeholder="1970" value="<?php echo getDataGET("year_from"); ?>" >
                                <label>-</label>
                                <input type="text" name="year_to" id="year_to" placeholder="2017" value="<?php echo getDataGET("year_to"); ?>" >
                                <div id="year-range"></div>
                            </div>


                            <!--MILLAGE-->
                            <div class="range_select millage_select line_select">   
                                <div class="groupLabel flex"><label ><?php echo $texts[$lang]['millage'] ?></label></div>
                                <div>
                                    <label><?php echo $texts[$lang]['from'] ?></label><input type="text" name="millage_from" id="millage_from" placeholder="0" value="<?php echo getDataGET("millage_from"); ?>" ><label style="margin-right: 5px;"><?php echo $texts[$lang]['km'] ?></label>
                                    <label><?php echo $texts[$lang]['to'] ?></label>
                                    <input type="text" name="millage_to" placeholder="300000" id="millage_to" value="<?php echo getDataGET("millage_to"); ?>" ><label><?php echo $texts[$lang]['km'] ?></label>
                                </div>
                                <div id="millage-range"></div>
                            </div>

                            <!--FUEL TYPE-->
                            <div class="fuel_select optionselect flex">
                                <div class="groupLabel flex"><label ><?php echo $texts[$lang]['fuel_type'] ?></label></div>
                                <select name="fuelType" id="fuelType">
                                    <option value="" >-</option>
                                    <option value="petrol" <?php echo getDataGET("fuelType") == "petrol" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['petrol'] ?> </option>
                                    <option value="diesel" <?php echo getDataGET("fuelType") == "diesel" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['diesel'] ?> </option>
                                    <option value="gas" <?php echo getDataGET("fuelType") == "gas" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['gas'] ?> </option>
                                    <option value="electricity" <?php echo getDataGET("fuelType") == "electricity" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['electric'] ?> </option>
                                </select>
                            </div>

                            <!--COLOR-->
                            <div class="color_select optionselect flex">
                                <div class="groupLabel flex"><label > <?php echo $texts[$lang]['color'] ?> </label></div>
                                <select name="color" id="color">
                                    <option value="">-</option>
                                    <option value="white" <?php echo getDataGET("color") == "white" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['white'] ?> </option>
                                    <option value="black" <?php echo getDataGET("color") == "black" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['black'] ?> </option>
                                    <option value="red" <?php echo getDataGET("color") == "red" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['red'] ?> </option>
                                    <option value="yellow" <?php echo getDataGET("color") == "yellow" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['yellow'] ?> </option>
                                    <option value="green" <?php echo getDataGET("color") == "green" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['green'] ?> </option>
                                    <option value="Gray" <?php echo getDataGET("color") == "Gray" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['gray'] ?> </option>
                                    <option value="Blue" <?php echo getDataGET("color") == "Blue" ? "selected='selected'" : ""; ?> > <?php echo $texts[$lang]['blue'] ?> </option>
                                </select>
                            </div>

                            <!--PRICE-->
                            <div class="range_select price_select line_select">
                                <div class="groupLabel flex"><label ><?php echo $texts[$lang]['price'] ?></label></div>
                                <div>
                                    <label><?php echo $texts[$lang]['from'] ?></label>
                                    <input type="text" name="price_from" id="price_from" value="<?php echo getDataGET("price_from"); ?>" >
                                    <label style="margin-right: 5px;">€</label><label><?php echo $texts[$lang]['to'] ?></label>
                                    <input type="text" name="price_to" id="price_to" value="<?php echo getDataGET("price_to"); ?>" >€</label>
                                </div>
                                <div id="price-range"></div>
                            </div>

                            <!--ENIGNE CAPACITY-->
                            <div class="range_select engineCapacity_select line_select">
                                <div class="groupLabel flex"><label > <?php echo $texts[$lang]['engine_capacity'] ?> </label></div>
                                <input type="number" id="engineCapacity_from" name="engineCapacity_from"  pattern="[0-9]+([\.,][0-9]+)?" step="0.1" value="<?php echo getDataGET('engineCapacity_from') ?>"></input>
                                <label>-</label>
                                <input type="number" id="engineCapacity_to" name="engineCapacity_to"  pattern="[0-9]+([\.,][0-9]+)?" step="0.1" value="<?php echo getDataGET('engineCapacity_to') ?>"> </input>
                                <div id="engineCapacity-range"></div>
                            </div>

                            <!--GEAR_BOX-->
                            <div class="optionselect flex gearboxselect">
                                <div class="groupLabel flex"><label ><?php echo $texts[$lang]['transmission'] ?></label></div>
                                <select name="gearBox" id="gearBox">
                                    <option value="">-</option>
                                    <option value="manual" <?php echo getDataGET("gearBox") == "manual" ? "selected='selected'" : ""; ?> ><?php echo $texts[$lang]['manual'] ?></option>
                                    <option value="automatic" <?php echo getDataGET("gearBox") == "automatic" ? "selected='selected'" : ""; ?> ><?php echo $texts[$lang]['automatic'] ?></option>
                                    <option value="semi_automatic_and_dual_clutch" <?php echo getDataGET("gearBox") == "semi_automatic_and_dual_clutch" ? "selected='selected'" : ""; ?> ><?php echo $texts[$lang]['semi'] ?></option>
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
                        
                        <select id="records" name="per_page"> 
                            <option  <?php if($results_per_page == 5){ echo "selected ";} ?>value="5">5</option>
                            <option  <?php if($results_per_page == 10){ echo "selected ";} ?>value="10">10</option>
                            <option  <?php if($results_per_page == 20){ echo "selected ";} ?>value="20">20</option>
                        </select>

                        <br/>
                        <!--CHASSIS SERIAL-->
                        </br>

                        <div class="selected_filters">
                            <h3><?php echo $searchL[$lang]['selectf'] ?></h3>
                            <?php include"assets/filters.php"; ?>
                        </div>

                        <div class="searchlabel"><input name="search" type="submit" value="<?php echo $searchL[$lang]['search'] ?>" ></div>

                    </form>

                </div>

                <!--Paging sākas!!  -->
                <?php

                $link = "$_SERVER[REQUEST_URI]";
                $page =  1;
                $max = 6;

                for ($page=1; $page<=$number_of_pages; $page++){

                    $page_link = $new[0].'&page='.$page;
                    echo '<a href="'.$page_link.'">' . $page . '</a> ';
                }
                ?>

                <!-- Paging beidzas!!!  -->

                <div id="table_cars">

                    <div class="wrap">

                        <?php if(isset($searchStmt) && !empty($searchStmt)) { ?>
                        
                            <div class="inline_blocks">

                                <?php foreach($searchStmt as $item) { ?>

                                    <?php $imgLinks = explode(";", $item['photoid']); ?>

                                    <div class="logo" >
                                        <div class="compare_butt" info="<?php echo $item['id']; ?>" infopic="<?php echo $imgLinks[0] ?>" infomodel='<?php echo $item['model']; ?>' infobrand='<?php echo $item['brand']; ?>' infomillage='<?php echo $item['millage']; ?>' infoprice='<?php echo $item['price']; ?>'></div>
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

                <!--Paging sākas!!  -->
                <?php

                    $link = "$_SERVER[REQUEST_URI]";
                    $page =  1;
                    $max = 6;


                    for ($page=1; $page<=$number_of_pages; $page++){

                        $page_link = $new[0].'&page='.$page;
                        echo '<a href="'.$page_link.'">' . $page . '</a> ';
                    }
                ?>
                <!-- Paging beidzas!!!  -->

                <?php include"assets/footer.php" ?>

                
            </div>
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
                                linkStr = linkStr+"idc[]="+counter[i].id
                            }else{
                                linkStr = linkStr+"idc[]="+counter[i].id+'&'
                            }
                        }
                        $('#compare_link').attr('href',linkStr)
                }
                function upadet_compare(){
                    for (var i = 0; i < $('.compare_box .car').length; i++) {
                        $('.compare_box .car:eq('+i+')').html('')
                    }
                    for (var i = 0; i < counter.length; i++) {

                    $('.compare_box .car:eq('+i+')').append('<div class="comp_icon" style="background-image:url('+counter[i].img+')"></div><div class="comp_info"><h5>'+counter[i].brand+' '+counter[i].model+'</h5><p>'+counter[i].millage+'km '+counter[i].price+'</p></div><div class="remove_comp"></div>')
                    }

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
                        counter.push({id:id,millage:millage,brand:brand,model:model,price:price,img:img})

                        upadet_link();
                        //alert(linkStr)
                        upadet_compare();

                    
                    console.log(counter)


                    }


                })
                $('.compare_box .car').delegate($('.remove_comp'),'click',function(){

                    that = $(this)
                    that.html('')
                    index = that.index()

                    counter.splice(index,1)

                    upadet_link()
                    upadet_compare()

                    console.log(counter)

                })

            })

        </script>

    </body>
</html>