<?php
	$tab1 =(!isset($_GET["tab"]))?"nav-tab-active":""; 
	$tab2 =(isset($_GET["tab"]) && $_GET["tab"]==2)?"nav-tab-active":"";
	$tab3 =(isset($_GET["tab"]) && $_GET["tab"]==3)?"nav-tab-active":"";
	$tab4 =(isset($_GET["tab"]) && $_GET["tab"]==4)?"nav-tab-active":"";
	$tab5 =(isset($_GET["tab"]) && $_GET["tab"]==5)?"nav-tab-active":"";
?>

<?php 
	if($network == 1):
		$page_action  	= "rm-global";
		$tab_title_espe = __("Médico primarios","network_doctors");
	elseif($network == 2):
		$page_action  = "rm-plus";
		$tab_title_espe = __("Especialidades","network_doctors");
	endif;
?>

<div class="admin-page-framework-page-heading-tab">
	<h2 class="nav-tab-wrapper">
		<a class="nav-tab <?php echo $tab1;?>" href="?page=<?php echo $page_action;?>"><?php echo $tab_title_espe;?></a>
		<a class="nav-tab <?php echo $tab2;?>" href="?page=<?php echo $page_action;?>&tab=2"><?php _e("Localizaciones","network_doctors");?></a>
		<a class="nav-tab <?php echo $tab3;?>" href="?page=<?php echo $page_action;?>&tab=3"><?php _e("Clínicas","network_doctors");?></a>
		<a class="nav-tab <?php echo $tab4;?>" href="?page=<?php echo $page_action;?>&tab=4"><?php _e("Doctores","network_doctors");?></a>
	</h2>
</div>