
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
<title>cnu/Attendance</title>
</head>
<body>
<h1>cnu/Attendance</h1>
This project is used to maintain the attendance record of collge students. The students can view their attendance percentage online by entering their register number.
<br />
<center>
<form action="atten.php" method="get">
Your name:
<?php
include("db_vars.inc");
mysql_connect($hostname,$username,$password);
mysql_select_db($database);

$query="SELECT stud_regno,stud_name FROM student";
$result=mysql_query($query);
print("<select name=\"regno\">");
while($row=mysql_fetch_row($result))
{
// print("$row[0]<br>");
 	print("<option value=\"$row[0]\">$row[1]</option>\n");
}
print("</select>");
?>
<!--<INPUT TYPE="TEXT" NAME="regno">-->
<input type="submit" />
</form>
</center>
<hr />
Also please mail your comments, improvements or bugs to <a href="mailto:srinivasarnr@gmail.com"> srinivasanr@gmail.com</a>.
<br />
</body>
</html>
