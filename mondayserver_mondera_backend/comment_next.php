<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$comdesc = strip_tags($_POST['comdesc']);
$issueid = strip_tags($_POST['issueid1']);
$teamid = strip_tags($_POST['teamid1']);
$userid= strip_tags($_POST['useridsession']);
//$title = strip_tags($_POST['title']);


if ($comdesc == ''){
exit();
}

include('data6rst.php');



//use userid to get info of the persorn eplying

$result = $db->prepare('SELECT * FROM users WHERE id=:id');
$result->execute(array(
			':id' => $userid
    ));
$row = $result->fetch();
$fullname = $row['fullname'];
$userphoto = $row['photo'];
//$team_id = $row['team_identity'];
//$token1 = $row['token1'];
//$token2 = $row['token2'];



// get issue title
$resultR = $db->prepare('SELECT * FROM issues WHERE id=:id');
$resultR->execute(array(
			':id' => $issueid
    ));
$rowR = $resultR->fetch();
$title = $rowR['title'];




if ($comdesc != ''){


$token= md5(uniqid());
$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$dt2=date("Y-m-d H:i:s");
$pa = 0;

$statement = $db->prepare('INSERT INTO comments
(issueid,type,comment,timer1,timer2,userid,username,fullname,photo,comment_approve,teamid)
 
                          values
(:issueid,:type,:comment,:timer1,:timer2,:userid,:username,:fullname,:photo,:comment_approve,:teamid)');

$statement->execute(array( 
':issueid' => $issueid,
':type' => 'text',
':comment' => $comdesc,
':timer1' => $timer,
':timer2' => $created_time,
':userid' => $userid,
':username' => '0',
':fullname' => $fullname,
':photo' => $userphoto,
':comment_approve' => '0',
':teamid' => $teamid

));


$res = $db->query("SELECT LAST_INSERT_ID()");
$lastId_comment = $res->fetchColumn();

$pst = $db->prepare('select * from issues where id=:id and team_id=:team_id');
$pst->execute(array(':id' =>$issueid, ':team_id' => $teamid));
$r = $pst->fetch();
//$rc = $pst->rowCount();


$t_com=$r['total_comment'];
$new_com = 1;
$total_comment = $t_com + $new_com;


$update= $db->prepare('UPDATE issues set total_comment =:total_comment where  id=:id and team_id=:team_id ');
$update->execute(array(':total_comment' =>$total_comment, ':id' =>$issueid, ':team_id' => $teamid));





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

':post_id' => $issueid,
':userid' => $userid,
':fullname' => $fullname,
':photo' => $userphoto,
':user_rank' => 'Member',
':reciever_id' => $reciever_userid,
':status' => 'unread',
':type' => 'comment',
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
	






}



$comment_result = $db->prepare('SELECT COUNT(*) AS cntcomment FROM comments WHERE issueid=:issueid');
$comment_result->execute(array(':issueid' => $issueid));
$comment_row = $comment_result->fetch();
$totalcomment = $comment_row['cntcomment'];

$return_arr = array("comment_id"=>$lastId_comment,"comment"=>$totalcomment,"comdesc"=>$comdesc,"comment_username"=>$userid,"comment_fullname"=>$fullname,"comment_photo"=>$userphoto,"timer2"=>$created_time, "timer1"=>$timer, "comment_userid"=>$userid);

echo json_encode($return_arr);
