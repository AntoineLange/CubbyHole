<?php 
if(isset($_POST) and !empty($_POST)) {
	
	$modif_plan = new plan($_GET['idPlan'], $_POST['inputName'], $_POST['inputDuration'], $_POST['inputStorageSpace'], $_POST['inputBandwidth'], $_POST['inputDailyTransferQuota']);
	DAO_plan::Update($modif_plan);

	if(!$modif_plan) { ?>
		<div class="alert alert-danger" style="margin: 30px 150px;">Erreur</div>
		<script language="JavaScript">setTimeout("window.location.href='index.php?page=dashboard&display=plans'", 2000);</script><?php
	}
	else { ?>
		<div class="alert alert-success" style="margin: 30px 150px;">Modification effectué</div>
		<script language="JavaScript">setTimeout("window.location.href='index.php?page=dashboard&display=plans'", 2000);</script><?php
	}

} elseif(isset($_GET['idPlan'])) {
	$lePlan = DAO_Plan::loadOne($_GET['idPlan']);
	include_once("./view/admin/V_UpdatePlan.php");
} else {
	include_once("./view/admin/V_Plans.php");
}