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
<TITLE>Administrator</TITLE>
</HEAD>
<BODY>
<CENTER><H1>Administrator</H1></CENTER>
<B>Edit a previous entry:</B>
<FORM ACTION="newinsert.php" METHOD="GET">
Date: 
<SELECT NAME="date">
<?php
for($i=1;$i<32;$i++)
print("<OPTION VALUE=\"$i\">$i\n");
?>
</SELECT>
Month:
<SELECT NAME="month">
<?php
for($i=1;$i<13;$i++)
print("<OPTION VALUE=\"$i\">$i\n");
?>
</SELECT>
Year:
<SELECT NAME="year">
<?php
for($i=2004;$i<2008;$i++)
print("<OPTION VALUE=\"$i\">$i\n");
?>
</SELECT>
<INPUT TYPE=SUBMIT>
</FORM>
<BR>
<?php
$date=date('d');
$month=date('m');
$year=date('Y');
$day=date('l');
if(!$day=='Sunday')
{	
?>
<B>
<A HREF="newinsert.php?<?php print("date=$date&month=$month&year=$year"); ?>"> Insert</A> today's attendance details.
</B>
<?php
}
else
{
	print("Today is a Sunday. So nothing can be entered today!");
}
?>
</BODY>
<HTML>
