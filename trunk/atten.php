<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
/*
  ===========================

  cnu/Attendance
  http://attendance.berlios.de

  Developed by Srinivasan (cnu)
  Email   : srinivasanr@gmail.com
  Website : http://cnuker.freeserverhost.com

  Copyright (C) 2004 by Srinivasan <srinivasanr@gmail.com>

  ===========================
*/
?>

<?php
//Database variables
include('db_vars.inc');
mysql_connect($hostname,$username,$password);
mysql_select_db($database);

$query="SELECT stud_name FROM student WHERE stud_regno=$regno";
$result=mysql_query($query);
$row=mysql_fetch_row($result);
$name=$row[0];
if(!isset($name))
	$valid=false;
else
	$valid=true;
?>
<head>
<title>Attendance details for <?php print($name); ?></title>
</head>
<body>

<?php
if($valid)
{
print("<center><h1>Attendance details for $name </h1></center>");

//Query needs to be checked and rewritten
//$query="SELECT date,hour1,hour2,hour3,hour4,hour5,hour6,hour7,hour8 FROM attendance WHERE ";
//$query.="stud_id='SELECT stud_id FROM student WHERE stud_regno=$regno'";
$query="SELECT stud_id FROM student WHERE stud_regno=$regno";
$result=mysql_query($query);
$row=mysql_fetch_row($result);

$stud_id=$row[0];
$query="SELECT date,hour1,hour2,hour3,hour4,hour5,hour6,hour7,hour8 FROM attendance WHERE stud_id=$stud_id";
$result=mysql_query($query);
$fields=mysql_num_fields($result);

$i=0;

// Algorithm for calculating the perecntage
// Currently if the student is absent for any hour during the first or second session
// (4 hours), then the entire session is marked as absent.

while($row=mysql_fetch_row($result))
{
	if($row[1]==0||$row[2]==0||$row[3]==0||$row[4]==0)//First session absent
		for($j=1;$j<5;$j++)
			$row[$j]=0;
	
	if($row[5]==0||$row[6]==0||$row[7]==0||$row[8]==0)//Second session absent
		for($j=5;$j<9;$j++)
			$row[$j]=0;
	
	if($row[5]==-1)
		$num_hour=5;
	else
		$num_hour=9;
		
	for($j=1;$j<$num_hour;$j++)
	{
		if($row[$j]==0)
		{
			$absent_count[$i]=$absent_count[$i]+1;
		}
	}
	$percentage[$i]=$absent_count[$i]/($num_hour-1)*100;
	$percentage[$i]=100-$percentage[$i];
	$i=$i+1;
}

//Calculate the final attendance
$num_days=$i;
for($i=0;$i<$num_days;$i++)
	$total_attendance=$total_attendance+$percentage[$i];
$average_attendance=$total_attendance/$num_days;
$tomorrow_attendance=$total_attendance/($num_days+1);
//Print the attendance percentage
printf("Your attendance percentage is :<font size=\"14\">%3.2f</font><br />\n",$average_attendance);
printf("If you are absent tomorrow, then you attendance percentage may drop to <font size =\"14\">%3.2f</font><br />\n",$tomorrow_attendance);
$previous_no=$regno-1;
$next_no=$regno+1;
print("<center>");
print("<a href=\"atten.php?regno=$previous_no\">Previous</a> | <a href=\"atten.php?regno=$next_no\">Next</a>");
print("</center>");
}
else
{
print("INVALID REGISTER NUMBER. PLEASE PRESS BACK TO CHOOSE YOUR CORRECT REGISTER NUMBER/NAME");
}
?>
<hr />
Click here to go back to the <a href="index.php">main page</a>
</body>
</html>
