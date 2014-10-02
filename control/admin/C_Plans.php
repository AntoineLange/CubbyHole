<?php 

$lesPlans = DAO_plan::LoadAllWithoutAdminPlan();;

include_once("./view/admin/V_Plans.php"); ?>