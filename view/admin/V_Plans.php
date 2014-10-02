<table class="table table-striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Durée (jours)</th>
			<th>Stockage (Mo)</th>
			<th>Bande passante (Go)</th>
			<th>Transfert journalier (Mo)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($lesPlans->getAll() as $lePlan) { ?>
		<tr>
			<td><?php echo $lePlan->getName(); ?></td>
			<td><?php echo $lePlan->getDuration(); ?></td>
			<td><?php echo $lePlan->getStorageSpace(); ?></td>
			<td><?php echo $lePlan->getBandwidth(); ?></td>
			<td><?php echo $lePlan->getDailyTransferQuota(); ?></td>
			<th><a href="index.php?page=dashboard&display=updatePlan&idPlan=<?php echo $lePlan->getIdPlan(); ?>">Modifier</a>
		</tr>
	<?php } ?>
	</tbody>
</table>