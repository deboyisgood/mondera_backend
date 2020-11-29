<?php
//error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);


$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$dt2=date("Y-m-d H:i:s");


$title = trim($_POST['title']);
$details = strip_tags($_POST['details']);
$status = strip_tags($_POST['status']);
$priority = strip_tags($_POST['priority']);
$projectid = strip_tags($_POST['projectid']);
$userid = $_POST['userid'];



include('data6rst.php');


$result = $db->prepare('SELECT * FROM users WHERE id=:id');
$result->execute(array(
			':id' => $userid
    ));
$row = $result->fetch();
$creator_name = $row['fullname'];
$creator_photo = $row['photo'];
$team_id = $row['team_identity'];
$token1 = $row['token1'];
$token2 = $row['token2'];



$statement = $db->prepare('INSERT INTO projects
(project_name,details,timer1,timer2,creator_name,creator_photo,creator_userid,team_id,token1,token2)
                        values
(:project_name,:details,:timer1,:timer2,:creator_name,:creator_photo,:creator_userid,:team_id,:token1,:token2)');
$statement->execute(array( 

':project_name' => $project_name,
':details' => $details,
':timer1' => $timer,
':timer2' => $created_time,
':creator_name' => $creator_name,
':creator_photo' => $creator_photo,
':creator_userid' => $userid,
':team_id' => $team_id,
':token1' => $token1,
':token2' => $token2
));


$res = $db->query("SELECT LAST_INSERT_ID()");
$lastId_project = $res->fetchColumn();



if($statement){
echo 1;	

}
else{
//echo "post could not be submitted";
echo 2;
}






?>