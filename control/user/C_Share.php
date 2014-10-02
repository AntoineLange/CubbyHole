<?php

//On charge les utilisateurs
$lesUsers = DAO_user::LoadAll();
include_once("./view/user/V_Share.php");

?>