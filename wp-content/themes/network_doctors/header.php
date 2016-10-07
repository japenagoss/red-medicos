<?php
/**
 * The template for displaying the header
 *
 * @package Wordpress
 * @subpackage network_doctors
 * @since  Red de médicos 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
    <?php
    $network = $wp_query->query_vars["pagename"]; 
    
    if(is_page(25)){
        $network = "global";
    }

    ?>
</head>
<body <?php body_class(); ?>>
    
    <?php if(!is_home()):?>
        
        <div class="red-medicos-top-bar">
            <div class="logo-mapfre-head">
                <a href="<?php echo get_site_url();?>">
                    <img src="<?php echo URL_NETWORK_DOCTORS."/images/logo-mapfre-Red-de-Medicos.png";?>" />
                </a>
            </div>
            <div class="red-medicos-form-top-bar">
                <form method="post" action="<?php echo get_site_url()."/".$network;?>">
                    <label class="lato-regular"><?php _e("Buscar:","network_doctors");?></label>
                    <input type="text" name="red-medicos-value-search" id="red-medicos-value-search" />
                    <input type="hidden" name="search" />
                    <input type="hidden" id="network" name="network" value="<?php echo $network;?>">
                    <input type="submit" value=" " class="red-medicos-form-top-submit" />
                </form>
            </div>
        </div>
    
        <?php if(!is_page(25)):?>
            <div class="red-medicos-head" style="background-image: url(<?php echo esc_attr(get_option('rm_'.$network.'_head_image')); ?>);">
                <div class="content-head-red-medicos">
                    <div class="red-medicos-logo">
                        <img src="<?php echo esc_attr(get_option('rm_'.$network.'_head_logo'));?>" />
                    </div>
                    <h2 class="lato-regular"><?php echo esc_attr( get_option('rm_'.$network.'_title_header') ); ?></h2>
                    <p class="lato-regular">
                        <?php echo esc_attr( get_option('rm_'.$network.'_text_head') ); ?>
                    </p>
                    <div class="pint-dwon-head">
                        <img src="<?php echo URL_NETWORK_DOCTORS."/images/point-dwon.png";?>" />
                    </div>
                </div>
            </div>
        <?php endif;?>
    <?php endif;?>