$(function(){
	/*Hides all img elements whitch dose not have src*/
	function hide_imgs(h,l){
		console.log('hide_imgs call')
		while(h<l){
		console.log('hiding')

			$('.img_i_wrap:eq('+h+')').css('display','none')
			h++;
		}
	}
	/*gets temp file location*/
	file_input_change = function (event){
	    output = URL.createObjectURL(event.target.files[0]);
	    //console.log(output)
	    return output;
	}


	var Himgs
	var Limgs
	var counter 
	var files_del = [];
	var links_list_str;
	//var links_list


	/*determines if post have imgs and how much and calls hide_imgs*/

	if(typeof have_imgs!=='undefined'){
		console.log("have "+have_imgs+" imgs from "+limit)
		Himgs=have_imgs;
		Limgs = limit;
		hide_imgs(Himgs,Limgs);
		counter = Himgs;

	}else{
		Himgs=0;
		Limgs = 10;
		counter = Himgs
		console.log("have "+Himgs+" imgs from "+Limgs)
		hide_imgs(Himgs,Limgs);

	}

	/*


	actions on file input change
	-gets temp path "new_path"
	-asigns temp path to sibling img
	-if link list exists, removes img src, by this index, frmo list (gets replacet on submit with php)
	-adds removed img do delet queue
	-stores imgs to delet and imgs to stay in inputs

	*/
	console.log(links_list)
	$('.file_input').change(function(){
		
		var filename = $(this).val();
		new_path = file_input_change(event);
		console.log(file_input_change(event))
		$(this).parent().siblings('.fake_i').children('img').attr('src',new_path)
		
		if (typeof links_list!=='undefined') {

			console.log(links_list/* + "THIS IS LIST OF LINKS THAT STAY"*/)

			index =  $(this).parent().index() //
			//console.log(index + "index")

			files_del.push(links_list[index-1])
			links_list.splice(index-1,1)

			links_list_str = '';
			files_del_str = '';

			for (var i = 0; i < files_del.length; i++) {
				files_del_str += files_del[i]+";"
			}

			for (var i = 0; i < links_list.length; i++) {
				links_list_str += links_list[i]+";"
			}

			console.log(links_list_str+" STAY")
			console.log(files_del_str+" DELET")
			$('#files_stay').attr('value',links_list_str);
			$('#files_del').attr('value',files_del_str);
		}

	})

	/* reveles hiden img inputs*/

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

	/*makes img as input*/
	
	$('.fake_i').click(function(){
		//alert('go')
		that = $(this)
		//console.log(that.siblings('.file-upload').children(".file_input"))
		//console.log(that)

		that.siblings('.file-upload').children(".file_input").click()
	})



})