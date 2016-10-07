<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#datatable').dataTable({
	        "processing": true,
	        "serverSide": true,
	        "ajax": {
	        	"url":"<?php echo URL_NETWORK_DOCTORS;?>/controllers/<?php echo $controller;?>.php",
	        	"data":function(d){
	        		d.network = <?php echo $network;?>
	        	}
	        }
	    });
	});
</script>
