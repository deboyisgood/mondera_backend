
<?php

error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require('data6rst.php');
 if(isset($_POST['team_id']) && $_POST['team_id'] != '')
    {
$team_id = strip_tags($_POST['team_id']);
$result = $db->prepare('SELECT * FROM issues where team_id = :team_id');

		$result->execute(array(
			':team_id' => $team_id
    ));
$nosofrows = $result->rowCount();
echo $nosofrows;
}

?>