<?php
/*
= Footer for LuxCal event calendar pages =

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu
*/

echo "</div>\n";
switch ($ftrType) { //footer types - 0: no, f: full 
	case '0':
		break;
	case 'f':
		echo "<footer class='noPrint'>\n";
		echo "<span class='floatR'><a href='http://www.luxsoft.eu' target='_blank'><span title='V".LCV."'>p</span>owered by <span class='footLB'>Lux</span><span class='footLR'>Soft</span></a></span>\n";
		if ($privs > 0 and $set['rssFeed']) {
			echo "<span class='floatL'><a href='rssfeed.php{$cF}' title='RSS feed' target='_blank'>RSS</a></span>\n";
		}
		echo "</footer>\n";
}
unset($ftrType);
?>
</body>
</html>
