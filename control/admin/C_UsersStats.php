<?php 

$usersByPlan = DAO_plan::nbUsersByPlan();
$freeUsers = DAO_plan::nbFreeUsers();
$paidUsers = DAO_plan::nbPaidUsers();
$userByDate = DAO_User::CountByDate();
$totalUser = DAO_User::Count();

include_once("./view/admin/V_UsersStats.php"); ?>