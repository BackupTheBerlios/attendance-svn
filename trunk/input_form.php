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
<head>
<title>Insert Attendance Details - <?php
$date=date('d-m-Y');
print($date);
?>
</title>
</head>
<body>
<center><h1>Attendance details for <?php print($date); ?></h1>
Enter the attendance details for every student. Check the box if s/he <b>was</b> absent for that particular hour, Else leave it unchecked.<br />
<?php 
$form_date=date('m,d,Y');
$day=date('l',time());
//Database connection
include('db_vars.inc');
mysql_connect($hostname,$username,$password);
mysql_select_db($database);

//If Saturday
if($day=="Saturday")
	$num_hour=5;
else
	$num_hour=9;

$query="SELECT stud_id, stud_name FROM student";
$result=mysql_query($query);

print("<form action=\"insert.php\" method=\"post\">");
print("<table>\n");
$row_color="eecccc";
$i=1;
while($row=mysql_fetch_row($result))
{
	//Toggle row color
	if($row_color=="eecccc")
		$row_color="ccccee";
	else
		$row_color="eecccc";
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
<input type="hidden" name="form_date" value="<?php print($form_date); ?>" />
<font size="2">Enter the password(to prevent unauthorised entry into the database</font>
<input type="password" name="password" />
<br />
<input type="submit" name="submit" />
</form>
</center>
</body>
</html>