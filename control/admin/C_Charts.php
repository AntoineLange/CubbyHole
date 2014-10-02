<?php

$usersByPlan = DAO_plan::nbUsersByPlan();
$userByDate = DAO_User::CountByDate();

include_once("./view/admin/V_Charts.php"); ?>