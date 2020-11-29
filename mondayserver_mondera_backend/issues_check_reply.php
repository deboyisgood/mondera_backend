
<?php

error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require('data6rst.php');
 if(isset($_POST['teamid']) && $_POST['teamid'] != '')
    {
$teamid = strip_tags($_POST['teamid']);
$issueid = strip_tags($_POST['issueid']);
$result = $db->prepare('SELECT * FROM comments where teamid = :teamid and issueid = :issueid');

		$result->execute(array(
			':teamid' => $teamid, ':issueid' => $issueid
    ));
$nosofrows = $result->rowCount();
echo $nosofrows;
}

?>