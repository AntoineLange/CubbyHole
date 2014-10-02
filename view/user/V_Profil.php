<div class="container" style="margin-top : 100px;">
	<h2>Profil :</h2>
	<table class="table">
		<thead>
	<tr>
		<th>ID</th>
		<th>Pseudo</th>
		<th>Email</th>
		<th>Date d'enregistrement</th>
		<th>Plan</th>
	</tr>
	</thead>
		<tbody>
			<tr>
				<td><?php echo $leUser->getIdUser(); ?></td>
				<td><?php echo $leUser->getPseudo(); ?></td>
				<td><?php echo $leUser->getEmail(); ?></td>
				<td><?php echo DateToFRDate($leUser->getRegistrationDate()); ?></td>
				<td><?php echo strtoupper($lePlan->getName()); ?></td>
			</tr>
		</tbody>
	</table>

	<h3>Changer de plan :</h3>
	<form class="form-horizontal" method="post" action="">
		<div class="form-group">
			<label class="col-sm-2 control-label">Nom du plan</label>
			<div class="col-sm-2">
				<select class="form-control" name="newPlan">
				<?php foreach($lesPlans->getAll() as $unPlan) { ?>
				  <option value="<?php echo $unPlan->getIdPlan(); ?>"><?php echo strtoupper($unPlan->getName()); ?></option>
				<?php } ?>
			</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 col-sm-offset-2">
				<button type="submit" class="btn btn-primary">Modifier</button>
			</div>
		</div>
	</form>

	<h3>Stockage :</h3>
	<p>Stockage actuel : <?php echo $dirsizeMB; ?></p>
	<p>Stockage possible avec le plan <?php echo $lePlan->getName(); ?> : <?php echo $lePlan->getStorageSpace(); ?> MB</p>
	<p>Utilisation de l'espace possible : </p>
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $spacePercentage.'%' ?>;">
		<?php echo $spacePercentage.' %'; ?>
		</div>
	</div>
</div>