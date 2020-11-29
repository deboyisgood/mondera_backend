
<?php

error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require('data6rst.php');
 if(isset($_POST['teamid_issue']) && $_POST['teamid_issue'] != '')
    {
$teamid_issue = strip_tags($_POST['teamid_issue']);
//$projectid_issue = strip_tags($_POST['projectid_issue']);

$result = $db->prepare("SELECT * FROM issues where team_id = :team_id and status='Open'");

		$result->execute(array(
			':team_id' => $teamid_issue
    ));
$nosofrows = $result->rowCount();
echo $nosofrows;
}

?>