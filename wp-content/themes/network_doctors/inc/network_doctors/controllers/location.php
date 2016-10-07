<?php 
/*
 * return locations list 
 */
if(isset($_GET["draw"])){
	$table 		= 'wp_location';
	$primaryKey = 'id';
	$columns 	= array(
	    array( 'db' => 'id', 	'dt' => 0 ),
	    array( 'db' => 'name',  'dt' => 1 )
	);
	
	include '../model/request.php';
}


if(!isset($_GET["draw"])): 
	if((isset($_POST["entity"]) && $_POST["entity"]=="location") || (isset($_GET["entity"]) && $_GET["entity"]=="location")):
		
		global $wpdb;

		/*
		 * Save a location
		 */
		if($_POST["action"]=="save"){
			$reply = $wpdb->insert(
                $wpdb->prefix."location", 
                array( 
                    'name'      => trim($_POST["name"]), 
                    'network'   => trim($_POST["network"]),
                    'active'    => 1
                ), 
                array( 
                    '%s', 
                    '%d',
                    '%d'
                ) 
            );  

            if(!$reply){
                echo '<div class="error is-dismissible">';
                echo '<p>'.__('Hay un error guardando la localización','network_doctors').'</p>';
                echo '</div>';
            }
            else{
                echo '<div class="updated notice">';
                echo '<p>'.__('Se guardó con éxito la localización','network_doctors').'</p>';
                echo '</div>';
            }
		}
		
		/*
		 * Consult a location
		 */
		if(isset($_GET["edit"])){
			$location = $wpdb->get_row(
                $wpdb->prepare(
                    "select id,name,active from ".$wpdb->prefix."location where id = %d",
                    $_GET["id"]
                ),
                ARRAY_A
            );
		}
		
		/*
		 * Update a location
		 */
		if($_POST["action"]=="update"){
			$active = ($_POST["active"]=="on")?1:0;
           
            $reply = $wpdb->update( 
                $wpdb->prefix."location", 
                array( 
                    'name'      => $_POST["name"],  
                    'active'    => $active   
                ),  
                array('id' => $_POST["id"]),  
                array( 
                    '%s',   
                    '%d'    
                ),
                array('%d') 
            );

            if($reply === false){
                echo '<div class="error is-dismissible">';
                echo '<p>'.__('Hay un error actualizando la localización','network_doctors').'</p>';
                echo '</div>';
            }
            else{
                echo '<div class="updated notice">';
                echo '<p>'.__('Se actualizó con éxito la localización','network_doctors').'</p>';
                echo '</div>';
            }
		}
		
		/*
		 * Delete a location
		 */
		if(isset($_GET["delete"])){
			$reply = $wpdb->delete(
                $wpdb->prefix."location", 
                array('id'=> $_GET["id"]), 
                array('%d') 
            );

            if(!$reply){
                echo '<div class="error is-dismissible">';
                echo '<p>'.__('Hay un error eliminando la localización','network_doctors').'</p>';
                echo '</div>';
            }
            else{
                echo '<div class="updated notice">';
                echo '<p>'.__('Se eliminó con éxito la localización','network_doctors').'</p>';
                echo '</div>';
            }
		}
	endif;
	
	function select_locations($control,$network,$selection = ""){
	    global $wpdb;

        $locations = $wpdb->get_results(
            "select * from ".$wpdb->prefix."location where active = 1 and network = ".$network."", 
            OBJECT 
        );

        $obje_form = new Form();

		switch ($control) {
			case 'select':
				$locations 	= $obje_form->select($locations,"location",$selection);
				break;
		}

		return $locations;
	}
	
endif;

?>