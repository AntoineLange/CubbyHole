<table class="table table-striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Nombre d'utilisateur</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($usersByPlan as $v) { ?>
		<tr>
			<td><?php echo $v['name']; ?></td>
			<td><?php echo $v['NBUSER']; ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<br/><br/>
<table class="table table-bordered">
	<tbody>
		<tr><td>Utilisateurs non-payant : <?php echo $freeUsers['NBFREEUSER']; ?></td></tr>
		<tr><td>Utilisateurs payant : <?php echo $paidUsers['NBPAIDUSER']; ?></td></tr>
	</tbody>
</table>
<br/><br/>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Année</th>
			<th>Mois</th>
			<th>Nombre d'utilisateur</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($userByDate as $v) { ?>
		<tr>
			<td><?php echo $v['year']; ?></td>
			<td><?php echo $v['month']; ?></td>
			<td><?php echo $v['total']; ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<br/>
<span>Nombre total d'utilisateurs : <?php echo $totalUser; ?></span>