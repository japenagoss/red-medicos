<?php
	
	$url 	= (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$uri 	= $_SERVER['REQUEST_URI'];
	$my_url = explode('wp-content' , $uri); 
	$path 	= $_SERVER['DOCUMENT_ROOT']."/".$my_url[0];
	$list 	= "";
	
	include_once $path . '/wp-config.php';
	include_once $path . '/wp-includes/wp-db.php';
	include_once $path . '/wp-includes/pluggable.php';

	global $wpdb;
	
	if(isset($_GET["specialty"])):
		
		$specialty 	= $_GET["specialty"];
		$location   = $_GET["location"];
		$clinic 	= $_GET["clinic"];
		$doctor 	= $_GET["doctor"];

		if(empty($location) && empty($clinic) && empty($doctor)):
			$where = "and e.id = ".$specialty."";
		elseif(empty($clinic) && empty($doctor)):
			$where = "and e.id = ".$specialty." and l.id = ".$location."";
		elseif(empty($doctor)):	
			$where = "and e.id = ".$specialty." and l.id = ".$location." and c.id = ".$clinic."";
		elseif(!empty($location) && !empty($clinic) && !empty($doctor)):	
			$where = "and e.id = ".$specialty." and l.id = ".$location." and c.id = ".$clinic." and d.id = ".$doctor."";
		endif;		
		
		$query = "select e.name as spec_name, l.name as loca_name,
					c.name as clin_name, d.name as doct_name, d.last_name as 
					doct_lname, d.phone_number from ".$wpdb->prefix."doctor as d 
					inner join ".$wpdb->prefix."doctor_specialty as de 
					on d.id = de.doctor inner join ".$wpdb->prefix."specialty as e on de.specialty
					= e.id inner join ".$wpdb->prefix."doctor_clinic as dc on d.id = dc.doctor inner join 
					".$wpdb->prefix."clinic as c on dc.clinic = c.id inner join ".$wpdb->prefix."location 
					as l on c.location = l.id where d.active = 1 and e.active = 1 and 
					c.active = 1 and l.active = 1 ".$where."";

		$list = $wpdb->get_results($query);
		
	endif;
	
	if(!isset($_GET["specialty"])):
		$value 	 = $_GET["search"];
		$network = $_GET["network"];
		
		$query = "select distinct e.name as spec_name, l.name as loca_name,
				c.name as clin_name, d.name as doct_name, d.last_name as doct_lname, 
				d.phone_number from ".$wpdb->prefix."doctor as d inner join 
				".$wpdb->prefix."doctor_specialty as de on d.id = de.doctor 
				inner join ".$wpdb->prefix."specialty as e on de.specialty = e.id 
				inner join ".$wpdb->prefix."doctor_clinic as dc on d.id = dc.doctor 
				inner join ".$wpdb->prefix."clinic as c on dc.clinic = c.id inner join 
				".$wpdb->prefix."location as l on c.location = l.id where d.active = 1 
				and e.active = 1 and c.active = 1 and l.active = 1  and 
				(e.name like '%".$value."%' or d.name like '%".$value."%' or 
				d.last_name like '%".$value."%' or l.name like '%".$value."%' 
				or c.name like '%".$value."%') and e.network =".$network." 
				and l.network =".$network." and c.network =".$network." 
				and d.network =".$network.""; 

		$list = $wpdb->get_results($query); 
	endif;
		
	require('fpdf/fpdf.php');
	require('model/mc_table.php');
	
	$pdf = new PDF_MC_Table();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',14);
	$pdf->SetWidths(array(32,32,36,32,32,30));
	srand(microtime()*1000000);
	
	
	$pdf -> SetFont('Arial', 'B', 16);
	$pdf -> Cell(0, 10, utf8_decode('RED DE MÉDICOS'), 0, 0, "C");
	$pdf -> SetFont('Arial', '', 12);
	$pdf -> Ln(20);
	
	/*--------Head de la tabla---------------*/
	$pdf->Cell(32,7,"Especialidad",1);
	$pdf->Cell(32,7,utf8_decode("Localización"),1);
	$pdf->Cell(36,7,utf8_decode("Clínica/Hospital"),1);
	$pdf->Cell(32,7,"Nombre",1);
	$pdf->Cell(32,7,"Apellido",1);
	$pdf->Cell(30,7,utf8_decode("Teléfono"),1);
	$pdf->Ln();
	
	foreach ($list as $key => $value) {
		$pdf->Row(array(
					utf8_decode($value->spec_name),
					utf8_decode($value->loca_name),
					utf8_decode($value->clin_name),
					utf8_decode($value->doct_name),
					utf8_decode($value->doct_lname),
					utf8_decode($value->phone_number)
				 ));

	}
	
	$pdf->Output("red-medicos.pdf","D");
?>