<?php


error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);



$postid = $_POST['post_id'];
$post_id  = $postid;


$type = $_POST['like_type'];
$userid = $_POST['creator_userid'];
$teamid = $_POST['teamid'];
$title = $_POST['title'];


include "data6rst.php";


$result = $db->prepare('SELECT * FROM users WHERE id=:id');
$result->execute(array(
			':id' => $userid
    ));
$row = $result->fetch();
$fullname = $row['fullname'];
$userphoto = $row['photo'];
$team_id = $row['team_identity'];
$token1 = $row['token1'];
$token2 = $row['token2'];



$result = $db->prepare('SELECT count(*) as cntpost,type FROM issue_like_unlike WHERE userid=:userid and postid=:postid');
$result->execute(array(':postid' => $postid, ':userid' => $userid));
$srow = $result->fetch();
$count = $srow['cntpost'];


$token= md5(uniqid());
$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$dt2=date("Y-m-d H:i:s");
$pa = 0;

if($count ==  0){

$statement = $db->prepare('INSERT INTO issue_like_unlike
(userid,postid,type,timer1,timer2,username,fullname,photo,data)
 
                          values
(:userid,:postid,:type,:timer1,:timer2,:username,:fullname,:photo,:data)');

$statement->execute(array( 
':userid' => $userid,
':postid' => $postid,
':type' => $type,
':timer1' => $timer,
':timer2' => $created_time,
':username' => '$username',
':fullname' => $fullname,
':photo' => $userphoto,
':data' => '0'

));


if($type == 1){
// add counter for post issue like
$pst = $db->prepare('select * from issues where id=:id and team_id=:team_id');
$pst->execute(array(':id' =>$post_id, ':team_id' => $teamid));
$r = $pst->fetch();
//$rc = $pst->rowCount();


$t_like=$r['total_like'];
$new_like = 1;
$total_like = $t_like + $new_like;


$update= $db->prepare('UPDATE issues set total_like =:total_like where  id=:id and team_id=:team_id ');
$update->execute(array(':total_like' =>$total_like, ':id' =>$post_id, ':team_id' => $teamid));







// send post broadcast notifications to all team members starts


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

':post_id' => $postid,
':userid' => $userid,
':fullname' => $fullname,
':photo' => $userphoto,
':user_rank' => 'Member',
':reciever_id' => $reciever_userid,
':status' => 'unread',
':type' => 'like',
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
	


// send post broadcast notifications to all team members ends





}





if($type == 0){
// add counter for post issue like
$pst = $db->prepare('select * from issues where id=:id and team_id=:team_id');
$pst->execute(array(':id' =>$post_id, ':team_id' => $teamid));
$r = $pst->fetch();
//$rc = $pst->rowCount();


$t_unlike=$r['total_unlike'];
$new_unlike = 1;
$total_unlike = $t_unlike + $new_unlike;



$update= $db->prepare('UPDATE issues set total_unlike =:total_unlike where  id=:id and team_id=:team_id ');
$update->execute(array(':total_unlike' =>$total_unlike, ':id' =>$post_id, ':team_id' => $teamid));





// send post broadcast notifications to all team members starts


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

':post_id' => $postid,
':userid' => $userid,
':fullname' => $fullname,
':photo' => $userphoto,
':user_rank' => 'Member',
':reciever_id' => $reciever_userid,
':status' => 'unread',
':type' => 'unlike',
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
	


// send post broadcast notifications to all team members ends





}







        
        }else{


$update = $db->prepare('update issue_like_unlike set type = :type WHERE postid =:postid and userid =:userid ');
 
$update->execute(array( 
':type' => $type,
':postid' => $postid,
':userid' => $userid
));




}


$like_result = $db->prepare('SELECT COUNT(*) AS cntLikes FROM issue_like_unlike WHERE type=1 and postid=:postid');
$like_result->execute(array(':postid' => $postid));
$like_row = $like_result->fetch();
        $total_likes = $like_row['cntLikes'];


$unlike_result = $db->prepare('SELECT COUNT(*) AS cntUnlikes FROM issue_like_unlike WHERE type=0 and postid=:postid');
$unlike_result->execute(array(':postid' => $postid));
$unlike_row = $unlike_result->fetch();
        $total_unlikes = $unlike_row['cntUnlikes'];



//$comment_result = $db->prepare('SELECT COUNT(*) AS cntcomment FROM comments WHERE type=1 and postid=:postid');

$comment_result = $db->prepare('SELECT COUNT(*) AS cntcomment FROM comments WHERE issueid=:issueid');
$comment_result->execute(array(':issueid' => $postid));
$comment_row = $comment_result->fetch();
       $total_comment = $comment_row['cntcomment'];


$return_arr = array("likes"=>$total_likes,"unlikes"=>$total_unlikes,"comment"=>$total_comment);

echo json_encode($return_arr);