<?php
include_once("api/general_operation_cls.php");

$objGO = new General_Operation();

$post = array();
$post[0]["CompanyID"] = 3;
/*$post[0]["Name"] = "Seasor Marketing";
$post[0]["Address"] = "Alkapuri";
$post[0]["City"] = "Baroda";
$post[0]["County"] = "India";
$post[0]["Email"] = "kemi@seasormarketing.com";*/
$res = $objGO->getCompany($post);

echo "<pre>";
print_r($res);
exit;

?>