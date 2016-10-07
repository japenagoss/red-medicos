<?php 
	if($network == 1):
		$page_action  = "rm-global";
		$list_name 	  = __("Listado de médicos primarios","network_doctors");
		$create_title = __("Crear médico primario","network_doctors");

	elseif($network == 2):
		$page_action  = "rm-plus";
		$list_name 	  = __("Listado de Especialidades","network_doctors");
		$create_title = __("Crear especialidad","network_doctors");
	endif;
?>

<?php if(!isset($_GET["edit"])):?>
	
	<ul class="network-doctors-menu">
		<li>
			<a href="#" class="slideudown"><?php echo $list_name;?></a>
			<div class="network-doctors-content">
				
				<input type="hidden" id="network_id" value="<?php echo $network;?>">
				<input type="hidden" id="entity_type" value="specialty">

				<table id="datatable" class="display" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th><?php _e("ID","network_doctors");?></th>
				            <th><?php _e("NOMBRE","network_doctors");?></th>
				            <th><?php _e("EDITAR","network_doctors");?></th>
				            <th><?php _e("ELIMINAR","network_doctors");?></th>
				        </tr>
				    </thead>
				    <tfoot>
				        <tr>
				            <th><?php _e("ID","network_doctors");?></th>
				            <th><?php _e("NOMBRE","network_doctors");?></th>
				            <th><?php _e("EDITAR","network_doctors");?></th>
				            <th><?php _e("ELIMINAR","network_doctors");?></th>
				        </tr>
				    </tfoot>
				    <tbody>
				    </tbody>
				</table>

			</div>
		</li>
		
		<li>
			<a href="#" class="slideudown"><?php echo $create_title;?></a>
			<div class="network-doctors-content">
		
				<form action="?page=<?php echo $page_action;?>" method="POST">
					<fieldset>
						<h2><?php echo $create_title;?></h2>
						<p>	
							<label><?php _e("Nombre","network_doctors");?></label>
							<br>
							<input type="text" name="name" />
							<input type="hidden" name="entity" value="specialty" />
							<input type="hidden" name="action" value="save" />
							<input type="hidden" name="network" value="<?php echo $network;?>">
						</p>
						<p>
							<input type="submit" value="<?php _e("Enviar","network_doctors");?>" />
						</p>
					</fieldset>
				</form>
			</div>
		</li>
	</ul>

<?php else:?>
	
	<?php if(is_array($specialty)):?>

		<form action="?page=<?php echo $page_action;?>" method="POST">
			<fieldset>
				<h2><?php _e("Editar especialidad","network_doctors");?></h2>
				<p>	
					<label><?php _e("ID","network_doctors");?></label>
					<br>
					<input type="text" name="id" readonly="readonly" value="<?php echo $specialty["id"];?>" />
				</p>
				<p>	
					<label><?php _e("Nombre","network_doctors");?></label>
					<br>
					<input type="text" name="name" value="<?php echo $specialty["name"];?>" />
					<input type="hidden" name="entity" value="specialty" />
					<input type="hidden" name="action" value="update" />
				</p>
				<p>
					<label><?php _e("Activa","network_doctors");?></label>
					<input type="checkbox" name="active" <?php echo ($specialty["active"]==1)?"checked='checked'":"";?> />
				</p>
				<p>	
					<input type="submit" value="<?php _e("Enviar","network_doctors");?>"  />
				</p>
			</fieldset>
		</form>
		
	<?php else:?>
		<h2><?php _e("No existe una especialidad con este ID","network_doctors");?></h2>
	<?php endif;?>

<?php endif;?>





