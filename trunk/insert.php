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
$db_date=mktime(0,0,0,$month,$date,$year);
$date=date('d-m-Y',$db_date);
$day=date("l",$db_date);
//Database variables
include("db_vars.inc");
mysql_connect($hostname,$username,$password);
mysql_select_db($database);

if($mode=="edit")
{//Edit the information already present in the database
?>
<HTML>
<HEAD>
<TITLE>
Updated the database for <?php print($date); ?>
</TITLE>
</HEAD>
<BODY>
<CENTER><H1>Updating Attendance details <?php print($date); ?></h1>
<?php 

if($pass=='alohomora')
{
	$i=1;
	while(isset($stud_id[$i]))
	{
		if($day!="Saturday")
		{
			for($j=1;$j<9;$j++)
			{
				if(isset($arr[$i][$j]))
					$arr[$i][$j]=0;
				else
					$arr[$i][$j]=1;
			}
			$query="UPDATE attendance SET hour1=".$arr[$i][1];
			$query.=",hour2=".$arr[$i][2].",hour3=".$arr[$i][3].",hour4=".$arr[$i][4].",hour5=".$arr[$i][5].",hour6=".$arr[$i][6].",hour7=".$arr[$i][7].",hour8=".$arr[$i][8]." WHERE stud_id=$stud_id[$i]";
			$result=mysql_query($query);
			
			//print("<BR>$query");
		}
		else
		{
			for($j=1;$j<5;$j++)
			{
				if(isset($arr[$i][$j]))
					$arr[$i][$j]=0;
				else
					$arr[$i][$j]=1;
			}
			$query="UPDATE attendance SET hour1=".$arr[$i][1];
			$query.=",hour2=".$arr[$i][2].",hour3=".$arr[$i][3].",hour4=".$arr[$i][4]." WHERE stud_id=$stud_id[$i]";
			$result=mysql_query($query);
			//print("<BR>$query");
		}
	$i=$i+1;
	}
}
else
{
	
	print('Sorry authentication failed. Are you authorised to insert the details??');
	print('<BR>Press Back to try again');
}
?>
<?php
}//End of if block(editing)
else if($mode=="insert")
{
?>
<HTML>
<HEAD>
<TITLE>
Inserted into the database for <?php print($date); ?>
</TITLE>
</HEAD>
<BODY>
<CENTER><H1>Inserting Attendance details <?php print($date); ?></h1>
<?php
if($pass=='alohomora')
{
	$i=1;
	while(isset($stud_id[$i]))
	{
		if($day!="Saturday")
		{//Weekdays
			for($j=1;$j<9;$j++)
			{
				if(isset($arr[$i][$j]))
					$arr[$i][$j]=0;
				else
					$arr[$i][$j]=1;
	//			print("<br>".$arr[$i][$j]);
			}
			$query="INSERT INTO attendance (stud_id,date,hour1,hour2,hour3,hour4, hour5,hour6,hour7, hour8) VALUES ($stud_id[$i],$db_date,";
			$query.=$arr[$i][1].",".$arr[$i][2].",".$arr[$i][3].",".$arr[$i][4].",".$arr[$i][5].",".$arr[$i][6].",".$arr[$i][7].",".$arr[$i][8].")";
			$result=mysql_query($query);
	//		print("<BR>".$query);
		}
		else
		{//Saturday
			for($j=1;$j<5;$j++)
			{
				if(isset($arr[$i][$j]))
					$arr[$i][$j]=0;
				else
					$arr[$i][$j]=1;
				//print("<br>".$arr[$i][$j]);
			}
			for($j=5;$j<9;$j++)
				$arr[$i][$j]=-1;
			$query="INSERT INTO attendance (stud_id,date,hour1,hour2,hour3,hour4, hour5,hour6,hour7, hour8) VALUES ($stud_id[$i],$db_date,";
			$query.=$arr[$i][1].",".$arr[$i][2].",".$arr[$i][3].",".$arr[$i][4].",".$arr[$i][5].",".$arr[$i][6].",".$arr[$i][7].",".$arr[$i][8].")";
			//print("<BR>".$query);
			$result=mysql_query($query);
		}
	$i=$i+1;
	}
}
else
{

	print('Sorry authentication failed. Are you authorised to insert the details??');
	print('<BR>Press Back to try again');
}
}//End of else block(inserting)	
?>

<!--Common to both-->
<A HREF="admin.php">ADMIN</A>
</CENTER>
</BODY>
</HTML>
