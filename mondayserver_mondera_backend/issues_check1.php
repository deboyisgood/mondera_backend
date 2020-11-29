<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require('data6rst.php');
 if(isset($_POST['teamid_issue']) && $_POST['teamid_issue'] != '')
    {
$team_id = strip_tags($_POST['teamid_issue']);
$id = strip_tags($_POST['issueid_issue']);
$owner_userid = strip_tags($_POST['owner_userid']);

$result = $db->prepare('SELECT * FROM issues where team_id = :team_id and id=:id');

		$result->execute(array(
			':team_id' => $team_id,  ':id' => $id));
$nosofrows = $result->rowCount();
echo $nosofrows;
}

?>