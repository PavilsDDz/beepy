<?php 

    include('brandsandmodels.php');

    	//print_r($_REQUEST);
    	//echo "<br>".$_REQUEST['for'];
    if ($_REQUEST['for']=='buy') {
	    if (isset($_REQUEST['brand'])&&is_array($_REQUEST['brand'])) {
	    	if (isset($_REQUEST['model'])) {
	    		$have_models = $_REQUEST['model'];
	    	} 
	    	
	    	$model_req = $_REQUEST['brand'];
	    	//print_r($have_models);
	   		
		    foreach($model_req as $mr){
		    		//echo '<br>'.$mr.'<br>';
		    	echo'<div class="brand_wrap flex"><div class="brand_logo" style="background-image:url(logos/'.strtolower($mr).'.png)"><h5>'.$mr.'</h5></div><div class="inputs flex">';
		    	foreach ($models[$mr] as $model) {
			     
			    	
			    		if (isset($have_models)&&in_array($model, $have_models)) {

			       			echo "<input type='checkbox' name='model[]' id='input_".$mr."_".str_replace(' ', '', $model)."' checked='checked' value='".$model."'>";

			       			echo "<label id='label_".$mr.str_replace(' ', '', $model)."' for='input_".$mr."_".str_replace(' ', '', $model)."'>".$model."</label>";
			       			
			    			
			    		}else{

			       			echo "<input type='checkbox' name='model[]' id='input_".$mr."_".str_replace(' ', '', $model)."' value='".$model."'>";


			       			echo "<label id='label_".$mr.str_replace(' ', '', $model)."' for='input_".$mr."_".str_replace(' ', '', $model)."'>".$model."</label>";

			       		}

			       		echo "<style>input[type=checkbox]:checked + #label_".$mr.str_replace(' ', '', $model)." {color: #fff;background-color:#00c6ff;}</style>";

			       		//echo"<style>#brand input[type=checkbox]:checked + #labe_".$brand." {background-image:url( logos/".strtolower($brand).".png )!important;opacity: 1;}</style>";

		    		
		    		}
		    	echo "</div></div>";
		    }
	    }


    }else if ($_REQUEST['for']=='sell') {
    	if(isset($_REQUEST['brand'])){
    		echo "<option value=''>";
	    	$model_req = $_REQUEST['brand'];
    		foreach ($models[$model_req] as $model) {
    			echo "<option value=".$model.">".$model;
    		}
    	}
    	
    }

?>