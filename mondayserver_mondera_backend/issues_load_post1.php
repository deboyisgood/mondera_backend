<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);



include('data6rst.php');

$queryid = $_POST['queryid'];
$page_row_call = $_POST['page_row_call'];
//$teamid =        $_POST['teamingIdsessdata'];

$team_id = strip_tags($_POST['teamid_issue']);
$id = strip_tags($_POST['issueid_issue']);
$owner_userid = strip_tags($_POST['owner_userid']);


$res= $db->prepare("SELECT count(*) as totalcount FROM issues WHERE team_id=:team_id and id=:id");
$res->execute(array(':team_id' =>  $team_id, ':id' => $id));
$t_row = $res->fetch();
$totalcount = $t_row['totalcount'];


$result = $db->prepare("SELECT * FROM issues  WHERE team_id=:team_id and id=:id order by id DESC limit :row1, :rowpage");
$result->bindValue(':rowpage', (int) trim($page_row_call), PDO::PARAM_INT);
$result->bindValue(':row1', (int) trim($queryid), PDO::PARAM_INT);
$result->bindValue(':team_id', trim($team_id), PDO::PARAM_STR);
$result->bindValue(':id', (int) trim($id), PDO::PARAM_INT);
$result->execute();

$count_post = $result->rowCount();
if($count_post ==0){
//echo "<div style='background:red;color:white;padding:10px;border:none;'>No Data Posted Yet.. <b></b></div>";
echo 11;
}

$result_arr = array();
$result_arr[] = array("allcount" => $totalcount);
while($row = $result->fetch()){


$issueid = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$title = htmlentities(htmlentities($row['title'], ENT_QUOTES, "UTF-8"));
$details = htmlentities(htmlentities($row['details'], ENT_QUOTES, "UTF-8"));
$timer1 = htmlentities(htmlentities($row['timer1'], ENT_QUOTES, "UTF-8"));
$timer2 = htmlentities(htmlentities($row['timer2'], ENT_QUOTES, "UTF-8"));
$creator_name = htmlentities(htmlentities($row['creator_name'], ENT_QUOTES, "UTF-8"));
$creator_photo = htmlentities(htmlentities($row['creator_photo'], ENT_QUOTES, "UTF-8"));
$creator_userid = htmlentities(htmlentities($row['creator_userid'], ENT_QUOTES, "UTF-8"));
$team_id = htmlentities(htmlentities($row['team_id'], ENT_QUOTES, "UTF-8"));
$token1 = htmlentities(htmlentities($row['token1'], ENT_QUOTES, "UTF-8"));
$token2 = htmlentities(htmlentities($row['token2'], ENT_QUOTES, "UTF-8"));
$files = htmlentities(htmlentities($row['files'], ENT_QUOTES, "UTF-8"));
$post_type = htmlentities(htmlentities($row['post_type'], ENT_QUOTES, "UTF-8"));
$post_approve = htmlentities(htmlentities($row['post_approve'], ENT_QUOTES, "UTF-8"));
$status = htmlentities(htmlentities($row['status'], ENT_QUOTES, "UTF-8"));
$status_color = htmlentities(htmlentities($row['status_color'], ENT_QUOTES, "UTF-8"));
$status_symbol = htmlentities(htmlentities($row['status_symbol'], ENT_QUOTES, "UTF-8"));
$priority = htmlentities(htmlentities($row['priority'], ENT_QUOTES, "UTF-8"));
$priority_color = htmlentities(htmlentities($row['priority_color'], ENT_QUOTES, "UTF-8"));
$priority_symbol = htmlentities(htmlentities($row['priority_symbol'], ENT_QUOTES, "UTF-8"));
$total_like = htmlentities(htmlentities($row['total_like'], ENT_QUOTES, "UTF-8"));
$total_unlike = htmlentities(htmlentities($row['total_unlike'], ENT_QUOTES, "UTF-8"));
$total_comment = htmlentities(htmlentities($row['total_comment'], ENT_QUOTES, "UTF-8"));
$filename = htmlentities(htmlentities($row['filename'], ENT_QUOTES, "UTF-8"));
$file_status = htmlentities(htmlentities($row['file_status'], ENT_QUOTES, "UTF-8"));
$project_id = htmlentities(htmlentities($row['project_id'], ENT_QUOTES, "UTF-8"));
$project_name = htmlentities(htmlentities($row['project_name'], ENT_QUOTES, "UTF-8"));

$result_arr[] = array(
"issueid" => $issueid,
"title" => $title,
"details" => $details,
"timer1" => $timer1,
"timer2" => $timer2,
"creator_name" => $creator_name,
"creator_photo" => $creator_photo,
"creator_userid" => $creator_userid,
"team_id" => $team_id,
"token1" => $token1,
"token2" => $token2,
"files" => $files,
"post_type" => $post_type,
"post_approve" => $post_approve,
"status" => $status,
"status_color" => $status_color,
"status_symbol" => $status_symbol,
"priority" => $priority,
"priority_color" => $priority_color,
"priority_symbol" => $priority_symbol,
"total_like" => $total_like,
"total_unlike" => $total_unlike,
"total_comment" => $total_comment,
"filename" => $filename,
"file_status" =>$file_status,
"project_id" =>$project_id,
"project_name" =>$project_name


);


}
echo json_encode($result_arr);