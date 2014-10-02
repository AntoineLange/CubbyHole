<?php
if(isset($_GET['idPlan'])) { ?>
	<form enctype="multipart/form-data" class="form-horizontal" method="post">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputName">Nom</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" name="inputName" value='<?php echo $lePlan->getName(); ?>'/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputDuration">Durée (jours)</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" name="inputDuration" value='<?php echo $lePlan->getDuration(); ?>'/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputStorageSpace">Stockage (Mo)</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" name="inputStorageSpace" value='<?php echo $lePlan->getStorageSpace(); ?>'/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputBandwidth">Bande passante (Go)</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" name="inputBandwidth" value='<?php echo $lePlan->getBandwidth(); ?>'/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="inputDailyTransferQuota">Transfert journalier (Mo)</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" name="inputDailyTransferQuota" value='<?php echo $lePlan->getDailyTransferQuota(); ?>'/>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-3">
				<button type="submit" class="btn btn-primary">Modifier</button>
			</div>
		</div>
	</form>
<?php
} else { ?>
	<div class="alert alert-danger"><strong>Erreur</strong> Aucun plan choisi !</div>
<?php } ?>