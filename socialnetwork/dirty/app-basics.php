<?php
$lin=$_POST['loggedin'];
if(!isset($lin)){
header("Location: socialnetwork.php?p=login");
}
#To create a post button, call createPost('what to post', 'button label', $appname-should-be-defined);
function AppCreatePost($what, $label, $appname){
$user=AppUser();
?>
<form action="socialnetwork.php" method="post">
<input type="hidden" name="post" value="<?php echo $what; ?>">
<input type='hidden' name='lid' value='1'>
<input type='hidden' name='p' value='lpost'>
<input type='hidden' name='loggedin' value='1'>
<input type='hidden' name='user' value="<?php echo $user; ?>">
<input type="hidden" name="via" value="1">
<?php
?>
<input type='hidden' name="via2" value="<?php echo $appname; ?>">
<input type='submit' value="<?php echo $label; ?>"></form>
<?php
}
#To get the user call User on a variable (e.g. $user=User();)
function AppUser(){
$user=$_POST['user'];
return $user;
}
function AppSet($app){
$appname=$app;
}
function AppReEcho($echo){
return $echo;
}
#Link to a page by calling AppLink([YOUR PAGE HERE]). Since the <form> tag isn't closed, you can add parameters to pass.
function AppLink($apppage){
$user=AppUser();
?>
<form action="socialnetwork.php" method="post">
<input type="hidden" name="lid" value="1">
<input type="hidden" name="p" value="<?php echo $apppage; ?>">
<input type="hidden" name="loggedin" value="1">
<input type="hidden" name="user" value="<?php echo $user; ?>">
<?php
}
function AppExit(){
$user=AppUser();
?>
<form action="socialnetwork.php" method="post">
<input type='hidden' name='lid' value='1'>
<input type='hidden' name='p' value='lhome'>
<input type='hidden' name='loggedin' value='1'>
<input type='hidden' name='user' value="<?php echo $user; ?>">
<input type='submit' value="Home"></form>
<?php
}
