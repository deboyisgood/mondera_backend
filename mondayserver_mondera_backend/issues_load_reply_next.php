<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);



include('data6rst.php');

$queryid = $_POST['queryid_reply'];
$page_row_call = $_POST['page_row_call_reply'];
$teamid =        $_POST['teamingIdsessdata'];
$issueidPost = $_POST['issueidPost'];

$res= $db->prepare("SELECT count(*) as totalcount FROM comments WHERE teamid=:teamid and issueid:issueid ");
$res->execute(array(':teamid' =>  $teamid, ':issueid' => $issueidPost));
$t_row = $res->fetch();
$totalcount = $t_row['totalcount'];


$result = $db->prepare("SELECT * FROM comments WHERE teamid=:teamid and issueid =:issueid order by id ASC limit :row1, :rowpage");
$result->bindValue(':rowpage', (int) trim($page_row_call), PDO::PARAM_INT);
$result->bindValue(':row1', (int) trim($queryid), PDO::PARAM_INT);
$result->bindValue(':teamid', trim($teamid), PDO::PARAM_STR);
$result->bindValue(':issueid', trim($issueidPost), PDO::PARAM_STR);
$result->execute();

$count_post = $result->rowCount();
if($count_post ==0){
//echo "<div style='background:red;color:white;padding:10px;border:none;'>No Reply or Comment Yet o This Issue.. <b></b></div>";
echo 11;
exit();
}

$result_arr = array();
$result_arr[] = array("allcount" => $totalcount);
while($row = $result->fetch()){


$commentid = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$issueid = htmlentities(htmlentities($row['issueid'], ENT_QUOTES, "UTF-8"));
$type = htmlentities(htmlentities($row['type'], ENT_QUOTES, "UTF-8"));
$comment = htmlentities(htmlentities($row['comment'], ENT_QUOTES, "UTF-8"));
$timer1 = htmlentities(htmlentities($row['timer1'], ENT_QUOTES, "UTF-8"));
$timer2 = htmlentities(htmlentities($row['timer2'], ENT_QUOTES, "UTF-8"));
$userid = htmlentities(htmlentities($row['userid'], ENT_QUOTES, "UTF-8"));
$fullname = htmlentities(htmlentities($row['fullname'], ENT_QUOTES, "UTF-8"));
$photo = htmlentities(htmlentities($row['photo'], ENT_QUOTES, "UTF-8"));
$team_id = htmlentities(htmlentities($row['teamid'], ENT_QUOTES, "UTF-8"));


$result_arr[] = array(
"commentid" => $commentid,
"issueid" => $issueid,
"type" => $type,
"comment" => $comment,
"timer1" => $timer1,
"timer2" => $timer2,
"userid" => $userid,
"fullname" => $fullname,
"photo" => $photo,
"team_id" => $team_id


);


}
echo json_encode($result_arr);