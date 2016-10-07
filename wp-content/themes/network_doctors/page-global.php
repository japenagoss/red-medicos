<?php
/**
 * Template Name: Aprender sobre la red Global
 */ 
get_header(); 
?>


<div id="container_learn_more">
	<div class="global_header">
		<div class="center_cont">
			<img src="<?php echo URL_NETWORK_DOCTORS;?>/images/logo-Red-de-Medicos.png" width="47" />
			<h1><?php _e("aprende sobre la red","network_doctors");?></h1>
		</div>
	</div>
	<div class="center_cont global_content">
		<?php 
			while(have_posts()):the_post();
				the_content();
			endwhile;
		?>
	</div>
</div>	


<?php get_footer(); ?>