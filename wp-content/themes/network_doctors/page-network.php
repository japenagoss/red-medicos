<?php
/**
 * Template Name: Networks doctors
 */ 
get_header(); 
$network = $wp_query->query_vars["pagename"];

if($network == "global"){
	$title_espe = __("Médico primario","network_doctors");
}
elseif($network == "plus"){
	$title_espe = __("Especialidad","network_doctors");
}

?>
	
	<?php if(!isset($_GET["download-files"])):?>
	
		<div class="red-medicos-info lato-regular">
			<p>
				<?php echo esc_attr(get_option('rm_'.$network.'_text_body') ); ?>
			</p>
			<a href="?download-files" class="btn-download-files"><?php _e("Descargar Archivos","network_doctors");?></a>
		</div>

		<?php if(!isset($_POST["action"]) && !isset($_POST["search"])):?>

			<div id="container-red-medi-form" class="container-animate">	
				
				<form action="" id="rm-form" method="post">
					<div class="red-medicos-container-selects">
						<div class="red-medicos-selects">

							<div class="div-selects">
								<div class="icon-div-select">
									<img src="<?php echo URL_NETWORK_DOCTORS;?>/images/icon-especialidad.png" align="middle"/>
								</div>
								<div class="text-filter-div-select">
									<h3 class="lato-bold">
										<?php echo $title_espe;?>
									</h3>
									<p class="lato-regular">
										<?php echo esc_attr(get_option('rm_'.$network.'_text_specialty'));?>
									</p>
									<select name="specialty" class="lato-regular">
									</select>
								</div>
							</div>
							<div class="div-selects">
								<div class="icon-div-select">
									<img src="<?php echo URL_NETWORK_DOCTORS;?>/images/icon-localizacion.png" align="middle"/>
								</div>
								<div class="text-filter-div-select">
									<h3 class="lato-bold">
										<?php _e("Localización","network_doctors");?>
									</h3>
									<p class="lato-regular">
										<?php echo esc_attr(get_option('rm_'.$network.'_text_location') ); ?>
									</p>
									<select name="location" class="lato-regular">
									</select>
								</div>
							</div>
							<div class="div-selects">
								<div class="icon-div-select">
									<img src="<?php echo URL_NETWORK_DOCTORS;?>/images/icon-clinica.png" align="middle"/>
								</div>
								<div class="text-filter-div-select">
									<h3 class="lato-bold">
										<?php _e("Hospital / Clínica","network_doctors");?>
									</h3>
									<p class="lato-regular">
										<?php echo esc_attr( get_option('rm_'.$network.'_text_clinic')); ?>
									</p>
									<select name="clinic" class="lato-regular">
									</select>
								</div>
							</div>
							<div class="div-selects">
								<div class="icon-div-select">
									<img src="<?php echo URL_NETWORK_DOCTORS;?>/images/icon-doctor.png" align="middle"/>
								</div>
								<div class="text-filter-div-select">
									<h3 class="lato-bold">
										<?php _e("Nombre / Doctor","network_doctors");?>
									</h3>
									<p class="lato-regular">
										<?php echo esc_attr(get_option('rm_'.$network.'_text_doctor'));?>
									</p>
									<select name="doctor" class="lato-regular">
									</select>
								</div>
							</div>
							<div class="div-selects">
								<input type="hidden" name="action" value="list-red-medicos" />
								<div class="button-submit lato-bold"><?php _e("Consultar","network_doctors");?></div>
							</div>
						</div>
					</div>
				</form>
			</div>

		<?php endif;?>
		
		<?php rm_list();?>

	<?php endif;?>
	
	<!-- GET DOWNLOAD FILES -->
	<?php if(isset($_GET["download-files"])):?>

		<?php 
		 	if($network == "global"){
		 		$network = 1;
		 	}
		 	elseif($network == "plus"){
		 		$network = 2;
		 	}
		?>
		
		<?php
			$files_args = array(
			   'post_type' 		=> 'rm_files',
			   'order' 			=> 'DESC',
			   'posts_per_page'	=> -1,
			   'meta_query' => array(
					array(
						'key'     => 'network',
						'value'   => $network
					)
				)
		   );
			
			$files = new WP_Query($files_args); 
		?>
		
		<div class="buttons-actions-list-red-medicos one-button">
			<div onclick="goBack()">
				<div class="button_back" title="Volver"></div>
			</div>
		</div>
		
		<table class="table-resu-red-medicos lato-regular container-animate">
			<thead>
				<tr>
					<th><?php _e("Nombre del archivo","network_doctors");?></th>
					<th><?php _e("Fecha","network_doctors");?></th>
					<th><?php _e("Descargar","network_doctors");?></th>
				</tr>
			</thead>
			<tbody>
			<?php while ( $files->have_posts() ) : $files->the_post();?>
				
				<tr>
					<td><?php the_title();?></td>
					<td><?php the_date();?></td>
					<td>
						<a target="_blank" class="btn-download-files" href="<?php echo get_field("file");?>">
							<?php _e("Descargar","network_doctors");?>
						</a>
					</td>
				</tr>
				
			<?php endwhile;?>
			</tbody>
		</table>
	
	<?php endif;?>

<?php get_footer(); ?>