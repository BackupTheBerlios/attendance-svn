<!--
############################################################################
#    Copyright (C) 2004 by Srinivasan                                      #
#    srinivasanr@gmail.com                                                 #
#                                                                          #
#    This program is free software; you can redistribute it and#or modify  #
#    it under the terms of the GNU General Public License as published by  #
#    the Free Software Foundation; either version 2 of the License, or     #
#    (at your option) any later version.                                   #
#                                                                          #
#    This program is distributed in the hope that it will be useful,       #
#    but WITHOUT ANY WARRANTY; without even the implied warranty of        #
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         #
#    GNU General Public License for more details.                          #
#                                                                          #
#    You should have received a copy of the GNU General Public License     #
#    along with this program; if not, write to the                         #
#    Free Software Foundation, Inc.,                                       #
#    59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             #
############################################################################
-->
<?php

printHeader();
echo "<H1>Hello World</H1>";
printFooter();

function printHeader(){
  echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\"\n" .
    "\"http://www.w3.org/TR/REC-html40/loose.dtd\"><HTML>\n" . 
    "<HEAD>\n" .
    "<meta name=\"description\" content=\"\" >\n" .
    "<meta name=\"author\" content=\"Srinivasan\">\n" .
    "<meta name=\"keywords\" content=\"\" >\n" .
    "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\n" .
    "<TITLE>attendance</TITLE>\n" .
    "</HEAD>\n". 
    "<BODY>\n";
}

function printFooter(){
  echo "\n</BODY></HTML>";
}

?>
