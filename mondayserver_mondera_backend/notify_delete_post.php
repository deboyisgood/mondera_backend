<?php
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include('data6rst.php');


$notifyid =strip_tags($_POST['notifyid']);
$teamid=strip_tags($_POST['teamid']);

$del = $db->prepare('DELETE FROM notification where teamid = :teamid  and id=:id');

		$del->execute(array(
			':teamid' => $teamid, ':id' =>$notifyid
    ));





if($del){

echo 1;
}else{

echo 0;
}









?>


