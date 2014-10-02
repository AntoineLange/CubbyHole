<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>CubbyHole</title>
		<link rel="shortcut icon" href="images/favicon.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- ############# CSS ############# -->
		<link rel="stylesheet" href="css/bootstrap-3.1.1.css" type="text/css">
		<link rel="stylesheet" href="css/bootstrapValidator.css" type="text/css">
		<link rel="stylesheet" href="css/styles.css" type="text/css">
		<link rel="stylesheet" href="css/jquery-ui.css" type="text/css">
		<!-- Onepage accueil -->
		<link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css" />

		<?php if(isset($_SESSION['admin'])) { ?>
			<link href="css/dashboard.css" rel="stylesheet" type="text/css">
		<?php } ?>
			
		<!-- JS -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<!-- Script Drag & Drop -->
		<!--<script type="text/javascript" src="js/dragAndDrop.js"></script>-->
		<!-- Clic droit -->
		<script src="js/contextMenu.js" type="text/javascript"></script>
		<!--Validation js form -->
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<!-- File manager -->
		<script src="js/fileManager.js" type="text/javascript"></script>
		<script src="js/fileManagerShare.js" type="text/javascript"></script>
		<script src="js/fileManager_lang.js" type="text/javascript"></script>
		<script src="js/fileManager_ext.js" type="text/javascript"></script>
		<!-- Onepage accueil -->
		<script type="text/javascript" src="js/jquery.fullPage.js"></script>
		<!-- Bootstrap JS -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

		<?php if(isset($_SESSION['admin'])) { ?>
			<script src="js/highcharts.js"></script>
			<script src="js/exporting.js"></script>
		<?php } ?>

	</head>
	<body>
		<?php
		//Ajout des classes et fonctions DAO
		require_once("class/Collection.class.php");
		require_once("dao/connection.php");


		require_once("class/user.class.php");
		require_once("class/plan.class.php");

		require_once("dao/DAO_user.class.php");
		require_once("dao/DAO_plan.class.php");

		require_once("lib/functions.php");

		//Pas de sessions
		if(isset($_GET['page']) and !isset($_SESSION['user']) and !isset($_SESSION['admin']))
		{

			switch($_GET['page'])
			{
				// Page d'accueil
				case 'home':
					include_once("control/C_Home.php");
					break;
				
				//Page d'inscription	
				case 'register':
					include_once("control/C_Register.php");
					break;

				//Page de paiement paypal
				case 'paypal':
					include_once("control/C_PaypalRegister.php");
					break;

				//Page de connexion
				case 'login':
					include_once("control/C_Login.php");
					break;

				default:
					include_once("control/C_Home.php");
					break;
			}
		}
		//Session user
		elseif(isset($_GET['page']) and isset($_SESSION['user']))
		{
			//include_once("control/C_Header.php");
			
			switch($_GET['page'])
			{
				case 'accueil':
					include_once("control/user/C_Accueil.php");
					break;
					
				/*case 'invitation':
					include_once("control/user/C_Invite.php");
					break;*/

				//Page de paiement paypal	
				case 'paypal':
					include_once("control/C_PaypalRegister.php");
					break;

				//Page de déconnexion
				case 'deco':
					include_once("control/C_Deco.php");
					break;

				default:
					include_once("control/user/C_Accueil.php");
					break;
			}
		}
		//Session admin
		elseif(isset($_GET['page']) and isset($_SESSION['admin']))
		{
			switch($_GET['page'])
			{
				case 'dashboard':
					include_once("control/admin/C_Content.php");
					break;

				//Page de déconnexion
				case 'deco':
					include_once("control/C_Deco.php");
					break;

				default:
					include_once("control/admin/C_Content.php");
					break;
			}
		}
		else
		{
			include_once("control/C_Home.php");
		}
		?>
	</body>
</html>