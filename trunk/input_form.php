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
<TITLE>INSERT ATTENDANCE DETAILS - <?php
$date=date('d-m-Y');
print($date);
?></TITLE>
</HEAD>
<BODY>
<CENTER><H1>Attendance details for <?php print($date); ?></h1>
Enter the attendance details for every student. Check the box if s/he <b>was</b> absent for that particular hour, Else leave it unchecked.<BR>
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

print("<FORM ACTION=\"insert.php\" METHOD=\"POST\">");
print("<TABLE>\n");
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
	print("<TR bgcolor=\"$row_color\">");
	print("<td><INPUT TYPE=\"HIDDEN\" NAME=\"stud_id[$i]\" VALUE=\"$row[0]\">\n");
	print("<b>$row[1]</b>\n</td>\n");
	for($j=1;$j<$num_hour;$j++)
	{
		print("<TD>\n");
		print("<INPUT TYPE=\"CHECKBOX\" NAME=\"arr[$i][$j]\">");
		print("</TD>\n");
	}
	print("</TR>\n");
	$i=$i+1;
}
?>
</TABLE>
<INPUT TYPE="HIDDEN" NAME="form_date" VALUE="<?php print($form_date); ?>">
<font size=2>Enter the password(to prevent unauthorised entry into the database</font><INPUT TYPE="PASSWORD" NAME="password"><BR>
<INPUT TYPE="SUBMIT" NAME="SUBMIT">
</FORM>
</CENTER>
</BODY>
</html>