<script type="text/javascript">
	var sessIdUser = '<?php echo $_SESSION['idUser']; ?>';
	$(document).ready( function() {
		jQuery('#fileManagerShare').fileManagerShare({ script: 'lib/fileManagerShare.php' });
	});
</script>
<div id="fileManagerShare"></div>