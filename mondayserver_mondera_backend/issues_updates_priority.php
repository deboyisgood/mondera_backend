<?php
error_reporting(0);

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


$issueid = trim($_POST['issueid']);
$userid = strip_tags($_POST['userid']);
$teamid = strip_tags($_POST['teamid']);
$priority = strip_tags($_POST['priority']);
$title = strip_tags($_POST['title']);



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




// ensure only the issue owner can make updates
$userid_sess = strip_tags($_POST['userid_session']);

if($userid_sess != $userid){
// echo only issue owner can make updates

$return_arr1 = array("messaging1"=>'no');
echo json_encode($return_arr1);
exit();
}


include('data6rst.php');

// get users info


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




$update = $db->prepare('UPDATE issues set priority =:priority, priority_color=:priority_color, priority_symbol=:priority_symbol where id=:id  and team_id=:team_id');
$update->execute(array( 
':priority' => $priority,
':priority_color' => $priority_color,
':priority_symbol' => $priority_symbol,
':id' => $issueid,
':team_id' => $teamid
));








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
(post_id,userid,fullname,photo,user_rank,reciever_id,status,type,timing,title,teamid,stat)
                        values
(:post_id,:userid,:fullname,:photo,:user_rank,:reciever_id,:status,:type,:timing,:title,:teamid,:stat)');
$statement1->execute(array( 

':post_id' => $issueid,
':userid' => $userid,
':fullname' => $creator_name,
':photo' => $creator_photo,
':user_rank' => 'Member',
':reciever_id' => $reciever_userid,
':status' => 'unread',
':type' => 'priority',
':timing' => $timer,
':title' => $title,
':teamid' => $teamid,
':stat' => $priority,

));







//insert ends
		  

		    //$count++;
		}
	}else{
		//echo "<div>No Team member found.</div>";
	}
	






if($update){

$return_arr = array("priority"=>$priority,"messaging"=>'ok');
echo json_encode($return_arr);

}
else{
//echo "data could not be submitted";
echo 2;
}






?>