<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

$userid = strip_tags($_POST['userid']);
$teamname = strip_tags($_POST['teamname']);
$team_id = strip_tags($_POST['teamId']);


if ($userid == ''){
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>Userid is empty</font></div>";
exit();
}


if ($team_id == ''){
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>Team Id is empty</font></div>";
exit();
}



include('data6rst.php');
$result = $db->prepare('SELECT * FROM users where id = :id and team_identity=:team_identity');

		$result->execute(array(
			':id' => $userid,
':team_identity' => $team_id


    ));

$count = $result->rowCount();

$row = $result->fetch();

if( $count == 1 ) {

$userid = htmlentities(htmlentities($row["id"]));
$fullname = htmlentities(htmlentities($row["fullname"]));
$email = htmlentities(htmlentities($row["email"]));
$photo = htmlentities(htmlentities($row["photo"]));
$user_rank = htmlentities(htmlentities($row["user_rank"]));
$team_id = htmlentities(htmlentities($row["team_identity"]));
$team_name = htmlentities(htmlentities($row["team_name"]));

$app ='101';

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


echo "<div class='alert alert-success'>Verification sucessful <i class='fa fa-spinner fa-spin' style='font-size:20px'></i>  </div>";
//echo "<script>window.location='dashboard.html'</script>";
echo "<script>window.location='/dashboard'</script>";

}
else{
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>User cannot be verified</font></div>";

}







?>

<?php ob_end_flush(); ?>
