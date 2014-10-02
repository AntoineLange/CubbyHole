<div class="content-wrapper" style="width: 500px;margin:auto;margin-top:250px;">
<h2>Invitez un amis a rejoindre CubbyHole !</h2>
<?php
if(isset($_GET['msg'])) {
	if(isset($_GET) and $_GET['msg'] == 'champvide') { ?>
		<div class="alert alert-danger" style="margin: 10px;">Empty field</div>
	<?php } elseif(isset($_GET) and $_GET['msg'] == 'erreur') { ?>
		<div class="alert alert-danger" style="margin: 10px;">Error</div>
	<?php } elseif(isset($_GET) and $_GET['msg'] == 'envoye') { ?>
		<div class="alert alert-success" style="margin: 10px;">Message sent !</div>
	<?php 
	} 
}
?>
	<form class="form-inline" style="margin-top: 50px;" method="post" action="">
		<input type="text" name="email" class="input-block-level" placeholder="Email" style="width:80%">
		<input type="submit" value="Send invite" class="btn btn-large btn-primary" style="background: #008ce8;margin-right:0;">
	</form>
</div>