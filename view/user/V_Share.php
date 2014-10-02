<div class="container" style="margin-top : 100px;">
	<h2>Liste des utilisateurs :</h2>
	<table class="table table-bordered">
	<thead>
		<tr>
			<th>Pseudo</th>
			<th></th>
		</tr>
	</thead>
		<tbody>
			<?php foreach($lesUsers->getAll() as $unUser) {
			if($unUser->getIdUser() < $_SESSION['idUser']) {
				$testDir = $unUser->getIdUser().'_'.$_SESSION['idUser'];
			} else {
				$testDir = $_SESSION['idUser'].'_'.$unUser->getIdUser();
			}
			if(file_exists('documents\\'.$testDir)) {
				$retour = '<a href="index.php?page=shareFiles&idUser='.$unUser->getIdUser().'">Partager avec cet utilisateur</a>';
			} else {
				$retour = '<a href="index.php?page=shareFiles&idUser='.$unUser->getIdUser().'">Commencer à partager avec cet utilisateur</a>';
			}
			if($unUser->getIdUser() == $_SESSION['idUser']) {
				$retour = '';
			} ?>
			<tr>
				<td><?php echo $unUser->getPseudo(); ?></td>
				<td><?php echo $retour; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>