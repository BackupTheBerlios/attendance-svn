<!--
// +----------------------------------------------------------------------
// | PHP Source                                                           
// +----------------------------------------------------------------------
// | Copyright (C) 2004 by Srinivasan <srinivasanr@gmail.com>
// +----------------------------------------------------------------------
// |
// | Copyright: See COPYING file that comes with this distribution
// +----------------------------------------------------------------------
//
-->
<HTML>
<BODY>
<FORM>
<INPUT TYPE=TEXTBOX NAME="regno">
<INPUT TYPE=TEXTBOX NAME="name">
<INPUT TYPE=SUBMIT>
</FORM>
<?php
/*for($i=0;$i<3;$i++)
	print("<INPUT TYPE=textbox name=textbox[$i]><br>");*/
mysql_connect('localhost','root','5r1n1v454n');
mysql_select_db('attendance');
$query="INSERT INTO student(stud_regno,stud_name) VALUES ($regno,$name)";
//$result
$result=mysql_query($query);
?>







</BODY>
</HTML>