<?php
get_header(); ?>

<div class="slides_container">
</div>

<div class="options_home_container">
    <div class="logo">
    </div>
    <div class="description">
        <?php echo get_option("rm_home_description");?>
    </div>
    <div class="options">

        <div class="option matchheight">
            <div class="container_title">
                <div class="icon">
                </div>
                <div class="title">
                    <h1><?php _e("red médica","network_doctors");?></h1>
                    <h2><?php _e("mapfre global","network_doctors");?></h2>
                </div>
            </div>
            <div class="text">
                <?php echo get_option("rm_text_home_global");?>
            </div>
            <div class="buttons">
                <a href="<?php echo get_permalink(2);?>">
                    <?php _e("ingresar a global","network_doctors");?>
                </a>
                <a href="<?php echo get_permalink(25);?>">
                    <?php _e("aprende sobre la red","network_doctors");?>
                </a>
            </div>
        </div>

        <div class="option matchheight">
            <div class="container_title">
                <div class="icon">
                </div>
                <div class="title">
                    <h1><?php _e("red médica","network_doctors");?></h1>
                    <h2><?php _e("mapfre plus","network_doctors");?></h2>
                </div>
            </div>
            <div class="text">
                <?php echo get_option("rm_text_home_plus");?>
            </div>
            <div class="buttons">
                <a href="<?php echo get_permalink(16);?>">
                    <?php _e("ingresar a plus","network_doctors");?>
                </a>
            </div>
        </div>

    </div>
</div>
<?php get_footer(); ?>