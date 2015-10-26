<?php
#TDLive Social Network
#Copyright 2011 TDLive. Licensed under the GNU GPL.
#Get the page requested
#MAKE SURE YOU CHANGE THE PASSWORD IN USERS.PHP
$login=$_POST['login'];
if(isset($login)){
echo "<html><head><title>TDLive Social Network</title></head><body><p align='center'><center><h1>Logging in; please wait.</h1><br>";
echo "Loading file...<br>";
echo "Retrieving user variables...<br>";
$user = $_POST['user'];
$pass = $_POST['pass'];
echo "Defining file...<br>";
$myFile = "users.php";
echo "Opening file...<br>";
$fh = fopen($myFile, 'r');
echo "Defining what thedata is...<br>";
$theData = fread($fh, filesize($myFile));
echo "Closing file...<br>";
fclose($fh);
echo "Checking the user name...<br>";
if (strstr($theData, $user) && strstr($theData, $pass)) {
die("<b>Thanks for logging in, $user.</b><br><form action='socialnetwork.php' method='post'><input type='hidden' name='lid' value='1'><input type='hidden' name='p' value='lhome'><input type='hidden' name='loggedin' value='1'><input type='hidden' name='user' value='@$user'><input type='submit' value='Home'></form>");
} else {
echo "Invalid user. <a href='socialnetwork.php?p=login'>Try again?</a>";
}
exit;
}
$signedup=$_POST['signup'];
if(isset($signedup)){
echo "<html><head><title>TDLive Social Network | Signing up..</title></head><body><p align='center'><center><h1>Signing you up; please wait.</h1><br>";
echo "Loading file...<br>";
echo "Retrieving user variables...<br>";
$user = $_POST['user'];
$pass = $_POST['pass'];
echo "Defining file...<br>";
$myFile = "users.php";
echo "Opening file...";
$fh = fopen($myFile, 'r');
echo "Defining what thedata is...<br>";
$theData = fread($fh, filesize($myFile));
echo "Closing file...<br>";
fclose($fh);
echo "Checking the user name...<br>";
if (strstr($theData, $user)) {
die("The user name requested has already been used. <a href='socialnetwork.php?p=signup'>Try a different one</a>");
} else {
echo "User name not found in db.<br>";
}
echo "Opening file...<br>";
$fh = fopen($myFile, 'a') or die("ERROR! Cannot open user file.");
echo "Defining what to write to file...<br>";
$stringData = "$user,$pass\n";
echo "Writing to file...<br>";
fwrite($fh, $stringData);
echo "Closing file...<br>";
fclose($fh);
echo "Completed.<br>";
die("<a href='socialnetwork.php'>Home</a>");
}
if(isset($_POST['lid'])){
$p=$_POST['p'];
}
else{
$p=$_GET['p'];
}
#If the page is undefined
if($p == ""){
#Send it to the home page
$p="home";
#End
}
#If the page is a link page
if($p == "link"){
#Get the link variable
$link=$_GET['l'];
#Then go to the link
header("Location: $link");
#Make sure nothing goes wrong
exit;
#End of the link page
}
#If the page is a signup page
elseif($p == "signup"){
#Print the page
?>
<!-- TDLive Social Network
(c)2011 TDLive. Licensed under the GNU GPL. -->
<html>
<head>
<title>TDLive Social Network | Sign Up</title>
</head>
<body>
<p align="center"><center>
<h1>TDLive Social Network</h1>
<b>Sign Up</b><br>
all you need is a user name and password
<form name="id" action="socialnetwork.php" method="post">
<input type="text" name="user" value="User name">
<input type="password" name="pass" value="Password">
<input type="hidden" name="signup" value="signedup"><br>
<b>Remember: anything that you write can be seen by anyone.</b><br>
<input type="submit" name="submit" value="I understand; Go!">
</form>
</body>
</html>
<?php
}
#if the page is the home page
elseif($p == "home"){
$lin=$_POST['loggedin'];
if(isset($lin)){
header("Location: socialnetwork.php?p=lhome");
}
?>
<html>
<head>
<title>TDLive Social Network | Home</title>
</head>
<body>
<p align="center"><center><h2>the new social network</h2><br><h1>TDLive Social Network</h1><a href="socialnetwork.php?p=signup">sign up now</a> or <a href="socialnetwork.php?p=login">log in</a>
</body>
</html>
<?php
exit;
}
elseif($p == "login"){
?>
<html>
<head>
<title>TDLive social network | Log in</title>
</head>
<body>
<h1><p align="center"><Center>Log in</h1>
<form name="id" action="socialnetwork.php" method="post">
<input type="text" name="user" value="User name">
<input type="password" name="pass" value="Password">
<input type="hidden" name="login" value="loggedin"><br>
<input type="submit" name="submit" value="Log in!">
</form>
</center>
</p>
<?php
exit;
}
elseif($p == "lhome"){
$lin=$_POST['loggedin'];
if(!isset($lin)){
header("Location: socialnetwork.php?p=login");
}
$user=$_POST['user'];
?>
<html>
<head>
<title>TDLive social network | <?php echo $user; ?>'s home</title>
</head>
<body>
<p align="center"><center><h6>TDLive Social Network | Hey, <?php echo $user; ?>! <a href="socialnetwork.php">Not <?php echo $user ?>?</a></h6></p></center>
<p align="center"><center><b><?php echo $user; ?>'s</b> <i>network</i><br></p></center>
<form action='socialnetwork.php' method='post'><i>Text <b>to post</b>:</i><input type="text" name="post"><input type='hidden' name='lid' value='1'><input type='hidden' name='p' value='lpost'><input type='hidden' name='loggedin' value='1'><input type='hidden' name='user' value="<?php echo $user; ?>"><input type='submit' value='Post'></form><form action='socialnetwork.php' method='post'>
<input type='hidden' name='lid' value='1'>
<input type='hidden' name='p' value='lhome'>
<input type='hidden' name='loggedin' value='1'>
<input type='hidden' name='user' value="<?php echo $user; ?>">
<input type='submit' value='Refresh'></form><br>
<?php
if($user == "@adm"){
?>
<form action='socialnetwork.php' method='post'><input type='hidden' name='lid' value='1'><input type='hidden' name='p' value='laprune'><input type='hidden' name='loggedin' value='1'><input type='hidden' name='user' value="<?php echo $user; ?>"><input type='submit' value='Prune posts'></form>
<?php
}
?>
<i><u>Apps</u></i><br>

<form action='socialnetwork.php' method='post'>
<input type='hidden' name='lid' value='1'>
<input type='hidden' name='p' value='lexample-app'>
<input type='hidden' name='loggedin' value='1'>
<input type='hidden' name='user' value="<?php echo $user; ?>">
<input type='submit' value='PostButton'></form>
<form action='socialnetwork.php' method='post'>
<input type='hidden' name='lid' value='1'>
<input type='hidden' name='p' value='lme'>
<input type='hidden' name='loggedin' value='1'>
<input type='hidden' name='user' value="<?php echo $user; ?>">
<input type='submit' value='Me!'></form>
<form action='socialnetwork.php' method='post'>
<input type='hidden' name='lid' value='1'>
<input type='hidden' name='p' value='lsadtrombone'>
<input type='hidden' name='loggedin' value='1'>
<input type='hidden' name='user' value="<?php echo $user; ?>">
<input type='submit' value='SadTrombone'></form>
<br><br>
<b><i>Posts from users</b> like you</i><br>
<?php include("posts.php"); ?>
</body>
</html>
<?php
exit;
}
elseif($p == "lpost"){
$lin=$_POST['loggedin'];
if(!isset($lin)){
header("Location: socialnetwork.php?p=login");
}
$post=$_POST['post'];
$user=$_POST['user'];
$via=$_POST['via'];
$via2=$_POST["via2"];
$user="$user";
$via2="$via2";
$myFile="posts.php";
$fh = fopen($myFile, 'a') or die("ERROR! Cannot open posts file.");
if($user == "@adm"){
$stringData = "<i>$user</i> [<B>ADM</B>]: $post";
}
else{
$stringData = "<i>$user</i>: $post";
}
if(isset($via)){
$stringData = "$stringData <font color='gray'>(via $via2)</font><br>\n";
}
else{
$stringData = "$stringData<br>\n";
}
if (strstr("<?php", $post) || strstr("?>", $post)) {
header("Location: socialnetwork.php?p=lno-php");
exit;
} 
if (strstr("<", $post) || strstr("/>", $post) || strstr(">", $post) || strstr("<a", $post) || strstr("<a href=", $post) || strstr("<a onClick=", $post)) {
header("Location: socialnetwork.php?p=lno-html");
exit;
} 
fwrite($fh, $stringData);
fclose($fh);
?>
<html>
<head>
<title>TDLive social network | Post successful!</title>
</head>
<body>
<p align="center"><center><i>Your <b>post</b>, "<u><?php echo $post; ?></u>" has been <b>posted</b> successfully.</i>
<form action='socialnetwork.php' method='post'><input type='hidden' name='lid' value='1'><input type='hidden' name='p' value='lhome'><input type='hidden' name='loggedin' value='1'><input type='hidden' name='user' value="<?php echo $user; ?>"><input type='submit' value='Home'></form>
</body>
</html>
<?php
exit;
}
elseif($p == "laprune"){
$user=$_POST['user'];
$lin=$_POST['loggedin'];
if(!isset($lin)){
header("Location: socialnetwork.php?p=login");
}
elseif($user != "@adm"){
header("Location: socialnetwork.php?p=login");
}
$lin="$";
$lin2="lin";
$post="<?php if(!isset($lin$lin2)){ header('Location: /socialnetwork.php?p=login'); } ?>";
$user="$user";
$myFile="posts.php";
$fh = fopen($myFile, 'w') or die("ERROR! Cannot open posts file.");
fwrite($fh, $post);
fclose($fh);
?>
<html>
<head>
<title>TDLive social network | Post pruning complete</title>
</head>
Posts pruned.<br>
<form action='socialnetwork.php' method='post'><input type='hidden' name='lid' value='1'><input type='hidden' name='p' value='lhome'><input type='hidden' name='loggedin' value='1'><input type='hidden' name='user' value="<?php echo $user; ?>"><input type='submit' value='Home'></form>
<?php
exit;
}
elseif($p == "lno-php"){
?>
<html>
<head>
<title>TDLive social network | Sorry, no PHP allowed</title>
</head>
<body>
<p align="center"><center>Sorry, no PHP is allowed on TDLive social network to help prevent security vulnerabilities.<br><a href="socialnetwork.php?p=login">Log in.</a></p></center>
</body>
</html>
<?php
}
elseif($p == "lno-html"){
?>
<html>
<head>
<title>TDLive social network | Sorry, no HTML allowed</title>
</head>
<body>
<p align="center"><center>Sorry, no HTML is allowed on TDLive social network to help prevent security vulnerabilities.<br><a href="socialnetwork.php?p=login">Log in.</a></p></center>
</body>
</html>
<?php
}
#Note that the naming scheme for apps is name-of-app.author.license.release.major.minor
#and that apps that require you to log in start with an 'l' e.g. example-app => lexample-app
#App Installation: Begin Code
elseif($p == "lexample-app"){
include("app.TDLive.gnu-gpl.0.0.0.php");
exit;
}
elseif($p == "lme"){
include("me.TDLive.gnu-gpl.1.0.1.php");
exit;
}
elseif($p == "lsadtrombone"){
include("sadtrombone.TDLive.gnu-gpl.1.0.1.php");
exit;
}
#App Installation: End Code
else{
?>
<html>
<head>
<title>TDLive social network | 404 not found</title>
<body>
<p align="center"><center><i>This is <b>not</b> the page you were looking for.</p></center><br><a href="javascript:history.go(-1)">Get me back to where I was!</a>
<?php
}
?>
