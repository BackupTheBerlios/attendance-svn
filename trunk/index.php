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
<TITLE>CSECDept - Attendance</TITLE>
</HEAD>
<BODY>
<H1>CSECDept - Attendance</H1>
This project is intended to maintain an unofficial attendance record of all the students of CSECDept. The students can view their attendance percentage, without having to wait for that to be put up in the notice board. The database will be updated daily. Note that the percentage we calculate here may not be equal to the official one. <BR>
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
<BR>
Also please mail your comments, improvements or bugs to <A HREF="mailto:srinivasarnr@gmail.com"> srinivasanr@gmail.com</A>.
<BR>
</BODY>
</HTML>
