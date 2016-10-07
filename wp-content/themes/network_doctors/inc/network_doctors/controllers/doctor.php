<?php 
if(isset($_GET["draw"])){
	$table 		= 'wp_doctor';
	$primaryKey = 'id';
	$columns 	= array(
	    array( 'db' => 'id', 		  'dt' => 0 ),
	    array( 'db' => 'name',  	  'dt' => 1 ),
	    array( 'db' => 'last_name',   'dt' => 2 ),
	    array( 'db' => 'phone_number','dt' => 3 )
	);
	
	include '../model/request.php';
}

if(!isset($_GET["draw"])){

	if((isset($_POST["entity"]) && $_POST["entity"]=="doctor") || (isset($_GET["entity"]) && $_GET["entity"]=="doctor")):
	
		global $wpdb;

		/*
		 * Save a doctor
		 */
		if($_POST["action"]=="save"){

			if($_POST["action"]=="save"){
				
				$reply = $wpdb->insert(
	                $wpdb->prefix."doctor", 
	                array( 
	                    'name'      	=> trim($_POST["name"]), 
	                    'last_name'     => trim($_POST["last_name"]), 
	                    'phone_number'  => trim($_POST["phone_number"]), 
	                    'network'   	=> trim($_POST["network"]),
	                    'active'    	=> 1
	                ), 
	                array( 
	                    '%s', 
	                    '%s',
	                    '%s',
	                    '%d',
	                    '%d'
	                ) 
	            );  

				$id	= $wpdb->insert_id;
			
				if($reply !== false){
					if(count($_POST["specialty"])>0){
						foreach ($_POST["specialty"] as $key => $value) {
							$wpdb->insert(
				                $wpdb->prefix."doctor_specialty", 
				                array( 
				                    'doctor'      	=> $id, 
				                    'specialty'     => $value
				                ), 
				                array( 
				                    '%d',
				                    '%d'
				                ) 
				            );  
						}
											
					}
					
					if(count($_POST["clinic"])>0){
						foreach ($_POST["clinic"] as $key => $value) {
							$wpdb->insert(
				                $wpdb->prefix."doctor_clinic", 
				                array( 
				                    'doctor'     => $id, 
				                    'clinic'     => $value
				                ), 
				                array( 
				                    '%d',
				                    '%d'
				                ) 
				            );  
						}
					}
				}

				if(!$reply){
	                echo '<div class="error is-dismissible">';
	                echo '<p>'.__('Hay un error guardando el doctor','network_doctors').'</p>';
	                echo '</div>';
	            }
	            else{
	                echo '<div class="updated notice">';
	                echo '<p>'.__('Se guardó con éxito el doctor','network_doctors').'</p>';
	                echo '</div>';
	            }
			}
		}		
		
		/*
		 * Consult a doctor
		 */
		if(isset($_GET["edit"])){
			$doctor = $wpdb->get_row(
                $wpdb->prepare(
                    "select * from ".$wpdb->prefix."doctor where id = %d",
                    $_GET["id"]
                ),
                ARRAY_A
            );

            $clinics = $wpdb->get_results(
                $wpdb->prepare(
                    "select * from ".$wpdb->prefix."doctor_clinic where doctor = %d",
                    $_GET["id"]
                ),
                ARRAY_A
            );

            $specialties = $wpdb->get_results(
                $wpdb->prepare(
                    "select * from ".$wpdb->prefix."doctor_specialty where doctor = %d",
                    $_GET["id"]
                ),
                ARRAY_A
            );
		}
		
		/*
		 * Update a doctor
		 */
		if($_POST["action"]=="update"){
			$active = ($_POST["active"]=="on")?1:0;
			
			$reply = $wpdb->update( 
                $wpdb->prefix."doctor", 
                array( 
                    'name'      	=> $_POST["name"],
                    'last_name'     => $_POST["last_name"],   
                    'phone_number'  => $_POST["phone_number"],
                    'active'    	=> $active   
                ),  
                array('id' => $_POST["id"]),  
                array( 
                    '%s',   
                    '%s',
                    '%s',
                    '%d'    
                ),
                array('%d') 
            );

			$wpdb->delete(
                $wpdb->prefix."doctor_clinic", 
                array('doctor'=> $_POST["id"]), 
                array('%d') 
            );

            $wpdb->delete(
                $wpdb->prefix."doctor_specialty", 
                array('doctor'=> $_POST["id"]), 
                array('%d') 
            );

			if(count($_POST["specialty"])>0){
				foreach ($_POST["specialty"] as $key => $value) {
					$wpdb->insert(
		                $wpdb->prefix."doctor_specialty", 
		                array( 
		                    'doctor'      	=> $_POST["id"], 
		                    'specialty'     => $value
		                ), 
		                array( 
		                    '%d',
		                    '%d'
		                ) 
		            );  
				}
									
			}
			
			if(count($_POST["clinic"])>0){
				foreach ($_POST["clinic"] as $key => $value) {
					$wpdb->insert(
		                $wpdb->prefix."doctor_clinic", 
		                array( 
		                    'doctor'     => $_POST["id"], 
		                    'clinic'     => $value
		                ), 
		                array( 
		                    '%d',
		                    '%d'
		                ) 
		            );
				}
			}

			if($reply === false){
                echo '<div class="error is-dismissible">';
                echo '<p>'.__('Hay un error actualizando el doctor','network_doctors').'</p>';
                echo '</div>';
            }
            else{
                echo '<div class="updated notice">';
                echo '<p>'.__('Se actualizó con éxito el doctor','network_doctors').'</p>';
                echo '</div>';
            }

		}
		
		/*
		 * Delete a doctor 
		 */
		if(isset($_GET["delete"])){
			$delete  = $wpdb->delete(
                $wpdb->prefix."doctor", 
                array('id'=> $_GET["id"]), 
                array('%d') 
            );

			if($delete !== false){
				$wpdb->delete(
	                $wpdb->prefix."doctor_clinic", 
	                array('doctor'=> $_GET["id"]), 
	                array('%d') 
	            );

				$wpdb->delete(
	                $wpdb->prefix."doctor_specialty", 
	                array('doctor'=> $_GET["id"]), 
	                array('%d') 
	            );
			}

			if($reply === false){
                echo '<div class="error is-dismissible">';
                echo '<p>'.__('Hay un error elminando el doctor','network_doctors').'</p>';
                echo '</div>';
            }
            else{
                echo '<div class="updated notice">';
                echo '<p>'.__('Se eliminó con éxito el doctor','network_doctors').'</p>';
                echo '</div>';
            }
			
		}
		
	endif;
}
?>