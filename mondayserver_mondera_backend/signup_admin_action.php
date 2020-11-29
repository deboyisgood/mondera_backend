<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);


if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

$file_content = strip_tags($_POST['file_fname']);
//$username1 = strip_tags($_POST['username']);
//$username = str_replace(' ', '', $username1);

$username = 'good';
$password = strip_tags($_POST['password']);
$fullname = strip_tags($_POST['fullname']);
$email = strip_tags($_POST['email']);
//$country = strip_tags($_POST['country']);
//$phone_no = strip_tags($_POST['phone_no']);
$mt_id=rand(0000,9999);
$dt2=date("Y-m-d H:i:s");
$ipaddress = strip_tags($_SERVER['REMOTE_ADDR']);

$team_name = strip_tags($_POST['team_name']);
$team_name_replaced= str_replace(' ', '-', $team_name);

if ($file_content == ''){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>Files Upload is empty</font></div>";
exit();
}


if ($password == ''){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>password is empty</font></div>";
exit();
}

if ($fullname == ''){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>fullname Name is empty</font></div>";
exit();
}

if ($email == ''){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>Email Address is empty</font></div>";
exit();
}

$em= filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$em){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>Email Address is Invalid</font></div>";
exit();
}

$ip= filter_var($ipaddress, FILTER_VALIDATE_IP);
if (!$ip){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>IP Address is Invalid</font></div>";
exit();
}



$upload_path = "uploads/";

$filename_string = strip_tags($_FILES['file_content']['name']);
// thus check files extension names before major validations

$allowed_formats = array("PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg");
$exts = explode(".",$filename_string);
$ext = end($exts);

if (!in_array($ext, $allowed_formats)) { 
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>File Formats not allowed. Only Images are allowed.<br></div>";
exit();
}




 //validate file names, ensures directory tranversal attack is not possible.
//thus replace and allowe filenames with alphanumeric dash and hy

//allow alphanumeric,underscore and dash

$fname_1= preg_replace("/[^\w-]/", "", $filename_string);

// add a new extension name to the uploaded files after stripping out its dots extension name
$new_extension = ".png";
$fname = $fname_1.$new_extension;





// for security reasons, you migh want to avoid files with more than one dot extension name
//file like fred.exe.png might contain virus. only ask the user to rename files to eg fred.png before uploads

$fname_dot_count = substr_count($fname,".");
if($fname_dot_count >1){
echo "<div id='alertdata_uploadfiles2' class='alerts alert-danger'>
Your files <b>$filename_string</b> has <b>($fname_dot_count dot extension names)</b>
File with more than one <b>dot(.) extension name are not allowed.
you can rename and ensure it has only one dot extension eg: <b>example.png</b>
</b></div>";
exit();

}


$fsize = $_FILES['file_content']['size']; 
$ftmp = $_FILES['file_content']['tmp_name'];

//give file a random names
$filecontent_name = $username.time();
//$filecontent_name = 'fred1';


if ($fsize > 5 * 1024 * 1024) { // allow file of less than 5 mb
echo "<div id='alertdata' class='alerts alert-danger'>File greater than 5mb not allowed<br></div>";
exit();
}

// Check if file already exists
if (file_exists($upload_path . $filecontent_name.'.'.$ext)) {
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>This uploaded File <b>$filecontent_name.$ext</b> already exist<br></div>";
exit(); 
}


$allowed_types=array(
'application/json',
'application/octet-stream',
'text/plain',
'image/gif',
    'image/jpeg',
    'image/png',
'image/jpg',

'image/GIF',
    'image/JPEG',
    'image/PNG',
'image/JPG'
);



