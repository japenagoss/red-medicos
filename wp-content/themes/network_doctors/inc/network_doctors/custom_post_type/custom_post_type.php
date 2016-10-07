<?php 
add_action( 'init', 'creat_file_post_type' );
/**
 * Register a rm files post type.
 */
function creat_file_post_type() {
    $labels_files = array(
        'name'               => __( 'Files', 'network_doctors' ),
        'singular_name'      => __( 'File', 'network_doctors' ),
        'menu_name'          => __( 'Files', 'network_doctors' ),
        'name_admin_bar'     => __( 'File', 'network_doctors' ),
        'add_new'            => __( 'Add New', 'network_doctors' ),
        'add_new_item'       => __( 'Add New File', 'network_doctors' ),
        'new_item'           => __( 'New File', 'network_doctors' ),
        'edit_item'          => __( 'Edit File', 'network_doctors' ),
        'view_item'          => __( 'View File', 'network_doctors' ),
        'all_items'          => __( 'All Files', 'network_doctors' ),
        'search_items'       => __( 'Search Files', 'network_doctors' ),
        'parent_item_colon'  => __( 'Parent Files:', 'network_doctors' ),
        'not_found'          => __( 'No files found.', 'network_doctors' ),
        'not_found_in_trash' => __( 'No files found in Trash.', 'network_doctors' )
    );

    $args_files = array(
        'labels'             => $labels_files,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 100,
        'supports'           => array('title'),
        'menu_icon'          => URL_NETWORK_DOCTORS."/images/icon-red-medicos-16.png"
    );

    register_post_type('rm_files', $args_files);

    $labels_slide = array(
        'name'               => __( 'Slides', 'network_doctors' ),
        'singular_name'      => __( 'Slide', 'network_doctors' ),
        'menu_name'          => __( 'Slides', 'network_doctors' ),
        'name_admin_bar'     => __( 'Slide', 'network_doctors' ),
        'add_new'            => __( 'Add New', 'network_doctors' ),
        'add_new_item'       => __( 'Add New Slide', 'network_doctors' ),
        'new_item'           => __( 'New Slide', 'network_doctors' ),
        'edit_item'          => __( 'Edit Slide', 'network_doctors' ),
        'view_item'          => __( 'View Slide', 'network_doctors' ),
        'all_items'          => __( 'All Slides', 'network_doctors' ),
        'search_items'       => __( 'Search Slides', 'network_doctors' ),
        'parent_item_colon'  => __( 'Parent Slides:', 'network_doctors' ),
        'not_found'          => __( 'No slides found.', 'network_doctors' ),
        'not_found_in_trash' => __( 'No slides found in Trash.', 'network_doctors' )
    );

    $args_slide = array(
        'labels'             => $labels_slide,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 90,
        'supports'           => array('title','thumbnail')
    );

    register_post_type('slide_home', $args_slide);
}