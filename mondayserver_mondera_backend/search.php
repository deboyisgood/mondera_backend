

<script>
//hide serach result starts here


$(document).ready(function(){
$('.search_hide_btn1').click(function(){

$('.search_hide').hide();
});
});


</script>





<?php
include('data6rst.php');
if($_POST)
{

$search=strip_tags($_POST['search_data']);
$ss=strip_tags($_POST['ss']);

// characters capable of causing sql injection
/*
single quote(')
double quote(")
underscore(_)
percent(%)
backslash(\)
*/
if($search == ''){

echo "<div id='alerts_search' class='alerts alert-danger'>Searched Text cannot be empty...</div>";
exit();

}

//check presence of any of this evil characters before passing to prepared statement
$single = substr_count($search,"'");
if($single >0){
echo "<div id='alerts_search' class='alerts alert-danger'>Single Attack Detected...</div>";
exit();
}

$double = substr_count($search,'"');
if($double >0){
echo "<div id='alerts_search' class='alerts alert-danger'>Double Attack Detected...</div>";
exit();
}

/*
$underscore = substr_count($search,"_");
if($underscore >0){
echo "<div id='alerts_search' class='alerts alert-danger'>underscore Attack Detected...</div>";
exit();
}
*/


$percent = substr_count($search,"%");
if($percent >0){
echo "<div id='alerts_search' class='alerts alert-danger'>Percent Attack Detected...</div>";
exit();
}


$backslash = substr_count($search,"\\");
if($backslash >0){
echo "<div id='alerts_search' class='alerts alert-danger'>backslash Attack Detected...</div>";
exit();
}

//echo "<br><br><div class='search_hide_btn1 btn btn-sm btn-warning'>close Search</div>";


echo "<br><br>";
$result = $db->prepare('SELECT * FROM issues where title like :title OR creator_name like :creator_name OR status like :status OR priority like :priority OR project_name like :project_name OR start_date like :start_date OR end_date like :end_date limit 20');
$result->execute(array(
':title' => '%'.$search.'%',
':creator_name' => '%'.$search.'%',
':status' => '%'.$search.'%',
':priority' => '%'.$search.'%',
':project_name' => '%'.$search.'%',
':start_date' => '%'.$search.'%',
':end_date' => '%'.$search.'%',
));

$count = $result->rowCount();




if (strlen($search)< 2) {
    //echo "less than 2";
echo "<div class='searching_res_p search_hide'>Enter Issues Data to Search More<br>

<span class='search_hide_btn1 btn btn-sm btn-warning pull-right'>close</span>
</div>";
}


elseif ($count > 0)
{

 // while starts here
while ($row = $result->fetch()) 
    {
$issueid = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$title = htmlentities(htmlentities($row['title'], ENT_QUOTES, "UTF-8"));
$name = htmlentities(htmlentities($row['creator_name'], ENT_QUOTES, "UTF-8"));
$photo = htmlentities(htmlentities($row['creator_photo'], ENT_QUOTES, "UTF-8"));
$status = htmlentities(htmlentities($row['status'], ENT_QUOTES, "UTF-8"));
$priority = htmlentities(htmlentities($row['priority'], ENT_QUOTES, "UTF-8"));
$project_name = htmlentities(htmlentities($row['project_name'], ENT_QUOTES, "UTF-8"));
$team_id = htmlentities(htmlentities($row['team_id'], ENT_QUOTES, "UTF-8"));
$userid = htmlentities(htmlentities($row['creator_userid'], ENT_QUOTES, "UTF-8"));


$d_name ="Searched Issues";
 
        echo "
<div class='searching_res_p search_hide'>


<a href='/dashboardnext/$issueid/$team_id/$userid' title='Access Issues Now'>
<img class='img-circle' src='https://qbtut.com/mondayserver/uploads/$photo' style='width:40px;height:40p; float:left; margin-right:6px' />$d_name<br/>
<span style='font-size:12px; color:white'>Owner: $name</span><br>
<span style='font-size:16px; color:white'>Project Name: $project_name</span><br>
<span style='font-size:12px; color:orange'>Title: $title</span><br>
<span style='font-size:12px; color:grey'>Status: $status</span><br>
<span style='font-size:12px; color:grey'>Priority: $priority</span><br>

<span class='search_hide_btn1 btn btn-sm btn-warning pull-right'>close</span>
</a>
</div>";

    }       

// while ends here


}else{

echo "<div id='alerts_search' class='alerts alert-danger searching_res_p1 search_hide'>Searched Issues not Found... 
<span class='search_hide_btn1 btn btn-sm btn-warning pull-right'>close</span>
</div>";

}





}
?>
