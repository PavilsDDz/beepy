$(function(){
	
	var next_interval
	var single_logo_w = $('.label1').width()
	var step = single_logo_w*4
	//alert($('.label1').length)
	var counter = 0


	var move_function = function(obj,dir){

		obj.css('left', '+='+4*dir)
	}
	
	$(".next").mousedown(function(){
		dir = -1;
		target = $(this).siblings('.wrap')
		//alert(target.width()-target.parent().width())
		//uncoment for autoscroll
		//next_interval = setInterval(function(){move_function(target,dir)},30)

		if (parseInt(target.css('left'),10)+(step*2)>(target.width()-($('.label1').length*single_logo_w))) {

			target.animate({'left':'+='+step*dir},100)
			
		}

		console.log(parseInt(target.css('left'),10),target.width()-($('.label1').length*single_logo_w) )
	})

	$(".prev").mousedown(function(){
		dir = 1;
		target = $(this).siblings('.wrap')

			//target.animate({'left':'+='+step*dir},100)

		//target = $(this).siblings('.wrap')
		//next_interval = setInterval(function(){move_function(target,dir)},30)
		console.log(parseInt(target.css('left'),10),target.width()-($('.label1').length*single_logo_w) )
		if (parseInt(target.css('left'),10)-(step*1)<0) {

			target.animate({'left':'+='+step*dir},100)
			
		}
		//console.log(target.css('left'),counter,target.width()-($('.label1').length*single_logo_w) )


	})

	$(".next").mouseup(function(){
		//clearInterval(next_interval)
	})

	$(".prev").mouseup(function(){
		//clearInterval(next_interval)

	})

	

	 
 
})