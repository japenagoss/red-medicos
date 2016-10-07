<?php
define(DIR_NETWORK_DOCTORS,get_template_directory()."/inc/network_doctors"); 
define(URL_NETWORK_DOCTORS,get_bloginfo("template_url")."/inc/network_doctors"); 

/*
 * Includes
 */
include DIR_NETWORK_DOCTORS."/network_doctors.php";
include DIR_NETWORK_DOCTORS.'/controllers/front-end.php';
include DIR_NETWORK_DOCTORS.'/custom_post_type/custom_post_type.php';


/**
 * Proper way to enqueue scripts and styles
 */
function rm_scripts() {
	wp_deregister_script('jquery');
	wp_enqueue_script('rm-jquery', URL_NETWORK_DOCTORS.'/js/jquery-1.11.3.min.js','','1.11.3',false);

	//When it is home page 
	if(is_home()):
		$images = array();

		$args = array(
	        'post_type' => 'slide_home',
	        'orderby'   => 'menu_order',
	        'order'     => 'DESC'
	    );

	    $slides = new WP_Query($args);

	    if($slides->have_posts()):
	        while($slides->have_posts()):$slides->the_post();
	            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full'); 
	            array_push($images, $image[0]);
	        endwhile;
	    endif; 

	    $parameters = array(
			"images" => $images
		);

		wp_enqueue_script('rm-cycle', URL_NETWORK_DOCTORS.'/js/background.cycle.min.js',array('rm-jquery'),'1.0',false);
		wp_enqueue_script('rm-matchheight', URL_NETWORK_DOCTORS.'/js/jquery.matchHeight-min.js',array('rm-jquery'),'1.0',false);
		wp_enqueue_script('rm-home', URL_NETWORK_DOCTORS.'/js/home.js',array('rm-jquery','rm-cycle','rm-matchheight'),'1.0',false);
		wp_localize_script('rm-home', 'parameters',$parameters);
	endif;

	/* When it is not home page */
	if(!is_home()):
		$parameters = array(
			"url" => home_url()
		);
		wp_enqueue_script('rm-frontend', URL_NETWORK_DOCTORS.'/js/frontend.js',array('rm-jquery'),'1.0',false);
		wp_localize_script('rm-frontend', 'parameter',$parameters);
	endif;

	wp_enqueue_style('rm-frontend', URL_NETWORK_DOCTORS.'/css/frontend.css');
	wp_enqueue_style('rm-lato', 'https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic');
	wp_enqueue_style('rm-merriweather', 'https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic');

	if(is_home()):
		wp_enqueue_style('rm-home', URL_NETWORK_DOCTORS.'/css/home.css');
	endif;

}

add_action('wp_enqueue_scripts', 'rm_scripts' );

/**
 * Theme setup
 */
function rm_setup() {
	add_theme_support('post-thumbnails');
	add_editor_style('editor-style.css');
}
add_action('after_setup_theme', 'rm_setup');

/*
 * Filter the title 
 */
function rm_title($title,$sep){
    global $paged, $page;

    if(is_feed())
        return $title;

    $title .= get_bloginfo('name', 'display');

    $site_description = get_bloginfo( 'description', 'display' );

    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'network_doctors' ), max( $paged, $page ) );

    return $title;
}
add_filter('wp_title','rm_title',10,2);