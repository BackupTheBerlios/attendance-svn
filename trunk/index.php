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
<HTML>
<HEAD>
<TITLE>cnu/Attendance</TITLE>
</HEAD>
<BODY>
<H1>cnu/Attendance</H1>
This project is used to maintain the attendance record of collge students. The students can view their attendance percentage online by entering their register number.
<BR>
<CENTER>
<FORM ACTION="atten.php" METHOD="GET">
Your name:
<?php
include("db_vars.inc");
mysql_connect($hostname,$username,$password);
mysql_select_db($database);

$query="SELECT stud_regno,stud_name FROM student";
$result=mysql_query($query);
print("<SELECT NAME=\"regno\">");
while($row=mysql_fetch_row($result))
{
// print("$row[0]<br>");
 	print("<OPTION VALUE=\"$row[0]\">$row[1]\n");
}
print("</SELECT>");
?>
<!--<INPUT TYPE="TEXT" NAME="regno">-->
<INPUT TYPE=SUBMIT>
</FORM>
</CENTER>
<HR>
Also please mail your comments, improvements or bugs to <A HREF="mailto:srinivasarnr@gmail.com"> srinivasanr@gmail.com</A>.
<BR>
</BODY>
</HTML>
