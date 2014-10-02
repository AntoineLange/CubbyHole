<div class="headerInscription">
	<img src="images/cubbyhole250.png" alt="Cubbyhole" class="logo">
	<h3>Vous avez choisi le plan <?php echo $lePlan; ?></h3>
</div>

<form id="registerForm" method="post" class="form-horizontal" action="">
	<div class="form-group">
		<label class="col-sm-5 control-label">Pseudo</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" name="pseudo" placeholder="Pseudo"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 control-label">Email</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" name="email" placeholder="Email"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 control-label">Password</label>
		<div class="col-sm-2">
			<input type="password" class="form-control" name="password" placeholder="Password" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 control-label">Retype password</label>
		<div class="col-sm-2">
			<input type="password" class="form-control" name="password2" placeholder="Retype password" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 col-sm-offset-5">
			<button type="submit" class="btn btn-primary">Inscription</button>
		</div>
	</div>
</form>

<script type="text/javascript" src="js/formValidate.js"></script>
