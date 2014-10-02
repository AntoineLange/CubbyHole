<?php

include_once("./control/user/C_Header.php");

include_once("./control/user/C_Navigation.php");

if(isset($_GET["page"])) {
	switch($_GET["page"]) {
		case "accueil":
			include_once("./view/user/V_Accueil.php");
			break;
		case "invitation":
			include_once("./control/user/C_Invite.php");
			break;
		case "profil":
			include_once("./control/user/C_Profil.php");
			break;
		case "share":
			include_once("./control/user/C_Share.php");
			break;
		case "shareFiles":
			include_once("./control/user/C_ShareFiles.php");
			break;
		default:
		include_once("./view/user/V_Accueil.php");
	}
}
else {
	include_once("./view/user/V_Accueil.php");
}

?>