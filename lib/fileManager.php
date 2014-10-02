<?php
session_start();
require_once("fileStorage.class.php");
require_once("fileManager.class.php");

$options = array();
$options['max_upload_filesize'] = '10000'; //(the size in Kbytes)
$options[fileManager::$root_param] = '..\documents\\'.$_SESSION["idUser"];
$manager = new fileManager(new fileStorage(), $options);

if(isset($_FILES["file"])) {
	//Filter the file types , if you want.
	if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "";
	}
	else {
		move_uploaded_file($_FILES["file"]["tmp_name"], $options[fileManager::$root_param].'/'. $_FILES["file"]["name"]);
	}
}

try {
	$result = $manager->process($_REQUEST);
} catch (Exception $e) {
	$result = '{result: \'0\', error: \''.addslashes($e->getMessage()).'\', code: \''.$e->getCode().'\'}';
}
echo $result;
?>