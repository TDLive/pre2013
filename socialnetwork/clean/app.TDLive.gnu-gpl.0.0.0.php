<?php
#Set the app name
#app.TDLive.gnu-gpl.0.0.0.php
#Copyright 2011 TDLive. Licensed under the GNU GPL.

#Social Network required code
include("app-basics.php");
$appname="PostButton";
#Get the app user
$user=AppUser();
?>
<html>
<head>
<title>My Special Example App</title>
</head>
<body>
<?php AppCreatePost("I am $user. Fear me!", "I am $user. Fear me!", $appname); ?>
<?php AppCreatePost("I love $user.", "I love $user.", $appname); ?>
<?php AppCreatePost("$user is aw'sum.", "$user is aw'sum.", $appname); ?>
</body>
</html>
