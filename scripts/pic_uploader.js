$(function(){

	function hide_imgs(h,l){
		console.log('hide_imgs call')
		while(h<l){
		console.log('hiding')

			$('.img_i_wrap:eq('+h+')').css('display','none')
			h++;
		}
	}
	file_input_change = function (event){
	    output = URL.createObjectURL(event.target.files[0]);
	    //console.log(output)
	    return output;
	}


	var Himgs
	var Limgs
	var counter 
	//var links_list


	if(typeof have_imgs!=='undefined'){
		console.log("have "+have_imgs+" imgs from "+limit)
		Himgs=have_imgs;
		Limgs = limit;
		hide_imgs(Himgs,Limgs);
		counter = Himgs

	}else{
		Himgs=0;
		Limgs = 10;
		counter = Himgs
		console.log("have "+Himgs+" imgs from "+Limgs)
		hide_imgs(Himgs,Limgs);

	}
	$('.file_input').change(function(){
		
		var filename = $(this).val();
		new_path = file_input_change(event);
		console.log(file_input_change(event))
		$(this).siblings('.fake_i').children('img').attr('src',new_path)
		index =  $(this).parent().index()
		
		links_list.splice(index,1)
		console.log(links_list)
	})

	$('#add_img_slot').click(function(){
		if (counter<Limgs-1) {
			console.log(counter)
			counter++
			$('.img_i_wrap:eq('+counter+')').css('display','block')
			if (counter==Limgs-1) {
				$(this).css('opacity','0.3')
			}
		}else{
			console.log(counter)
		}
	})

	$('.fake_i').click(function(){
		that = $(this)
		that.siblings('.file_input').click()
	})

	


})