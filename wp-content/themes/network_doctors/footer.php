<?php
$network = $wp_query->query_vars["pagename"]; 
?>
	
<?php if(!is_home()):?>
    <footer class="red-medicos-footer lato-regular">
        <img src="<?php echo URL_NETWORK_DOCTORS;?>/images/logo-Red-de-Medicos.png" width="47" />
        <br />
        <br />
        <?php _e("Copyrigth <b>© MAPFRE PANAMÁ</b> Todos los derechos reservados 2014.","network_doctors");?>
    </footer>   
<?php endif;?>
        
<?php wp_footer(); ?>
</body>
</html>