if ( ! ( in_array($_FILES["file_content"]["type"], $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only Images are allowed bro..<br><br></div>";
exit();
}



// Calling getimagesize() function 
//$image_info = getimagesize("team1.png"); 
//print_r($image_info); 

$image_info =getimagesize($_FILES['file_content']['tmp_name']);

    $width = $image_info[0];
    $height = $image_info[1];
    $mime_image = $image_info['mime'];
/*
//validate file dimension eg 400 by 250
if ($width > "400" || $height > "250") {
       echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>file upload dimension must not be more than 400(width) by 250(height)</div>";
exit();

}
*/


// check file validation using getimagesizes
 if ($image_info === FALSE) {
           echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>cannot determine the image type</div>";
exit();
        }



if ( ! ( in_array($mime_image, $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only Image types are allowed..<br><br></div>";
exit();
}



if (($image_info[2] !== IMAGETYPE_GIF) && ($image_info[2] !== IMAGETYPE_JPEG) && ($image_info[2] !== IMAGETYPE_PNG)) {
           echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>only image format gif,jpg, png are allowed..</div>";
exit();
        }





//validate image using file info  method
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['file_content']['tmp_name']);

if ( ! ( in_array($mime, $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only Images are allowed...<br></div>";
exit();
}
finfo_close($finfo);


include('data6rst.php');


if (move_uploaded_file($ftmp, $upload_path . $filecontent_name.'.'.$ext)) {


//insert into database
$final_filename =  $filecontent_name.'.'.$ext;
$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$dt2=date("Y-m-d H:i:s");

$uniqueId = uniqid();


$t_rand=rand(0000,9999);
$token0= md5($uniqueId.$fullname.$timer);
//$token1 = time();
$token1 = md5($uniqueId);
$token2 = $token0.$token1;
$team_identity =md5($uniqueId.$t_rand);



// check if Team name already exist

$team_name = strip_tags($_POST['team_name']);
//$team_name_replaced= str_replace(' ', '-', $team_name);

$result1 = $db->prepare('SELECT * FROM team where team_name = :team_name');

		$result1->execute(array(
			':team_name' => $team_name
    ));

$nosofrows1 = $result1->rowCount();

if($nosofrows1 > 0){
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>This Team name Already Exist...<br></div>";
exit();

}





// check if User Email already associated with the Team Name

$team_name = strip_tags($_POST['team_name']);
//$team_name_replaced= str_replace(' ', '-', $team_name);

$result2 = $db->prepare('SELECT * FROM users where team_name = :team_name and email=:email');

		$result2->execute(array(
			':team_name' => $team_name, ':email' =>$email
    ));

$nosofrows2 = $result2->rowCount();

if($nosofrows2 > 0){
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Your Email Address is already registered to this team name...<br></div>";
exit();

}



//hash password before sending it to database...
$options = array("cost"=>4);
$hashpass = password_hash($password,PASSWORD_BCRYPT,$options);


//alter table team add column(createdby_name varchar(100),createdby_email varchar(100), timing varchar(30));


$stmt = $db->prepare('INSERT INTO team(team_name,team_identity,data,createdby_name,createdby_email,timing)
values(:team_name,:team_identity,:data,:createdby_name,:createdby_email,:timing)');

$stmt->execute(array( 
':team_name' => $team_name,
':team_identity' => $team_identity,
':data' => $team_name_replaced,
':createdby_name' => $fullname,
':createdby_email' => $email,
':timing' => $timer	
));




$statement = $db->prepare('INSERT INTO users
(password,fullname,email,photo,user_rank,user_verified,user_banned,created_time,timer1,token1,token2,team_identity,team_name,team_timing)
 
                          values
(:password,:fullname,:email,:photo,:user_rank,:user_verified,:user_banned,:created_time,:timer1,:token1,:token2,:team_identity,:team_name,:team_timing)');

$statement->execute(array( 

':password' => $hashpass,
':fullname' => $fullname,
':email' => $email,		
':photo' => $final_filename,
':user_rank' => 'admin',
':user_verified' => 1,
':user_banned' => 0,
':created_time' =>$created_time,
':timer1' => $timer,
':token1' => $token0,
':token2' =>$token2,
':team_identity' => $team_identity,
':team_name' => $team_name,
':team_timing' => $timer
));


if($statement){


echo "<div id='alertdata_uploadfiles_o' class='well alerts alert-success'>Data Created Successfully.
.Redirecting in a second to Login Section.....<i class='fa fa-spinner fa-spin' style='font-size:20px'></i> <br></div>";

echo "<script>
window.setTimeout(function() {
    //window.location.href = 'login.html';
window.location.href = '/login';
}, 1000);
</script><br><br>";



}

                } else {
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Your Data cannot be submitted to database.<br></div>";
                }

}


?>




