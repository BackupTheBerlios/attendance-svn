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
<HTML>
<HEAD>
<TITLE>Attendance details for <?php print($name); ?></TITLE>
</HEAD>
<BODY>

<?php
if($valid)
{
print("<CENTER><H1>Attendance details for $name </H1></CENTER>");

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
// 	print($percentage[$i] . "<BR>");
	$i=$i+1;
}

//Calculate the final attendance
$num_days=$i;
for($i=0;$i<$num_days;$i++)
	$total_attendance=$total_attendance+$percentage[$i];
$average_attendance=$total_attendance/$num_days;
$tomorrow_attendance=$total_attendance/($num_days+1);
//Print the attendance percentage
printf("Your attendance percentage is :<FONT SIZE=14>%3.2f</FONT><BR>\n",$average_attendance);
printf("If you are absent tomorrow, then you attendance percentage may drop to <FONT SIZE =14>%3.2f</FONT><BR>\n",$tomorrow_attendance);
}
else
{
print("INVALID REGISTER NUMBER. PLEASE PRESS BACK TO ENTER YOUR CORRECT REGISTER NUMBER");
}
?>
<HR>
Click here to go back to the <A HREF="index.php">main page</A>
</BODY>
</HTML>
