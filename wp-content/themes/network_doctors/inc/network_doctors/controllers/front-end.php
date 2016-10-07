<?php 
 /*
  * Function for ajax call
  */
function frontend(){

	ob_clean();
    if(isset($_POST["element"])){

    	global $wpdb;
		$reply 		= Array();
		$network 	= 0;
		
		if($_POST["network"] == "global"){
			$network = 1;
		}
		elseif($network == "plus"){
			$network = 2;
		}

		/*GET specialties*/
    	if($_POST["element"]=="specialty"){
			$specialties = $wpdb->get_results(
	            "select * from ".$wpdb->prefix."specialty where active = 1 and network = ".$network."", 
	            OBJECT 
	        );

			if(!empty($specialties)){
				$reply["data"] 	= $specialties;
				$reply["error"]	= false;
			}
			else{
				$reply["error"]		= true;
				$reply["message"]	= __("No hay especialidades","network_doctors");
			}
	   	}
		
		/*GET locations*/
		if($_POST["element"]=="location"){
				
			$specialty 	= (empty($_POST["id"]))? 0 : $_POST["id"];
			
			$query = "select distinct l.id,l.name from ".$wpdb->prefix."specialty as e
				  inner join ".$wpdb->prefix."doctor_specialty as de on e.id = de.specialty 
				  inner join ".$wpdb->prefix."doctor as d on de.doctor = d.id 
				  inner join ".$wpdb->prefix."doctor_clinic as dc on d.id = dc.doctor 
				  inner join ".$wpdb->prefix."clinic as c on dc.clinic = c.id 
				  inner join ".$wpdb->prefix."location as l on c.location = l.id 
				  where e.id = ".$specialty." and e.active = 1 and l.active = 1 
				  and c.active = 1 and d.active order by l.name";		

			$locations = $wpdb->get_results($query);

			if(empty($clinics)){
				$reply["data"] 	= $locations;
				$reply["error"]	= false;
			}
			else{
				$reply["error"]		= true;
				$reply["message"]	= __("No hay localizaciones con esta especialidad","network_doctors");
			}
		}
		
		/*GET clinics*/
		if($_POST["element"]=="clinic"){
				
			$location 	= (empty($_POST["id"]))?0:$_POST["id"];

			$query = "select distinct c.id,c.name from ".$wpdb->prefix."clinic as c 
					inner join ".$wpdb->prefix."doctor_clinic as dc on c.id = dc.clinic 
					inner join ".$wpdb->prefix."doctor as d on dc.doctor = d.id 
					inner join ".$wpdb->prefix."doctor_specialty as de on d.id = de.doctor 
					where de.specialty = ".$_POST["spe"]." and c.active=1 
					and c.location = ".$location." and d.active = 1
					order by c.name";

			$clinics = $wpdb->get_results($query);

			if(!empty($clinics)){
				$reply["data"] 	= $clinics;
				$reply["error"]	= false;
			}
			else{
				$reply["error"]		= true;
				$reply["message"]	= __("No hay Clínicas","network_doctors");
			}
		}
		
		/*GET doctors*/
		if($_POST["element"]=="doctor"){
				
			$clinic = (empty($_POST["id"]))?0:$_POST["id"];

			$query 	= "select distinct d.id,d.name,d.last_name from ".$wpdb->prefix."clinic as c 
						inner join ".$wpdb->prefix."doctor_clinic as dc on c.id = dc.clinic 
						inner join ".$wpdb->prefix."doctor as d on dc.doctor = d.id 
						inner join ".$wpdb->prefix."doctor_specialty as de on d.id = de.doctor 
						where de.specialty = ".$_POST["spe"]." and d.active = 1 
						and c.id=".$_POST["id"]." 
						order by d.name";

			$doctors = $wpdb->get_results($query);

			if(!empty($doctors)){
				$reply["data"] 	= $doctors;
				$reply["error"]	= false;
			}
			else{
				$reply["error"]		= true;
				$reply["message"]	= __("No hay doctores","network_doctors");
			}
		}

		echo json_encode($reply);
    }
    die();
}

add_action('wp_ajax_frontend', 'frontend');
add_action( 'wp_ajax_nopriv_frontend', 'frontend' );

/**
 * Functions for front end
 */
