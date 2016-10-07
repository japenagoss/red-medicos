jQuery(document).ready(function($){
	/*
	 * Call data using ajax 
	 */
	function load_data(element,id){
		
		var data 	= "",
			network = $("#network").val();
		
		if(element=="specialty"){
			data = "frontend=1,&element="+element+"&action=frontend&id="+id+"&network="+network;
		}
		else if(element=="location"){
			data = "frontend=1,&element="+element+"&action=frontend&id="+id;
		}
		else if(element=="clinic"){
			data = "frontend=1,&element="+element+"&action=frontend&id="+id+"&spe="+$("select[name='specialty']").val();
		}
		else if(element=="doctor"){
			data = "frontend=1,&element="+element+"&action=frontend&id="+id+"&spe="+$("select[name='specialty']").val();
		}
		
		$.ajax({
			type: "POST",
			url:parameter.url+"/wp-admin/admin-ajax.php",
			data:data,
			dataType: "json",
			success:function(resp){
				if(resp.error==true){
					alert(resp.message);
					$("select[name='"+element+"']").html("");
				}
				else{
					var html = "<option></option>";
					if(resp.data.length == 0){
						alert("No hay datos");
					}
					else{
						for(i=0;i<resp.data.length;i++){
							if(element!="doctor"){
								html += "<option value='"+resp.data[i].id+"'>"+resp.data[i].name+"</option>";
							}
							else{
								html += "<option value='"+resp.data[i].id+"'>"+resp.data[i].name+" "+resp.data[i].last_name+"</option>";
							}
						}
						
						$("select[name='"+element+"']").html(html);
					}
				}
			}
		});
	}
	
	/*Load specialties*/
	load_data("specialty",0);
	
	/*Load locations*/
	$("select[name='specialty']").change(function(){
		if(!$(this).val()==""){
			
			$("select[name='location']").html("");
			$("select[name='clinic']").html("");
			$("select[name='doctor']").html("");
			
			load_data("location",$(this).val());
		}
	});
	
	/*Load clinics*/
	$("select[name='location']").change(function(){
		if(!$(this).val()==""){
			
			$("select[name='clinic']").html("");
			$("select[name='doctor']").html("");
			
			load_data("clinic",$(this).val());
		}
	});
	
	/*Load doctors*/
	$("select[name='clinic']").change(function(){
		if(!$(this).val()==""){
			
			$("select[name='doctor']").html("");
			
			load_data("doctor",$(this).val());
		}	
	});
	
	/*
	 * Consultar centers
	 */
	$(".button-submit").click(function(){
		if($("select[name='specialty']").val()==""){
			alert("El campo especialidad es obligatorio.");
		}
		else{
			$("#rm-form").submit();
		}
	});
	
	/*
	 * Print
	 */
	$(".button_print").click(function(){
		window.print();
   	 	return false;
	});
	
	/*
	 * Scroll animate 
	 */
	$(".pint-dwon-head").click(function(){
		var anchor = $(".container-animate");
		$('html, body').animate({
            scrollTop: $(anchor).offset().top
        }, 1000);
	});
	
	
});

/*
 * Heade resize
 */
jQuery(window).load(function(){
	
	var head_height 		= jQuery(".red-medicos-head").height(),
		content_head	 	= jQuery(".content-head-red-medicos"),
		content_head_height = content_head.height();
		
		if(head_height > content_head_height){
			content_head.css({"margin-top":(head_height - content_head_height)/2}).removeClass("content-head-red-medicos-padding");;
		}
		
		jQuery(window).resize(function(){
			head_height 		= jQuery(".red-medicos-head").height();
			content_head	 	= jQuery(".content-head-red-medicos"),
			content_head_height = content_head.height();
			
			if(head_height > content_head_height){
				content_head.css({"margin-top":(head_height - content_head_height)/2}).removeClass("content-head-red-medicos-padding");
			}
		});
});

function goBack(){
    history.back();
}



