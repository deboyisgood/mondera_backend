<?php
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include('data6rst.php');

$user_email = strip_tags($_GET['user_email']);
//echo $user_email;

$res1 = $db->prepare("SELECT * FROM users where email=:email ");
$res1->execute(array('email' => $user_email));


while($row = $res1->fetch()){
$id = $row['id'];
$fullname = $row['fullname'];
$photo = $row['photo'];
$email = $row['email'];
$team_name = $row['team_name'];
$team_identity = $row['team_identity'];

// replace empty space with hyphen
//$fullname = str_replace(' ', '-', $fullname1);


$data_array[] = array(
"id" => $id,
"fullname" => $fullname,
"photo" => $photo,
"email" => $email,
"team_name" => $team_name,
"team_identity" =>$team_identity

);
}


echo json_encode($data_array);