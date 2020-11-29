
<?php

error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require('data6rst.php');
 if(isset($_POST['teamid_issue']) && $_POST['teamid_issue'] != '')
    {
$timer = time();
$teamid_issue = strip_tags($_POST['teamid_issue']);
$issueid = strip_tags($_POST['issueid_issue']);


$update1 = $db->prepare("UPDATE issues set view_time =:view_time where team_id = :team_id and id=:id");

		$update1->execute(array(
			':team_id' => $teamid_issue, ':id' =>$issueid, ':view_time' =>$timer
    ));


}

?>