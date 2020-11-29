<?php
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require('data6rst.php');
 if(isset($_POST['token']) && $_POST['token'] == '101201')
    {

$team_name = strip_tags($_POST['team_name']);

//$team_name_replaced= str_replace(' ', '-', $team_name);

$result = $db->prepare('SELECT * FROM team where team_name = :team_name');

		$result->execute(array(
			':team_name' => $team_name
    ));

$nosofrows = $result->rowCount();
echo $nosofrows;
}

?>