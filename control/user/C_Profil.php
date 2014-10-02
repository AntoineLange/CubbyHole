<?php
//On récupère l'utilisateur
$leUser = DAO_user::LoadOne($_SESSION['idUser']);
//L'id du plan du user
$idPlan = $leUser->getIdPlan();
//On charge le plan
$lePlan = DAO_plan::LoadOne($idPlan);
//On charge tous les plans sauf le plan de l'admin
$lesPlans = DAO_plan::LoadAllWithoutAdminPlan();

//On calcul la taille du dossier de l'utilisateur
$dirsizeB = dirsize('documents\\'.$leUser->getIdUser().'\\');
$dirsizeMB = sizeFormat($dirsizeB);

//Le pourcentage par rapport au plan qu'il a souscrit
$spacePercentage = ceil(($dirsizeMB / $lePlan->getStorageSpace())*100);

//S'il le user veut changer de plan
if(isset($_POST) and !empty($_POST)) {
	//On effectue la modification
	$modif_user = new user($leUser->getIdUser(), $leUser->getPseudo(), $leUser->getPassword(), $leUser->getEmail(), $leUser->getRegistrationDate(), $_POST['newPlan']);
	DAO_user::Update($modif_user);

	if(!$modif_user) { ?>
		<div class="alert alert-danger" style="margin: 30px 150px;">Erreur</div>
		<script language="JavaScript">setTimeout("window.location.href='index.php?page=profil'", 2000);</script><?php
	}
	else {
		if($_POST['newPlan'] == 1) { ?>
			<div class="alert alert-success" style="margin: 30px 150px;">Modification effectuée !<br/>Redirection vers la page de profil</div>
			<script language="JavaScript">setTimeout("window.location.href='index.php?page=profil'", 2000);</script><?php
		} else { ?>
			<div class="alert alert-success" style="margin: 30px 150px;">Modification effectuée !<br/>Redirection vers la page de paiement</div>
			<script language="JavaScript">setTimeout("window.location.href='index.php?page=paypal'", 2000);</script><?php
		}
	}
} else {
	include_once("./view/user/V_Profil.php");
}

?>