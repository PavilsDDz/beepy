<?php 
	include 'brandsandmodels.php';
	if(isset($_POST['carType'])&&!empty($_POST['carType'][0])){
		?>


		<div class="filter_group">
			<span>car types:</span>
			<div class="filter_items flex">
				<?php foreach ($_POST['carType'] as $value) {
					?>
					<div class="filter_item">
						<span><?php echo $value; ?></span>
						<div class="remove" remove="<?php echo $value ?>"></div>
					</div>
				<?php } ?>	
			</div>
			<div class="remove_group" remove="carType" group=".carType"></div>
		</div>


		<?php
	}

	if(isset($_POST['brand'])){
		?>


		<div class="filter_group">
			<span>brands:</span>
			<div class="filter_items flex">
				<?php foreach ($_POST['brand'] as $value) {

					?>

					<div class="filter_item">
						<span><?php echo $value; ?></span>
						<div class="remove" remove="<?php echo $value ?>"></div>
						<div class="models_selected">
					<?php
					foreach ($models[$value]as$model) {
						if (isset($_POST['model'])&&in_array($model, $_POST['model'])) {
							?>
							<div class="model_wrap"><span><?php echo $model ?></span><span class="remove" remove="<?php echo $value.'_'.str_replace(' ', '', $model)?>"></span></div>

						<?php } ?>
						
					<?php } ?>
						</div>
					</div>
				<?php } ?>	
			</div>
			<div class="remove_group" remove="brand"  group="#brand"></div>
		</div>
		

		 <?php
		}

	if(isset($_POST['model'])){
		?>

		<?php
	}
	if ((isset($_POST['year_from'])||isset($_POST['year_to']))&&($_POST['year_from']!=''||$_POST['year_to']!='')) {
		?>


		<div class="filter_group">
			<span>year:</span>
			<div class="filter_items flex">
				<?php if(isset($_POST['year_from'])) {
					?>
					<div class="filter_item">
						<label>from</label>	<span><?php echo $_POST['year_from']; ?></span>
						<div class="clear" clear="year_from"></div>
					</div>
				<?php } ?>
				<?php if(isset($_POST['year_to'])) {
					?>
					<div class="filter_item">
						<label>to</label><span><?php echo $_POST['year_to']; ?></span>
						<div class="clear" clear="year_to"></div>
					</div>
				<?php } ?>	
			</div>
			<div class="clear_group" clear="year_select" group=".year_select"></div>
		</div>

		<?php
	}
	if((isset($_POST['millage_from'])||isset($_POST['millage_to']))&&($_POST['millage_from']!=''||$_POST['millage_to']!='')) {
		?>
		<div class="filter_group">
			<span>millage:</span>
			<div class="filter_items flex">
				<?php if(isset($_POST['millage_from'])) {
					?>
					<div class="filter_item">
						<label>from</label><span><?php echo $_POST['millage_from'].'km'; ?></span>
						<div class="clear" clear="millage_from"></div>
					</div>
				<?php } ?>
				<?php if(isset($_POST['millage_to'])) {
					?>
					<div class="filter_item">
						<label>to</label><span><?php echo $_POST['millage_to'].'km'; ?></span>
						<div class="clear" clear="millage_to"></div>
					</div>
				<?php } ?>	
			</div>
			<div class="clear_group" clear="millage_select" group=".millage_select"></div>
		</div>
		<?php
	}
	if((isset($_POST['price_from'])||isset($_POST['price_to']))&&($_POST['price_from']!=''||$_POST['price_to']!='')) {
		?>
		<div class="filter_group">
			<span>Price:</span>
			<div class="filter_items flex">
				<?php if(isset($_POST['price_from'])) {
					?>
					<div class="filter_item">
						<label>from</label><span><?php echo $_POST['price_from'].'€'; ?></span>
						<div class="clear" clear="price_from"></div>
					</div>
				<?php } ?>
				<?php if(isset($_POST['millage_to'])) {
					?>
					<div class="filter_item">
						<label>to</label><span><?php echo $_POST['price_to'].'€'; ?></span>
						<div class="clear" clear="price_to"></div>
					</div>
				<?php } ?>	
			</div>
			<div class="clear_group" clear="price_select" group=".price_select"></div>
		</div>

		<?php
	}
	if((isset($_POST['engineCapacity_from'])||isset($_POST['engineCapacity_to']))&&($_POST['engineCapacity_from']!=''||$_POST['engineCapacity_to']!='')) {
		?>

		<div class="filter_group">
			<span>Engine:</span>
			<div class="filter_items flex">
				<?php if(isset($_POST['engineCapacity_from'])) {
					?>
					<div class="filter_item">
						<label>from</label><span><?php echo $_POST['engineCapacity_from'].'l'; ?></span>
						<div class="clear" clear="engineCapacity_from"></div>
					</div>
				<?php } ?>
				<?php if(isset($_POST['engineCapacity_to'])) {
					?>
					<div class="filter_item">
						<label>to</label><span><?php echo $_POST['engineCapacity_to'].'l'; ?></span>
						<div class="clear" clear="engineCapacity_to"></div>
					</div>
				<?php } ?>	
			</div>
			<div class="clear_group" clear="engineCapacity_select" group=".engineCapacity_select"></div>
		</div>


		<?php
	}
	if (isset($_POST['gearBox'])&&$_POST['gearBox']!='') {
		?> 

		<div class="filter_group">
			<span>Transmition:</span>
			<div class="filter_items flex">
				
					
						<span><?php echo $_POST['gearBox'] ; ?></span>

					
				
			</div>
			<div class="deselect_group" remove="gearBox" group="#gearBox"></div>
		</div>

		<?php
	}
	if(isset($_POST['color'])&&$_POST['color']!=''){
		?>


		<div class="filter_group">
			<span>Color:</span>
			<div class="filter_items flex">
				
					
						<span><?php echo $_POST['color'] ; ?></span>

					
				
			</div>
			<div class="deselect_group" remove="color" group="#color"></div>
		</div>

		<?php
	}
	if(isset($_POST['fuelType'])&&$_POST['fuelType']!=''){
		?>
		<div class="filter_group">
			<span>Fuel type:</span>
			<div class="filter_items flex">
				
					
						<span><?php echo $_POST['fuelType'] ; ?></span>

					
				
			</div>
			<div class="deselect_group" remove="fuelType" group="#fuelType"></div>
		</div>

		<?php
	}
 ?>
 <script type="text/javascript">
 	$(function(){
 		$('.remove_group').click(function(){
 			that = $(this);
 			group = that.attr('remove')
 			parent  = that.attr('group')
 			len = $(parent +' input').length
 			for (var i = 0; i < len; i++) {
 				$(parent +' input:eq('+i+')')[0].checked = false;
 			}
 			if(parent == '#brand'){
 				len2 = $('#models_list input').length
 				for (var x = 0; x < len2; x++) {
 					$('#models_list input:eq('+x+')')[0].checked = false;
 				}
 			}
 			that.parent().remove();


 		})
 		$('.clear_group').click(function(){
 			
 			that = $(this)
 			parent  = that.attr('group')
 			len = $(parent +' input').length
 			for (var i = 0; i < len; i++) {
 				$(parent +' input:eq('+i+')')[0].value = null;
 				
 			}
 			
 			that.parent().remove();

 		})
 		$('.remove').click(function(){
 			that = $(this);
 			item = that.attr('remove');
 			console.log($('#input_'+item))
 			$('#input_'+item)[0].checked = false;
 			that.parent().remove();
 			//launch_req();
 		})
 		$('.clear').click(function(){
 			that = $(this)
 			item = that.attr('clear')
 			document.getElementById(item).value = '';
 			that.parent().remove()
 		})
 		$('.deselect_group').click(function(){
 			that = $(this)
 			item = that.attr('remove')

 			elements = document.getElementById(item).options
 			console.log(elements)

 			for(var i = 0; i < elements.length; i++){
     			 elements[i].selected = false;
    		}
    		that.parent().remove()
 		})
 	})
 </script>
 <style>
 	
 </style>