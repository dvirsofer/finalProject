<?php

date_default_timezone_set('Asia/Tel_Aviv');
session_start();
require_once('../../Configure.php');
require_once('../lib/Response.php');
require_once('../lib/DB.php');

$customer_name_in_hebrew = $_POST['customer_name'];
$db = DB::getInstance();
$db->checkConnection();

$sql ="select activity_name from activity_fields right join

(select customer_fields.field_id from customer_fields WHERE customer_id =
	(
		SELECT id from
		customer where customer_name  = ('".$customer_name_in_hebrew."') LIMIT 0, 1
    )
 ) as customer_fields on customer_fields.field_id = activity_fields.id";

$workerList = $db->sql_query($sql);






$dis_array = array_slice($dis_array,0,10);

echo include('../parts/customer_area_fields.html');die();





?>