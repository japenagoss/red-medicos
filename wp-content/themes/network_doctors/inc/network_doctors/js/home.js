$(document).ready(function(){

	$(".matchheight").matchHeight();

	position_top();

	function position_top(){
		var height_window = $(window).height(),
			height_conta  = $(".options_home_container").height() + 51,
			margin_top 	  = 0;

		if(height_window > height_conta){
			margin_top 	  = (height_window - height_conta) / 2;
		}

		$(".options_home_container").css({
			top: margin_top,
		});
	}

	/*Resize*/
	$(window).resize(function(){
		position_top();
	});

	/*Slider*/
	$(".slides_container").backgroundCycle({
        imageUrls: parameters.images,
        fadeSpeed: 2000,
        duration: 5000,
        backgroundSize: SCALING_MODE_COVER
    });
});