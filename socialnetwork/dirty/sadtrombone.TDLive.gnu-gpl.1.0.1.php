<?php
#sadtrombone.TDLive.gnu-gpl.1.0.1.php
#Copyright 2011 TDLive. Licensed under the GNU GPL.
#required app code
include("app-basics.php");
$appname="SadTrombone";
$apppage="lsadtrombone";
$user=AppUser();
?>
<html>
<head>
<title>Sad Trombone</title>
</head>
<body>
<div id="widget_sadtrombone"></div><p align="Center"><center><?php AppCreatePost("$user just got Trombone'd. :(", "Post to the Feed", $appname); ?><script type="text/javascript">

	//<![CDATA[

	    // widget width in pixels

	    var sadtrombone_width = 180;

	//]]>

	</script>

	<script type="text/javascript" src="http://www.sadtrombone.com/widget/async-sadtrombone-widget.min.js"></script>
	<?php AppExit(); ?>
</body>
</html>
