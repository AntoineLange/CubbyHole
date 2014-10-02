<?php
//Si le pseudo et le mot de passe ont été posté
if(isset($_POST['pseudo']) and isset($_POST['password'])) {
	if(!empty($_POST['pseudo']) and !empty($_POST['password'])) {
		//On charge les users
		$lesUsers = DAO_user::LoadAll();
		$pseudo = "0";
		$password ="0";
		//Pour chaque user
		foreach ($lesUsers->getAll() as $k => $v) {
			//Si le pseudo correspond a celui envoyé
			if($_POST['pseudo'] == $v->getPseudo()) {
				$pseudo = $v->getPseudo();
				//Si le mot de passe correspond à celui envoyé
				if(md5($_POST['password']) == $v->getPassword()) {
					$password = $v->getPassword();
					//Si c'est le super admin
					if($v->getIdPlan() == '4') {
						$_SESSION['admin'] = $v->getPseudo();
						$_SESSION['idAdmin'] = $v->getIdUser();
						header("location: index.php?page=dashboard");
					//On créer les variables de session
					} else {
						$_SESSION['user'] = $v->getPseudo();
						$_SESSION['idUser'] = $v->getIdUser();
						header("location: index.php?page=accueil");
					}
				}
			}
		}
		//redirections
		if($pseudo == $_POST['pseudo'] && $password != md5($_POST['password'])) {
			?><div class="alert alert-danger" style="margin: 10px;">Mauvais mot de passe</div><?php
			include_once("./view/V_Home.php");
		}
		elseif($pseudo != $_POST['pseudo']){
			?><div class="alert alert-danger" style="margin: 10px;">Pseudo inconnue</div><?php
			include_once("./view/V_Home.php");
		}
	}
	else {
		?><div class="alert alert-danger" style="margin: 10px;">Des champs sont vides</div><?php
		include_once("./view/V_Accueil.php");
	}
}
else {
	include_once("./view/V_Accueil.php");
}
?>