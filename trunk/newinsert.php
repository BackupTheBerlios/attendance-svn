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
$query="SELECT DISTINCT date FROM attendance WHERE date=$db_date";
$result=mysql_query($query);
$row=mysql_fetch_row($result);

if(isset($row[0]))
{
//Date already exists, So edit
?>
<HTML>
<HEAD>
<TITLE>Editing attendance details for <?php print("$date-$month-$year"); ?></TITLE>
</HEAD>
<BODY>
<CENTER><H1>Editing attendance details for <?php print("$date-$month-$year"); ?></H1>
<?php
$day=date('l',$db_date);
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
print("<FORM ACTION=\"insert.php\" METHOD=\"POST\">");//need to check action attr
print("<TABLE>\n");
$row_color="eecccc";
$i=1;
while($row=mysql_fetch_row($name_result))
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
		if($arr[$i][$j]==1)
			print("<INPUT TYPE=\"CHECKBOX\" NAME=\"arr[$i][$j]\">");
		else
			print("<INPUT TYPE=\"CHECKBOX\" CHECKED NAME=\"arr[$i][$j]\">");
		print("</TD>\n");
	}
	print("</TR>\n");
	$i=$i+1;
}
//Edit this to include edit information
?>
</TABLE>
<INPUT TYPE="HIDDEN" NAME="mode" VALUE="edit">
<?php
}//End of If block for editing
else
{
//If date doesn't exist display the input form
?>
<HTML>
<HEAD>
<TITLE>Inserting attendance details for <?php print("$date-$month-$year"); ?></TITLE>
</HEAD>
<BODY>
<CENTER><H1>Inserting attendance details for <?php print("$date-$month-$year"); ?></H1>
<?php
$day=date('l',$db_date);
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
<INPUT TYPE="HIDDEN" NAME="mode" VALUE="insert">
<?php
}//End of else block for insertion
?>

<!--common to both edit and insert-->
<INPUT TYPE="HIDDEN" NAME="date" VALUE="<?php print($date); ?>">
<INPUT TYPE="HIDDEN" NAME="month" VALUE="<?php print($month); ?>">
<INPUT TYPE="HIDDEN" NAME="year" VALUE="<?php print($year); ?>">
<FONT size=-2>Enter the password</FONT><INPUT TYPE="PASSWORD" NAME="pass"><BR>
<INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE="SUBMIT">
</FORM>
<A HREF="admin.php">ADMINISTRATOR</A> <A HREF="index.php">INDEX</A>
</CENTER>
</BODY>
</HTML>
