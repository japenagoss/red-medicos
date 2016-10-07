<?php 
	if($network == 1):
		$page_action  = "rm-global";
	elseif($network == 2):
		$page_action  = "rm-plus";
	endif;
?>

<?php if(!isset($_GET["edit"])):?>

	<ul class="network-doctors-menu">
		<li>
			<a href="#" class="slideudown"><?php _e("Listado de Doctores","network_doctors");?></a>
			<div class="network-doctors-content">

				<input type="hidden" id="network_id" value="<?php echo $network;?>">
				<input type="hidden" id="entity_type" value="doctor">

				<table id="datatable" class="display" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th><?php _e("ID","network_doctors");?></th>
				            <th><?php _e("NOMBRE","network_doctors");?></th>
				            <th><?php _e("APELLIDO","network_doctors");?></th>
				            <th><?php _e("TELÉFONO","network_doctors");?></th>
				            <th><?php _e("EDITAR","network_doctors");?></th>
				            <th><?php _e("ELIMINAR","network_doctors");?></th>
				        </tr>
				        </tr>
				    </thead>
				    <tbody>
				        <tr>
				            <th><?php _e("ID","network_doctors");?></th>
				            <th><?php _e("NOMBRE","network_doctors");?></th>
				            <th><?php _e("APELLIDO","network_doctors");?></th>
				            <th><?php _e("TELÉFONO","network_doctors");?></th>
				            <th><?php _e("EDITAR","network_doctors");?></th>
				            <th><?php _e("ELIMINAR","network_doctors");?></th>
				        </tr>
				    </tbody>
				    <tfoot>
				    </tfoot>
				</table>
			</div>
		</li>
		<li>
			<a href="#" class="slideudown"><?php _e("Crear Doctor","network_doctors");?></a>
			<div class="network-doctors-content">

				<form action="?page=<?php echo $page_action;?>&tab=4" method="POST">
					<fieldset>
						<h2><?php _e("Crear Doctor","network_doctors");?></h2>
						<p>	
							<label><?php _e("Nombre");?></label>
							<br />
							<input type="text" name="name" />
							<input type="hidden" name="entity" value="doctor" />
							<input type="hidden" name="action" value="save" />
							<input type="hidden" name="network" value="<?php echo $network;?>">
						</p>
						<p>	
							<label><?php _e("Apellidos","network_doctors");?></label>
							<br />
							<input type="text" name="last_name" />
						</p>
						<p>	
							<label><?php _e("Teléfono","network_doctors");?></label>
							<br />
							<input type="text" name="phone_number" />
						</p>	
						<p>
							<label><h2><?php _e("Clínicas","network_doctors");?></h2></label>
							<?php echo select_clinics("categories",$network)?>
						</p>
						<br />
						<br />
						<p>
							<label><h2><?php _e("Especialidades","network_doctors");?></2h></label>
							<br />
							<?php echo select_specialties("checkbox",$network)?>
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
	<?php if(is_array($doctor)):?>
		
		<form action="?page=<?php echo $page_action;?>&tab=4" method="POST">
			<fieldset>
				<h2><?php _e("Editar Doctor","network_doctors");?></h2>
				<p>	
					<label><?php _e("ID","network_doctors");?></label>
					<br>
					<input type="text" name="id" readonly="readonly" value="<?php echo $doctor["id"];?>" />
				</p>
				<p>	
					<label><?php _e("Nombre","network_doctors");?></label>
					<br />
					<input type="text" name="name" value="<?php echo $doctor["name"];?>" />
					<input type="hidden" name="entity" value="doctor" />
					<input type="hidden" name="action" value="update" />
				</p>
				<p>	
					<label><?php _e("Apellidos","network_doctors");?></label>
					<br />
					<input type="text" name="last_name" value="<?php echo $doctor["last_name"];?>"/>
				</p>
				<p>	
					<label><?php _e("Teléfono","network_doctors");?></label>
					<br />
					<input type="text" name="phone_number" value="<?php echo $doctor["phone_number"];?>"/>
				</p>	
				<br />
				<br />
				<p>
					<h2><?php _e("CLÍNICAS");?></h2>
					<?php echo select_clinics("categories",$network,$clinics)?>
				</p>
				<br />
				<br />
				<p>
					<h2><?php _e("ESPECIALIDADES");?></h2>
					<?php echo select_specialties("checkbox",$network,$specialties)?>
				</p>
				<p>
					<br />
					<label><?php _e("Activo","network_doctors");?></label>
					<input type="checkbox" name="active" <?php echo ($doctor["active"]==1)?"checked='checked'":"";?> />
					<br />
				</p>
				<p>
					<input type="submit" value="<?php _e("Enviar","network_doctors");?>" />
				</p>
			</fieldset>
		</form>

	<?php else:?>
		<h2><?php _e("No existe un doctor con este ID","network_doctors");?></h2>
	<?php endif;?>
		
<?php endif;?>	