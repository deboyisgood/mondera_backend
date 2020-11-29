<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

$email = strip_tags($_POST['email']);
$password = strip_tags($_POST['password']);


if ($email == ''){
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>Email is empty</font></div>";
exit();
}


if ($password == ''){
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>password is empty</font></div>";
exit();
}



include('data6rst.php');
$result = $db->prepare('SELECT * FROM users where email = :email');

		$result->execute(array(
			':email' => $email

    ));

$count = $result->rowCount();

$row = $result->fetch();

//if( $count == 1 ) {
if( $count > 0 ) {


//start hashed passwordless Security verify
if(password_verify($password,$row["password"])){
            //echo "Password verified and ok";


$userid = htmlentities(htmlentities($row["id"]));
$fullname = htmlentities(htmlentities($row["fullname"]));
$email = htmlentities(htmlentities($row["email"]));
$photo = htmlentities(htmlentities($row["photo"]));
$user_rank = htmlentities(htmlentities($row["user_rank"]));
$team_id = htmlentities(htmlentities($row["team_identity"]));
$team_name = htmlentities(htmlentities($row["team_name"]));
$app ='101';

if($count == 1){

// initialize session if things where ok via html5 local storage.
echo "<script>
localStorage.setItem('useridsessdata', '$userid');
localStorage.setItem('fullnamesessdata', '$fullname');
localStorage.setItem('emailsessdata', '$email');
localStorage.setItem('photosessdata', '$photo');
localStorage.setItem('countsessdata', '$count');
localStorage.setItem('userranksessdata', '$user_rank');
localStorage.setItem('teamidsessdata', '$team_id');
localStorage.setItem('teamnamesessdata', '$team_name');
localStorage.setItem('appsessdata', '$app');

</script>";


echo "<div class='alert alert-success'>Login sucessful <i class='fa fa-spinner fa-spin' style='font-size:20px'></i>  </div>";
//echo "<script>window.location='dashboard.html'</script>";

echo "<script>window.location='/dashboard'</script>";

}


if($count > 1){

// initialize session if things where ok via html5 local storage.
echo "<script>
localStorage.setItem('useridsessdatamultiple', '$userid');
localStorage.setItem('fullnamesessdatamultiple', '$fullname');
localStorage.setItem('emailsessdatamultiple', '$email');
localStorage.setItem('photosessdatamultiple', '$photo');
localStorage.setItem('countsessdatamultiple', '$count');

</script>";


echo "<div class='alert alert-success'>Login sucessful <i class='fa fa-spinner fa-spin' style='font-size:20px'></i>  </div>";
//echo "<script>window.location='multiple_account.html'</script>";
echo "<script>window.location='/multiplelogin'</script>";

}





}
else{
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>Password Does not Matched</font></div>";

}



}
else {
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>User with This Email does not exist..</font></div>";
}






?>

<?php ob_end_flush(); ?>
