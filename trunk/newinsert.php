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
include('db_vars.inc');
mysql_connect($hostname,$username,$password);
mysql_select_db($database);

//Check whether an entry for this date already exists
$db_date=mktime(0,0,0,$month,$date,$year);
$form_date="$month,$date,$year";
$day=date('l',$db_date);

$query="SELECT DISTINCT date FROM attendance WHERE date=$db_date";
$result=mysql_query($query);
$row=mysql_fetch_row($result);

if($day=='Sunday')
{
?>
<head><title>Sunday</title></head>
<body>
<center>
Today is a Sunday. So there is no college. Go learn for tomorrow's test. ;-)
<br />
<a href="admin.php">ADMINISTRATOR</a> 
<a href="index.php">INDEX</a>
</center>
</body>
</html>
<?php
}
else if(isset($row[0]))
{
//Date already exists, So edit
?>
<html>
<head>
<title>Editing attendance details for <?php print("$date-$month-$year - $day"); ?></title>
</head>
<body>
<center><h1>Editing attendance details for <?php print("$date-$month-$year - $day"); ?></h1>
<?php

//If Saturday
if($day=="Saturday")
	$num_hour=5;
else
	$num_hour=9;

$query="SELECT stud_id, stud_name FROM student";
$name_result=mysql_query($query);
$query="SELECT stud_id, hour1, hour2, hour3, hour4, hour5, hour6, hour7, hour8 FROM attendance WHERE date=$db_date";
$attendance_result=mysql_query($query);

//parse data into array
while($row=mysql_fetch_row($attendance_result))
	for($i=1;$i<$num_hour;$i++)
		$arr[$row[0]][$i]=$row[$i];
		
//Build input form
print("<form action=\"insert.php\" method=\"post\">");//need to check action attr
print("<table>\n");
$row_color="#eecccc";
$i=1;
while($row=mysql_fetch_row($name_result))
{
	//Toggle row color
	if($row_color=="#eecccc")
		$row_color="#ccccee";
	else
		$row_color="#eecccc";
	//Print row for each student
	print("<tr bgcolor=\"$row_color\">");
	print("<td><input type=\"hidden\" name=\"stud_id[$i]\" value=\"$row[0]\" />\n");
	print("<b>$row[1]</b>\n</td>\n");
	for($j=1;$j<$num_hour;$j++)
	{
		print("<td>\n");
		if($arr[$i][$j]==1)
			print("<input type=\"checkbox\" name=\"arr[$i][$j]\" />");
		else
			print("<input type=\"checkbox\" checked=\"checked\" name=\"arr[$i][$j]\" />");
		print("</td>\n");
	}
	print("</tr>\n");
	$i=$i+1;
}
//Edit this to include edit information
?>
</table>
<input type="hidden" name="mode" value="edit" />
<input type="hidden" name="date" value="<?php print($date); ?>" />
<input type="hidden" name="month" value="<?php print($month); ?>" />
<input type="hidden" name="year" value="<?php print($year); ?>" />
<font size="-2">Enter the password</Font>
<input type="PASSWORD" name="pass" />
<br />
<input type="submit" name="submit" value="submit" />
</form>
<a href="admin.php">ADMINISTRATOR</a> 
<a href="index.php">INDEX</a>
</center>
</body>
</html>
<?php
}//End of If block for editing
else
{
//If date doesn't exist display the input form
?>
<head>
<title>Inserting attendance details for <?php print("$date-$month-$year - $day"); ?></title>
</head>
<body>
<center>
<h1>Inserting attendance details for <?php print("$date-$month-$year - $day"); ?></h1>
<?php
$day=date('l',$db_date);
//If Saturday
if($day=="Saturday")
	$num_hour=5;
else
	$num_hour=9;

$query="SELECT stud_id, stud_name FROM student";
$result=mysql_query($query);

print("<form action=\"insert.php\" method=\"post\">");
print("<table>\n");
$row_color="#eecccc";
$i=1;
while($row=mysql_fetch_row($result))
{
	//Toggle row color
	if($row_color=="#eecccc")
		$row_color="#ccccee";
	else
		$row_color="#eecccc";
	//Print row for each student
	print("<tr bgcolor=\"$row_color\">");
	print("<td><input type=\"hidden\" name=\"stud_id[$i]\" value=\"$row[0]\" />\n");
	print("<b>$row[1]</b>\n</td>\n");
	for($j=1;$j<$num_hour;$j++)
	{
		print("<td>\n");
		print("<input type=\"checkbox\" name=\"arr[$i][$j]\" />");
		print("</td>\n");
	}
	print("</tr>\n");
	$i=$i+1;
}
?>
</table>
<input type="hidden" name="mode" value="insert">
<input type="hidden" name="date" value="<?php print($date); ?>">
<input type="hidden" name="month" value="<?php print($month); ?>">
<input type="hidden" name="year" value="<?php print($year); ?>">
<font size="-2">Enter the password</font>
<input type="password" name="pass">
<br />
<input type="submit" name="submit" value="Submit">
</form>
<a href="admin.php">ADMINISTRATOR</a> <a href="index.php">INDEX</a>
</center>
</body>
</html>
<?php
}//End of else block for insertion
?>
