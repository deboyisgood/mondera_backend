<?php 

error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include('data6rst.php');



	$team_id = strip_tags($_POST['team_id']);


$result = $db->prepare('SELECT * FROM projects WHERE team_id=:team_id');
$result->execute(array(
			':team_id' => $team_id
    ));

$res = array();
foreach($result as $vs){
		$res[] = array(
				"id" => $vs['id'],
				"project_name" => $vs['project_name']
			);
	}

	echo json_encode($res);
	exit;

