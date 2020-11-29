<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include('data6rst.php');

$teamid = strip_tags($_GET['teamid']);

$res1 = $db->prepare("SELECT * FROM users WHERE team_identity =:team_identity ORDER BY id DESC");
$res1->execute(array(':team_identity' =>$teamid));

$counting = $res1->rowCount();
if($counting == 0){
// No Team Members Found
echo 0;
exit();

}

while($row = $res1->fetch()){

$id = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$fullname = htmlentities(htmlentities($row['fullname'], ENT_QUOTES, "UTF-8"));
$email = htmlentities(htmlentities($row['email'], ENT_QUOTES, "UTF-8"));
$timer1 = htmlentities(htmlentities($row['timer1'], ENT_QUOTES, "UTF-8"));
$photo = htmlentities(htmlentities($row['photo'], ENT_QUOTES, "UTF-8"));
$token1 = htmlentities(htmlentities($row['token1'], ENT_QUOTES, "UTF-8"));
$token2 = htmlentities(htmlentities($row['token2'], ENT_QUOTES, "UTF-8"));
$team_id = htmlentities(htmlentities($row['team_identity'], ENT_QUOTES, "UTF-8"));


$d_arr[] = array(
"id" => $id,
"fullname" => $fullname,
"email" => $email,
"timer1" => $timer1,
"photo" => $photo,
"token1" => $token,
"token2" => $token2,
"team_id" => $team_id

);
}


echo json_encode($d_arr);