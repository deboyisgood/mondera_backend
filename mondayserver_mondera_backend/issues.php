<?php
error_reporting(0);

//error_reporting(E_ALL);
//error_reporting(-1);
//ini_set('error_reporting', E_ALL);

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

$dating=date("Y-m-d");


$title = trim($_POST['title']);
$details = strip_tags($_POST['details']);
$status = strip_tags($_POST['status']);
$priority = strip_tags($_POST['priority']);
$projectid = strip_tags($_POST['projectid']);
$userid = strip_tags($_POST['userid']);
$teamid = strip_tags($_POST['teamid']);

if($status == 'Open'){
$status_color = '#3b5998';
$status_symbol ='O';
}

if($status == 'Done'){

$status_color = 'green';
$status_symbol ='D';
}



if($priority == 'High'){
$priority_color = 'red';
$priority_symbol ='H';
}


if($priority == 'Medium'){
$priority_color = '#800000';
$priority_symbol ='M';
}


if($priority == 'Low'){
$priority_color = 'purple';
$priority_symbol ='L';
}


include('data6rst.php');


// check if Team Admin has created Project before

$result_pro = $db->prepare('SELECT * FROM projects WHERE id=:id and team_id=:team_id');
$result_pro->execute(array(':id' => $projectid, ':team_id' => $teamid));
$row_pro = $result_pro->fetch();
$proj_name = $row_pro['project_name'];
$project_count = $result_pro->rowCount();

if($project_count ==0){
// No Projects Exits
echo 77;
exit();
}


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



$month = date('m');



$statement = $db->prepare('INSERT INTO issues
(
title,
details,
timer1,
timer2,
creator_name,
creator_photo,
creator_userid,
team_id,
token1,
token2,
files,
post_type,
post_approve,
status,
status_color,
status_symbol,
priority,
priority_color,
priority_symbol,
total_like,
total_unlike,
total_comment,
start_date,
end_date,
issue_month,
project_id,
project_name
)
                        values
(
:title,:details,:timer1,:timer2,:creator_name,:creator_photo,:creator_userid,:team_id,:token1,:token2,
:files,:post_type,:post_approve,:status,:status_color,:status_symbol,:priority,:priority_color,:priority_symbol,
:total_like,:total_unlike,:total_comment,:start_date,:end_date,:issue_month,:project_id,:project_name

)');

$statement->execute(array( 

':title' => $title,
':details' => $details,
':timer1' => $timer,
':timer2' => $created_time,
':creator_name' => $creator_name,
':creator_photo' => $creator_photo,
':creator_userid' => $userid,
':team_id' => $team_id,
':token1' => $token1,
':token2' => $token2,
':files' => '0',
':post_type' => 'issue',
':post_approve' => '1',
':status' => $status,
':status_color' => $status_color,
':status_symbol' => $status_symbol,
':priority' => $priority,
':priority_color' => $priority_color,
':priority_symbol' => $priority_symbol,
':total_like' =>'0',
':total_unlike' => '0',
':total_comment' => '0',
':start_date' => $dating,
':end_date' => '0',
':issue_month' => $month,
':project_id' => $projectid,
':project_name' => $proj_name


));


$res = $db->query("SELECT LAST_INSERT_ID()");
$lastId_issue = $res->fetchColumn();





// query table users to get team members

// send post broadcast notifications to all team members


$result = $db->prepare('SELECT * FROM users where team_identity = :team_identity and id !=:id');
$result->execute(array(':team_identity' => $teamid, ':id' =>$userid));
$nosofrows = $result->rowCount();




if($nosofrows > 0){
//foreach($row['data'] as $v1){
while($row = $result->fetch()){

$reciever_userid = $row['id'];



$statement1 = $db->prepare('INSERT INTO notification
(post_id,userid,fullname,photo,user_rank,reciever_id,status,type,timing,title,teamid)
                        values
(:post_id,:userid,:fullname,:photo,:user_rank,:reciever_id,:status,:type,:timing,:title,:teamid)');
$statement1->execute(array( 

':post_id' => $lastId_issue,
':userid' => $userid,
':fullname' => $creator_name,
':photo' => $creator_photo,
':user_rank' => 'Member',
':reciever_id' => $reciever_userid,
':status' => 'unread',
':type' => 'post',
':timing' => $timer,
':title' => $title,
':teamid' => $teamid
));







//insert ends
		  

		    //$count++;
		}
	}else{
		//echo "<div>No Team member found.</div>";
	}
	






if($statement){
echo 1;	

}
else{
//echo "post could not be submitted";
echo 2;
}






?>