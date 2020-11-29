<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include('data6rst.php');

$teamid = strip_tags($_GET['teamid']);


$res1 = $db->prepare("SELECT * FROM projects WHERE team_id =:team_id ORDER BY id DESC");
$res1->execute(array(':team_id' =>$teamid));
$counting = $res1->rowCount();

if($counting == 0){
echo 0;
exit();
}

while($row = $res1->fetch()){

$id = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$project_name = htmlentities(htmlentities($row['project_name'], ENT_QUOTES, "UTF-8"));
$details = htmlentities(htmlentities($row['details'], ENT_QUOTES, "UTF-8"));
$timer1 = htmlentities(htmlentities($row['timer1'], ENT_QUOTES, "UTF-8"));
$timer2 = htmlentities(htmlentities($row['timer2'], ENT_QUOTES, "UTF-8"));
$creator_name = htmlentities(htmlentities($row['creator_name'], ENT_QUOTES, "UTF-8"));
$creator_photo = htmlentities(htmlentities($row['creator_photo'], ENT_QUOTES, "UTF-8"));
$creator_userid = htmlentities(htmlentities($row['creator_userid'], ENT_QUOTES, "UTF-8"));
$token1 = htmlentities(htmlentities($row['token1'], ENT_QUOTES, "UTF-8"));
$token2 = htmlentities(htmlentities($row['token2'], ENT_QUOTES, "UTF-8"));
$team_id = htmlentities(htmlentities($row['team_id'], ENT_QUOTES, "UTF-8"));


$d_arr[] = array(
"id" => $id,
"project_name" => $project_name,
"details" => $details,
"timer1" => $timer1,
"timer2" => $timer2,
"creator_name" => $creator_name,
"creator_photo" => $creator_photo,
"creator_userid" => $creator_userid,
"token1" => $token,
"token2" => $token2,
"team_id" => $team_id

);
}


echo json_encode($d_arr);