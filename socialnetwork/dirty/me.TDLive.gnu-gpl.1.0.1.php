<?php
#me.TDLive.gnu-gpl.1.0.1.php
#Copyright 2011 TDLive. Licensed under the GNU GPL.
#Required app code
include("app-basics.php");
#Set the app name
$appname="Me!";
#Get the user name
$apppage="lme";
$user=AppUser();
if(!isset($_POST['nap'])){
?>
<html>
<head>
<title>Me!</title>
</head>
<body>
<p align="center"><center><h1>Me!<br>
<?php AppLink($apppage); ?>
<?php echo $user; ?>...
<input type="text" name="is">
<input type="hidden" name="nap" value="1">
<input type="submit" name="submit" value="Post!">
</form>
<?php AppExit(); ?>
</body>
</html>
<?php
}
else{
$is=$_POST['is'];
$stringtopost="$user $is.";
?>
<html>
<head>
<title>Me! | <?php echo $stringtopost; ?></title>
</head>
<body>
<p align="center"><center>
<?php AppCreatePost($stringtopost, "Ready to post $stringtopost?", $appname); ?>
</p></center>
<?php AppExit(); ?>
</body>
</html>
<?php
exit;
}
?>
