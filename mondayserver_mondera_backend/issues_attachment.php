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


if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

$f_given_name =strip_tags($_POST['userid']);
$f_given_name1 =$f_given_name;

$file_content = strip_tags($_POST['file_fname']);
//$f_given_name1 = strip_tags($_POST['f_given_name']);
$upload_path = "attachments/";

//replace all spaces with hyphen
$f_given_name = str_replace(' ', '-', $f_given_name1);


$mt_id=rand(0000,9999);
$dt2=date("Y-m-d H:i:s");
$ipaddress = strip_tags($_SERVER['REMOTE_ADDR']);


if ($file_content == ''){
echo 9;
//echo "<div style='color:white;background:red;padding:10px;' id='file_alerts' class='file_alerts1'>Files Upload is empty</div>";
exit();
}


$filename_string = strip_tags($_FILES['file_content']['name']);
// thus check files extension names before major validations

$allowed_formats = array("PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg",
"XLS",
"xls",
"XLSX",
"xlsx",
"PPT",
"ppt",
"PPTX",
"pptx",
"TXT",
"txt",
"CSV",
"csv",
"DOC",
"doc",
"DOCX",
"docx",
"PDF",
"pdf",
"OGG",
"ogg",
"wav",
"WAV",
"MP3",
"mp3",
"odt",
"ODT",
"ODS",
"ods",
"rtf",
"RTF",
"MP4",
"mp4",
"QT",
"qt",
"MOV",
"mov",
"WMV",
"wmv",
"flv",
"FLV",
"3g2",
"3G2",
"3gp",
"3GP",
"avi",
"AVI",
"mpeg",
"MPEG",
"webm",
"WEBM",
"json",
"JSON"
);

$exts = explode(".",$filename_string);
$ext = end($exts);



if (!in_array($ext, $allowed_formats)) { 

echo 11;
exit();
}



 //validate file names, ensures directory tranversal attack is not possible.
//thus replace and allowe filenames with alphanumeric dash and hy

//allow alphanumeric,underscore and dash

$fname_1= preg_replace("/[^\w-]/", "", $filename_string);

// add a new extension name to the uploaded files after stripping out its dots extension name
//$new_extension = ".png";

$old_extension = $ext;
$fname = $fname_1.$old_extension;



 $fsize = $_FILES['file_content']['size']; 

$ftmp = $_FILES['file_content']['tmp_name'];

//give file a new name and random names
$filecontent_name = $f_given_name.time();



if ($fsize > 5 * 1024 * 1024) { // allow file of less than 5 mb
echo 12;
exit();
}

$allowed_types=array(
'application/json',
'application/octet-stream',
'image/gif',
    'image/jpeg',
    'image/png',
'image/jpg',
'image/GIF',
    'image/JPEG',
    'image/PNG',
'image/JPG',
'application/pdf',
'application/msword',
'application/vnd.ms-excel',
'application/vnd.ms-powerpoint',
'application/vnd.oasis.opendocument.text',
'application/vnd.openxmlformats-officedocument.presentationml.presentation',
'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
'audio/mpeg',
'audio/ogg',
'audio/wav',
'audio/x-wav',
'audio/mp3',
'audio/mp4',
'text/csv',
'application/vnd.oasis.opendocument.spreadsheet',
'application/rtf',
'video/mp4',
'video/mpeg',
'video/quicktime',
'video/x-ms-wmv',
'video/x-flv',
'video/3gpp2',
'video/3gpp',
'video/x-msvideo',
'video/webm'
);



if ( ! ( in_array($_FILES["file_content"]["type"], $allowed_types) ) ) {
echo 13;
exit();
}


//validate file using file info  method
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['file_content']['tmp_name']);

if ( ! ( in_array($mime, $allowed_types) ) ) {
 
echo 14;
exit();
}
finfo_close($finfo);




// start if for fileuploads

if (move_uploaded_file($ftmp, $upload_path . $filecontent_name.'.'.$ext)) {

$final_filename= $filecontent_name.'.'.$ext;


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
filename,
issue_month,
file_status,
project_id,
project_name

)
                        values
(
:title,:details,:timer1,:timer2,:creator_name,:creator_photo,:creator_userid,:team_id,:token1,:token2,
:files,:post_type,:post_approve,:status,:status_color,:status_symbol,:priority,:priority_color,:priority_symbol,
:total_like,:total_unlike,:total_comment,:start_date,:end_date,:filename,:issue_month,:file_status,:project_id,:project_name

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
':files' => $final_filename,
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
':filename' => $filename_string,
':issue_month' => $month,
':file_status' => '1',
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



}
// end if for fileuploads




}

?>












