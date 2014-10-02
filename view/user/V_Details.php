<script type="text/javascript">
	var sessIdUser = '<?php echo $_SESSION['idUser']; ?>';
	$(document).ready( function() {
		jQuery('#fileManager').fileManager({ script: 'lib/fileManager.php' });
	});
</script>
<div id="fileManager"></div>