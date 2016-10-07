<?php 
/**
 * Add admin options in wordpress's menu
 * admin de wordpress 
 * @author Jhony Penagos
 */
if(is_admin()):

    /*
     * Hooks for show menus and settings pages 
     */
    add_action('admin_menu', 'rm_create_index_menu');
    add_action('admin_menu', 'rm_sub_menu_global_page');
    add_action('admin_menu', 'rm_sub_menu_plus_page');
    add_action('admin_enqueue_scripts', 'rm_load_admin_styles_scripts'); 
 
    function rm_create_index_menu() {
        add_menu_page(
            __('Red de médicos','network_doctors'), 
            __('Red de médicos','network_doctors'), 
            'administrator', 
            "network-doctors", 
            'rm_settings_index_page', 
            URL_NETWORK_DOCTORS.'/images/icon-red-medicos-16.png'
        );
        
    }
    
    /*
     * Index menu for rm
     */
    function rm_settings_index_page(){
        include DIR_NETWORK_DOCTORS."/pages/settings.php";
    }

    /*
     * Index sub menu for global
     */
    function rm_sub_menu_global_page(){
        add_submenu_page(
            'network-doctors', 
            __('Red Médica Mapfre Global','network_doctors'), 
            __('Red Médica Mapfre global','network_doctors'), 
            'manage_options', 
            'rm-global', 
            'rm_global_page'
        );
    }

    /*
     * Page for global
     */
    function rm_global_page(){

        echo "<h1>".__("RED MÉDICA MAPFRE GLOBAL","network_doctors")."</h1>";
        echo "<br/>";
        
        $network = 1;

        include DIR_NETWORK_DOCTORS."/model/class-form.php";
        include DIR_NETWORK_DOCTORS."/controllers/clinic.php";
        include DIR_NETWORK_DOCTORS."/controllers/specialty.php";
        include DIR_NETWORK_DOCTORS."/controllers/location.php";
        include DIR_NETWORK_DOCTORS."/controllers/doctor.php";
        include DIR_NETWORK_DOCTORS."/tabs.php";
        include DIR_NETWORK_DOCTORS."/pages.php";
    }

    /*
     * Index sub menu for plus
     */
    function rm_sub_menu_plus_page(){
        add_submenu_page(
            'network-doctors', 
            __('Red Médica Mapfre Global Plus','network_doctors'), 
            __('Red Médica Mapfre Global Plus','network_doctors'), 
            'manage_options', 
            'rm-plus', 
            'rm_plus_page'
        );
    }

    /*
     * Page for plus
     */
    function rm_plus_page(){
        echo "<h1>".__("RED MÉDICA MAPFRE GLOBAL PLUS","network_doctors")."</h1>";
        echo "<br/>";
        
        $network = 2;

        include DIR_NETWORK_DOCTORS."/model/class-form.php";
        include DIR_NETWORK_DOCTORS."/controllers/clinic.php";
        include DIR_NETWORK_DOCTORS."/controllers/specialty.php";
        include DIR_NETWORK_DOCTORS."/controllers/location.php";
        include DIR_NETWORK_DOCTORS."/controllers/doctor.php";
        include DIR_NETWORK_DOCTORS."/tabs.php";
        include DIR_NETWORK_DOCTORS."/pages.php";
    }

    /*
     * Load styles and js scripts
     */
    function rm_load_admin_styles_scripts(){
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('datatable', URL_NETWORK_DOCTORS.'/js/datatable/jquery.dataTables.min.js',array('jquery'),'1.10.2',false);
        wp_enqueue_script('custom-network-doctors', URL_NETWORK_DOCTORS.'/js/custom.js',array('jquery','jquery-ui-tabs'),'1.10.2',false);
        
        wp_enqueue_style('datatable-style',URL_NETWORK_DOCTORS."/css/datatable/jquery.dataTables.min.css");
        wp_enqueue_style('style-network-doctors',URL_NETWORK_DOCTORS."/css/style.css");
        wp_enqueue_style('ui-style',"//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css");
    }

endif;   




