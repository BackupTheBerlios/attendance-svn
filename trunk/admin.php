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
<title>Administrator</title>
</head>
<body>
<center><h1>Administrator</h1></center>
<b>Edit a previous entry:</b>
<form action="newinsert.php" method="get">
Date: 
<select name="date">
<?php
for($i=1;$i<32;$i++)
print("<option value=\"$i\">$i\n</option>");
?>
</select>
Month:
<select name="month">
<?php
for($i=1;$i<13;$i++)
print("<option value=\"$i\">$i\n</option>");
?>
</select>
Year:
<select name="year">
<?php
for($i=2004;$i<2008;$i++)
print("<option value=\"$i\">$i\n</option>");
?>
</select>
<input type="submit" />
</form>
<br />
<?php
$date=date('d');
$month=date('m');
$year=date('Y');
$day=date('l');
if($day!='Sunday')
{	
?>
<b>
<a href="newinsert.php?<?php print("date=$date&month=$month&year=$year"); ?>"> Insert</a> today's attendance details.
</b>
<?php
}
else
{
	print("Today is a Sunday. So nothing can be entered today!");
}
?>
</body>
<html>
