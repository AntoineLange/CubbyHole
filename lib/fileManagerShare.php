<?php
session_start();
require_once("fileStorage.class.php");
require_once("fileManager.class.php");

if($_SESSION['idUserToShare'] < $_SESSION['idUser']) {
	$shareDir = $_SESSION['idUserToShare'].'_'.$_SESSION['idUser'];
} else {
	$shareDir = $_SESSION['idUser'].'_'.$_SESSION['idUserToShare'];
}

if(!file_exists('..\documents\\'.$shareDir)) {
	mkdir('..\documents\\'.$shareDir);
}

$optionsShare = array();
$optionsShare['max_upload_filesize'] = '20000'; //(the size in Kbytes)
$optionsShare[fileManager::$root_param] = '..\documents\\'.$shareDir;
$manager = new fileManager(new fileStorage(), $optionsShare);

if(isset($_FILES["file"])) {
	//Filter the file types , if you want.
	if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "";
	}
	else {
		move_uploaded_file($_FILES["file"]["tmp_name"], $optionsShare[fileManager::$root_param].'/'. $_FILES["file"]["name"]);
	}
}

try {
	$result = $manager->process($_REQUEST);
} catch (Exception $e) {
	$result = '{result: \'0\', error: \''.addslashes($e->getMessage()).'\', code: \''.$e->getCode().'\'}';
}
echo $result;
?>