function rm_list(){

	global $wpdb;

	if(isset($_POST["search"])):
		
		$value 		= $_POST["red-medicos-value-search"];
		$network 	= $_POST["network"];

		if($network  == "global"){
			$network = 1;
		}
		elseif($network == "plus"){
			$network = 2;
		}
		
		$query = "select distinct e.name as spec_name, l.name as loca_name,
				c.name as clin_name, d.name as doct_name, d.last_name as doct_lname, 
				d.phone_number from ".$wpdb->prefix."doctor as d inner join 
				".$wpdb->prefix."doctor_specialty as de on d.id = de.doctor 
				inner join ".$wpdb->prefix."specialty as e on de.specialty = e.id 
				inner join ".$wpdb->prefix."doctor_clinic as dc on d.id = dc.doctor 
				inner join ".$wpdb->prefix."clinic as c on dc.clinic = c.id inner join 
				".$wpdb->prefix."location as l on c.location = l.id where d.active = 1 
				and e.active = 1 and c.active = 1 and l.active = 1  and 
				(e.name like '%".$value."%' or d.name like '%".$value."%' or 
				d.last_name like '%".$value."%' or l.name like '%".$value."%' 
				or c.name like '%".$value."%') and e.network =".$network." 
				and l.network =".$network." and c.network =".$network." 
				and d.network =".$network.""; 

		$list = $wpdb->get_results($query);

	?>
		<div class="buttons-actions-list-red-medicos">
			<a href="">
				<div class="button_back" title="<?php _e("Volver","network_doctors");?>"></div>
			</a>
			<a href="<?php echo URL_NETWORK_DOCTORS."/pdf.php?search=".$value."&network=".$network."";?>">
				<div class="button_pdf" title="<?php _e("Descargar PDF","network_doctors");?>"></div>
			</a>	
			<div class="button_print" title="<?php _e("Imprimir","network_doctors");?>"></div>
		</div>
						
		<table class="table-resu-red-medicos lato-regular container-animate">
			<thead>
				<tr>
					<th><?php _e("Especialidad","network_doctors");?></th>
					<th><?php _e("Localización","network_doctors");?></th>
					<th><?php _e("Clínica/Hospital","network_doctors");?></th>
					<th><?php _e("Nombre","network_doctors");?></th>
					<th><?php _e("Apellido","network_doctors");?></th>
					<th><?php _e("Teléfono","network_doctors");?></th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($list)):?>
					<?php foreach ($list as $key => $value):?>
						<tr>
							<td><?php echo $value->spec_name;?></td>
							<td><?php echo $value->loca_name;?></td>
							<td><?php echo $value->clin_name;?></td>
							<td><?php echo $value->doct_name;?></td>
							<td><?php echo $value->doct_lname;?></td>
							<td><?php echo $value->phone_number;?></td>
						</tr>
					<?php endforeach;?>
				<?php endif;?>
			</tbody>
		</table>
	<?php			
	endif;
	
	if(isset($_POST["action"])):
		
		if(empty($_POST["specialty"])){
			echo "<h2 class='error-red-medicos'>".__("El campo especialidad es obligatorio","network_doctors")."</h2>";
		}
		else{
		
			$specialty 	= $_POST["specialty"];
			$location   = $_POST["location"];
			$clinic 	= $_POST["clinic"];
			$doctor 	= $_POST["doctor"];
			$where 		= "";
			
			if(empty($location) && empty($clinic) && empty($doctor)):
				$where = "and e.id = ".$specialty."";
			elseif(empty($clinic) && empty($doctor)):
				$where = "and e.id = ".$specialty." and l.id = ".$location."";
			elseif(empty($doctor)):	
				$where = "and e.id = ".$specialty." and l.id = ".$location." and c.id = ".$clinic."";
			elseif(!empty($location) && !empty($clinic) && !empty($doctor)):	
				$where = "and e.id = ".$specialty." and l.id = ".$location." and c.id = ".$clinic." and d.id = ".$doctor."";
			endif;	
			
			$query = "select e.name as spec_name, l.name as loca_name,
					c.name as clin_name, d.name as doct_name, d.last_name as 
					doct_lname, d.phone_number from ".$wpdb->prefix."doctor as d 
					inner join ".$wpdb->prefix."doctor_specialty as de 
					on d.id = de.doctor inner join ".$wpdb->prefix."specialty as e on de.specialty
					= e.id inner join ".$wpdb->prefix."doctor_clinic as dc on d.id = dc.doctor inner join 
					".$wpdb->prefix."clinic as c on dc.clinic = c.id inner join ".$wpdb->prefix."location 
					as l on c.location = l.id where d.active = 1 and e.active = 1 and 
					c.active = 1 and l.active = 1 ".$where."";	


			$list = $wpdb->get_results($query);
		
			?>
			    <div class="buttons-actions-list-red-medicos">
					<a href="">
						<div class="button_back" title="<?php _e("Volver","network_doctors");?>"></div>
					</a>
					<a href="<?php echo URL_NETWORK_DOCTORS."/pdf.php?specialty=".$specialty."&location=".$location."&clinic=".$clinic."&doctor=".$doctor."";?>">
						<div class="button_pdf" title="<?php _e("Descargar PDF","network_doctors");?>"></div>
					</a>	
					<div class="button_print" title="<?php _e("Imprimir","network_doctors");?>"></div>
				</div>
							
				<table class="table-resu-red-medicos lato-regular container-animate">
					<thead>
						<tr>
							<th><?php _e("Especialidad","network_doctors");?></th>
							<th><?php _e("Localización","network_doctors");?></th>
							<th><?php _e("Clínica/Hospital","network_doctors");?></th>
							<th><?php _e("Nombre","network_doctors");?></th>
							<th><?php _e("Apellido","network_doctors");?></th>
							<th><?php _e("Teléfono","network_doctors");?></th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($list)):?>
							<?php foreach ($list as $key => $value):?>
								<tr>
									<td><?php echo $value->spec_name;?></td>
									<td><?php echo $value->loca_name;?></td>
									<td><?php echo $value->clin_name;?></td>
									<td><?php echo $value->doct_name;?></td>
									<td><?php echo $value->doct_lname;?></td>
									<td><?php echo $value->phone_number;?></td>
								</tr>
							<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			<?php		  
		}
	endif;
}