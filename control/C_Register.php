<?php
if(isset($_GET['plan']) and !empty($_GET['plan'])) {
	$lePlan = strtoupper($_GET['plan']);
} else {
	header("Location: index.php");
}

//Si le formulaire d'inscription à été posté
if(isset($_POST['pseudo']) and isset($_POST['password']) and isset($_POST['password2']) and isset($_POST['email'])) {
	if(!empty($_POST['pseudo']) and !empty($_POST['password']) and !empty($_POST['password2']) and !empty($_POST['email'])) {
		if($_POST['password'] != $_POST['password2']) { ?>
			<div class="alert alert-danger" style="margin: 10px;">Password are not the same</div>
			<script language="JavaScript">setTimeout("javascript:history.back()",2000);</script><?php
		} else {
			$today = date("m-d-y");
			if($lePlan == "BUSINESS") { 
				$idPlan = 3; 
			}
			elseif($lePlan == "PRO") { 
				$idPlan = 2;
			}
			else {
				$idPlan = 1;
			}
			//Ajout du user dans la base de données
			$leUser = new user(null, $_POST['pseudo'], md5($_POST['password']), $_POST['email'], $today, $idPlan);
			$ajout_user = DAO_user::Insert($leUser);

			//Création du dossier de stockage pour l'utilisateur
			$newUser = DAO_user::LoadByPseudo($leUser->getPseudo());
			$idNewUser = $newUser->getIdUser();
			$dossierUser = mkdir('documents/'.$idNewUser);

			//redirections
			if(!$ajout_user) { ?>
				<div class="alert alert-danger" style="margin: 30px 150px;">Erreur</div>
				<?php exit;
			}
			else {
				if($lePlan == "BASIC") { ?>
					<div class="alert alert-success" style="margin: 30px 150px;">Vous êtes enregistré !<br/>Redirection vers la page d'accueil</div>
					<script language="JavaScript">setTimeout("window.location.href='index.php'", 2000);</script><?php
				} else { ?>
					<div class="alert alert-success" style="margin: 30px 150px;">Vous êtes enregistré !<br/>Redirection vers la page de paiement</div>
					<script language="JavaScript">setTimeout("window.location.href='index.php?page=paypal'", 2000);</script><?php
				}
			}
		}
	}
	else {
		?><!--<div class="alert alert-danger" style="margin: 10px;">Empty field !</div>--><?php
		include_once("./view/V_Register.php");
	}
}
else {
	include_once("./view/V_Register.php");
}