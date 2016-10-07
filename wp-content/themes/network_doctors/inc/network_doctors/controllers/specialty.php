<?php

/*
 * Return data for datatable js
 */
if(isset($_GET["draw"])){
    $table      = 'wp_specialty';
    $primaryKey = 'id';
    $columns    = array(
        array( 'db' => 'id', 'dt' => 0 ),
        array( 'db' => 'name',  'dt' => 1 )
    );
    include '../model/request.php';
}

/*
 * Save data and update data
 */
if(!isset($_GET["draw"])){
    if((isset($_POST["entity"]) && $_POST["entity"]=="specialty") || (isset($_GET["entity"]) && $_GET["entity"]=="specialty")):
        
        global $wpdb;

        /*
         * Save an specialty
         */
        if($_POST["action"]=="save"){
            $reply = $wpdb->insert(
                $wpdb->prefix."specialty", 
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
                echo '<p>'.__('Hay un error guardando la especialidad','network_doctors').'</p>';
                echo '</div>';
            }
            else{
                echo '<div class="updated notice">';
                echo '<p>'.__('Se guardó con éxito la especialidad','network_doctors').'</p>';
                echo '</div>';
            }
        }
        
        /*
         * Consult an specialty
         */
        if(isset($_GET["edit"])){
            $specialty = $wpdb->get_row(
                $wpdb->prepare(
                    "select id,name,active from ".$wpdb->prefix."specialty where id = %d",
                    $_GET["id"]
                ),
                ARRAY_A
            );
        }
        
        /*
         * Update an specialty
         */
        if($_POST["action"]=="update"){
            $active = ($_POST["active"]=="on")?1:0;
           
            $reply = $wpdb->update( 
                $wpdb->prefix."specialty", 
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
                echo '<p>'.__('Hay un error actualizando la especialidad','network_doctors').'</p>';
                echo '</div>';
            }
            else{
                echo '<div class="updated notice">';
                echo '<p>'.__('Se actualizó con éxito la especialidad','network_doctors').'</p>';
                echo '</div>';
            }
        }
        
        /*
         * Delete a specialty
         */
        if(isset($_GET["delete"])){
            $reply = $wpdb->delete(
                $wpdb->prefix."specialty", 
                array('id'=> $_GET["id"]), 
                array('%d') 
            );

            if(!$reply){
                echo '<div class="error is-dismissible">';
                echo '<p>'.__('Hay un error eliminando la especialidad','network_doctors').'</p>';
                echo '</div>';
            }
            else{
                echo '<div class="updated notice">';
                echo '<p>'.__('Se eliminó con éxito la especialidad','network_doctors').'</p>';
                echo '</div>';
            }
        }
        
    endif;
    
    function select_specialties($control,$network,$selecteds = Array()){
        global $wpdb;
        $obje_form      = new Form();

        $specialties = $wpdb->get_results(
            "select * from ".$wpdb->prefix."specialty where active = 1 and network = ".$network."", 
            OBJECT 
        );
        
        switch ($control) {
            case 'checkbox':
                $specialties = $obje_form->checkboxs($specialties,"specialty",$selecteds);
            break;
        }

        return $specialties;
    }
}
?>