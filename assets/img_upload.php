<div class="img_edit_block">
                
                <?php 

                    $limit = 10;
                    $img_counter = 0;

                if(isset($productResult[0]['photoid'])){ $imgLinks = explode(";", substr($productResult[0]['photoid'], 0, -1)); 
                
                
                    foreach($imgLinks as $oneimg){
                        ?>
                        <div class="img_i_wrap">
                        <div class="fake_i" >
                            <img src='<?php echo $oneimg ?>' height='150' width='150'>
                        </div>
                        
                        <!--<input class="file_input"  type="file"  accept="image/*" name="img[]" onchange="file_input_change(event)">-->
						
						 <label class="file-upload">
							  <input class="file_input"  type="file"  accept="image/*" name="img[]" onchange="file_input_change(event)">
							  <span>Choose File</span>
						 </label>
						
                        </div>


                  <?php
                   $img_counter++; 
                    }
                }else{
                    $imgLinks=[];
                }
                        echo "<script>var file_input_change;var have_imgs =".$img_counter."; var limit = ".$limit.";";

                        $js_array = json_encode($imgLinks);
                        echo "var links_list = ". $js_array . ";\n</script>";
                       
                        while( $img_counter<$limit){
                            ?>

                         <div class="img_i_wrap">
                        <div class="fake_i" >
                            <img src='' height='150' width='150'>
                        </div>
                        
                        <!--<input class="file_input"  type="file"  accept="image/*" name="img[]" onchange="file_input_change(event)">-->
						<label class="file-upload">
							<input class="file_input"  type="file"  accept="image/*" name="img[]" onchange="file_input_change(event)">
							<span>Choose File</span>
						</label>
						
                        </div>

                            <?php

                            $img_counter++;
                        }

                ?>
                <div id="add_img_slot">+</div>
                <input  type="hidden" name="files_del" value="" id="files_del">
                <input  type="hidden" name="files_stay" value="" id="files_stay">
            </div>
            <style type="text/css">
                input[type="file" i]{
    background-color: #fff;
    cursor: pointer;
    color: #00c6ff;
    border: solid 1px #00c6ff;
    font-size: 25px;
    padding: 6px 20px;
    width: 60%;
}
.img_edit_block, #add_img_slot{
    text-align: center;
}
#add_img_slot{
    width: 50px;
    height: 50px;
    text-transform: uppercase;
    font-size: 40px;
    line-height: 45px;
    color: #00c6ff;
    border: solid 1px #00c6ff;
    margin-top: 50px;
    border-radius: 13px;
    cursor: pointer;
}
.img_edit_block {
    display: flex;
    justify-content: center;
    padding: 0.5vw;

    width: 80%;
    flex-wrap: wrap;
    }
    .img_i_wrap {
        margin-bottom: 30px;
    }
    .img_i_wrap span {
        position: relative;
        top: 15px;
    }
.img_edit_block img{
    padding-left: 2vw;
    padding-right: 2vw;
}
.file-upload input[type="file"]{
    display: none;
}
.file-upload span {
    border: solid 1px;
    padding: 5px;
    border-radius: 20px;
}

            </style>