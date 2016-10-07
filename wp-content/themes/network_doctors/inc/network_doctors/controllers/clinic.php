<?php 
if(isset($_GET["draw"])){
	$table 		= 'wp_clinic';
	$primaryKey = 'id';
	$columns 	= array(
	    array( 'db' => 'id', 'dt' => 0 ),
	    array( 'db' => 'name',  'dt' => 1 )
	);
	
	include '../model/request.php';
}

if(!isset($_GET["draw"])){
		
	if((isset($_POST["entity"]) && $_POST["entity"]=="clinic") || (isset($_GET["entity"]) && $_GET["entity"]=="clinic")):
		
		global $wpdb;

		/*
		 * Save a clinic
		 */
		if($_POST["action"]=="save"){
			$reply = $wpdb->insert(
                $wpdb->prefix."clinic", 
                array( 
                    'name'      => trim($_POST["name"]), 
                    'location'  => trim($_POST["location"]), 
                    'network'   => trim($_POST["network"]),
                    'active'    => 1
                ), 
                array( 
                    '%s', 
                    '%d',
                    '%d',
                    '%d'
                ) 
            );  

            if(!$reply){
                echo '<div class="error is-dismissible">';
                echo '<p>'.__('Hay un error guardando la clínica','network_doctors').'</p>';
                echo '</div>';
            }
            else{
                echo '<div class="updated notice">';
                echo '<p>'.__('Se guardó con éxito la clínica','network_doctors').'</p>';
                echo '</div>';
            }
		}
		
		/*
		 * Consult a clinic
		 */
		if(isset($_GET["edit"])){
			$clinic = $wpdb->get_row(
                $wpdb->prepare(
                    "select id,name,location,active from ".$wpdb->prefix."clinic where id = %d",
                    $_GET["id"]
                ),
                ARRAY_A
            );
		}
		
		/*
		 * Update a clinic
		 */
		if($_POST["action"]=="update"){
			$active = ($_POST["active"]=="on")?1:0;
           
            $reply = $wpdb->update( 
                $wpdb->prefix."clinic", 
                array( 
                    'name'      => $_POST["name"],  
                    'location'  => $_POST["location"],
                    'active'    => $active   
                ),  
                array('id' => $_POST["id"]),  
                array( 
                    '%s',  
                    '%d', 
                    '%d'    
                ),
                array('%d') 
            );

            if($reply === false){
                echo '<div class="error is-dismissible">';
                echo '<p>'.__('Hay un error actualizando la clínica','network_doctors').'</p>';
                echo '</div>';
            }
            else{
                echo '<div class="updated notice">';
                echo '<p>'.__('Se actualizó con éxito la clínica','network_doctors').'</p>';
                echo '</div>';
            }
		}
		
		/*
		 * Delete a clinic
		 */
		if(isset($_GET["delete"])){
			$reply = $wpdb->delete(
                $wpdb->prefix."clinic", 
                array('id'=> $_GET["id"]), 
                array('%d') 
            );

            if(!$reply){
                echo '<div class="error is-dismissible">';
                echo '<p>'.__('Hay un error eliminando la clínica','network_doctors').'</p>';
                echo '</div>';
            }
            else{
                echo '<div class="updated notice">';
                echo '<p>'.__('Se eliminó con éxito la clínica','network_doctors').'</p>';
                echo '</div>';
            }
		}
		
	endif;		
	
	function select_clinics($control,$network,$selecteds = Array()){
        global $wpdb;
		$obje_form = new Form();

		$clinics = $wpdb->get_results(
            "select * from ".$wpdb->prefix."clinic where active = 1 and network = ".$network."", 
            OBJECT 
        );
		
		switch ($control) {
			case 'checkbox':
				$clinics 	= $obje_form->checkboxs($clinics,"clinic",$selecteds);
			break;
			case 'categories':
				$locations = $wpdb->get_results(
                    "select * from ".$wpdb->prefix."location where active = 1 and network = ".$network."", 
                    OBJECT 
                );
				
                $clinics = $obje_form->categories($locations,"clinic","clinic",$selecteds,$network);
			break;	
		}

		return $clinics;
	}
}


?>