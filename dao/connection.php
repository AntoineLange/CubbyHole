<?php
	include_once('config.php');
	//Connexion à la base de données
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$connexion = new PDO('mysql:host='.$host.';dbname='.$bdd.'', $user, $pass, $pdo_options);
		$connexion->exec("SET CHARACTER SET utf8");
	}
	catch (Exception $e)
	{
	        die('Erreur : ' . $e->getMessage());
	}
?>
