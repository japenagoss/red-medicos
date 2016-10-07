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
			<a href="#" class="slideudown"><?php _e("Listado de Clínicas","network_doctors");?></a>
			<div class="network-doctors-content">

				<input type="hidden" id="network_id" value="<?php echo $network;?>">
				<input type="hidden" id="entity_type" value="clinic">

				<table id="datatable" class="display" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th><?php _e("ID","network_doctors");?></th>
				            <th><?php _e("NOMBRE","network_doctors");?></th>
				            <th><?php _e("EDITAR","network_doctors");?></th>
				            <th><?php _e("ELIMINAR","network_doctors");?></th>
				        </tr>
				    </thead>
				    <tbody>
				        <tr>
				            <th><?php _e("ID","network_doctors");?></th>
				            <th><?php _e("NOMBRE","network_doctors");?></th>
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
			<a href="#" class="slideudown"><?php _e("Crear Clínica","network_doctors");?></a>
			<div class="network-doctors-content">
				<form action="?page=<?php echo $page_action;?>&tab=3" method="POST">
					<fieldset>
						<h2><?php _e("Crear Clínica","network_doctors");?></h2>
						<p>	
							<label><?php _e("Nombre","network_doctors");?></label>
							<br />
							<input type="text" name="name" />
							<input type="hidden" name="entity" value="clinic" />
							<input type="hidden" name="action" value="save" />
							<input type="hidden" name="network" value="<?php echo $network;?>">
						</p>
						<p>
							<label><?php _e("Localización","network_doctors");?></label>
							<br />
							<?php echo select_locations("select",$network);?>
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

	<?php if(is_array($clinic)):?>
		
		<form action="?page=<?php echo $page_action;?>&tab=3" method="POST">
			<fieldset>
				<h2><?php _e("Editar Clínica","network_doctors");?></h2>
				<p>	
					<label><?php _e("ID","network_doctors");?></label>
					<br>
					<input type="text" name="id" readonly="readonly" value="<?php echo $clinic["id"];?>" />
				</p>
				<p>	
					<label><?php _e("Nombre","network_doctors");?></label>
					<br>
					<input type="text" name="name" value="<?php echo $clinic["name"];?>" />
					<input type="hidden" name="entity" value="clinic" />
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="network" value="<?php echo $network;?>">
				</p>
				<p>
					<label><?php _e("Localización","network_doctors");?></label>
					<br />
					<?php echo select_locations("select",$network,$clinic["location"]);?>
				</p>
				<p>
					<label><?php _e("Activa","network_doctors");?></label>
					<input type="checkbox" name="active" <?php echo ($clinic["active"]==1)?"checked='checked'":"";?> />
				</p>
				<p>	
					<input type="submit" value="<?php _e("Enviar","network_doctors");?>"  />
				</p>
			</fieldset>
		</form>

	<?php else:?>
		<h2><?php _e("No existe una clínica con este ID","network_doctors");?></h2>
	<?php endif;?>
	
<?php endif;?>	