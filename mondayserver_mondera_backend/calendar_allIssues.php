
<style>
.tooltip1 {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip1 .tooltiptext {
    visibility: hidden;
//height:120px;
    width: 300px;

    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
font-size:12px;
    
    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    bottom: 100%;
    left: 50%;
    margin-left: -60px;
}

.tooltip1:hover .tooltiptext {
    visibility: visible;
}
</style>

<?php
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");




 include('data6rst.php');


 $teamid = strip_tags($_GET['teamid']);
//$month = 07;


$month = date('m');
$year = date('y');
if(!empty($_GET['month'])) $month = $_GET['month'];
if(!empty($_GET['year'])) $year = $_GET['year'];
if(!empty($_GET['uid']))  $uid = strip_tags($_GET['uid']);

	$calendar = '';
	if($month == null || $year == null) {
		$month = date('m');
		$year = date('Y');
	}
	$date = mktime(12, 0, 0, $month, 1, $year);
	$daysInMonth = date("t", $date);
	$offset = date("w", $date);
	$rows = 1;
	$prev_month = $month - 1;
	$prev_year = $year;
	if ($month == 1) {
		$prev_month = 12;
		$prev_year = $year-1;
	}
	
	$next_month = $month + 1;
	$next_year = $year;
	if ($month == 12) {
		$next_month = 1;
		$next_year = $year + 1;
	}



	$calendar .= "<div class='panel-heading text-center'><div class='row'><div class='col-md-3 col-xs-4'><a title='previous' class='calendar_calling1 btn btn-default btn-sm' href='http://localhost/microsoft_school_upload/monday_db/calendar_allIssues.php?month=".$prev_month."&year=".$prev_year."&teamid=".$teamid."'><span class='glyphicon glyphicon-arrow-left'></span></a></div><div class='col-md-6 col-xs-4'><strong>" . date("F Y", $date) . "</strong></div>";
	$calendar .= "<div class='col-md-3 col-xs-4 '><a title='Next' class='calendar_calling1 btn btn-default btn-sm' href='https://qbtut.com/mondayserver/calendar_allIssues.php?month=".$next_month."&year=".$next_year."&teamid=".$teamid."'><span class='glyphicon glyphicon-arrow-right'></span></a></div></div></div>"; 

        $calendar .= "<table class='table table-bordered'>";
	$calendar .= "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";
	$calendar .= "<tr>";

	for($i = 1; $i <= $offset; $i++) {
		$calendar .= "<td></td>";
	}
	for($day = 1; $day <= $daysInMonth; $day++) {
		if( ($day + $offset - 1) % 7 == 0 && $day != 1) {
			$calendar .= "</tr><tr>";
			$rows++;
		}


$result = $db->prepare("SELECT * from issues where issue_month = :issue_month and team_id =:team_id");		
$result->execute(array(':issue_month'=>$month, ':team_id' =>$teamid));

$data = $result->fetchAll();
		$mycalendar_res = '';
if(!empty($data)) {
		foreach ($data as $key => $issueRow) {

$day_convert = strtotime($issueRow['start_date']);
$c_day = date("d", $day_convert);



	if($c_day == $day) {



$mycalendar_res .= '
<div class="tooltip1 img-responsive">
<img src="https://qbtut.com/mondayserver/uploads/'.$issueRow['creator_photo'].'" class="img-thumbnail img-circle" width="50px" height="50px"/>
<p style="color:#3b5998;font-size:14px"> '.$issueRow['status'].' </p>


<div class="tooltiptext">

<img src="https://qbtut.com/mondayserver/uploads/'.$issueRow['creator_photo'].'" class="img-thumbnail img-circle" width="50px" height="50px"/><br>
<span ><b>Owner: </b> '.$issueRow['creator_name'].'</span><br>
<span  ><b style="color:orange;font-size:14px">Issue Title:</b> '.$issueRow['title'].' </span><br>
<span style="color:white;font-size:14px"><b>Status: </b> '.$issueRow['status'].' </span><br>
<span style="color:white;font-size:14px"><b>Priority: </b> '.$issueRow['priority'].' </span><br>


<span style="color:pink;font-size:12px"><b>created:</b> '.$issueRow['timer2'].' </span><br>

<span style="display:none; color:pink;font-size:12px"><b>created:</b> <span  data-livestamp="'.$issueRow['timer1'].'" ></span> </span><br>
<a title ="Click to Access Issue" class="btn btn-info btn-sm" href="/dashboardnext/'.$issueRow['id'].'/'.$issueRow['team_id'].'/'.$issueRow['creator_userid'].'">Click to Access Issue</a>
</div> 
</div></a>';


}
			}
		}
 		$calendar .= "<td>" . $day . "<br>".$mycalendar_res."</td>";
	}
	while( ($day + $offset) <= $rows * 7)
	{
		$calendar .= "<td></td>";
		$day++;
	}
	$calendar .= "</tr>";
	$calendar .= "</table><hr>";
	echo $calendar;












?>






