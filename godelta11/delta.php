<?php 
<?php

#TDLive Go Delta 11 (BETA)
#(c)2012 TDLive Development, Inc.

#This program is BETA SOFTWARE, please DO NOT use on production server(s).

#TDLive Development can not and will not be liable for any error(s) or data
#loss. Use at your own risk.

#Licensed under the GNU GPL v3. The full license is available at <http://gnu.org/licenses/gpl>.

#INSTALL:

#1. Place this file in any directory (NOT the root for security reasons) on your server.
#2. CHMOD the folder that you put it in to 777 (drwxrwxrwx).
#3. Edit the configuration settings below to your needs.
#All done! Were you expecting more steps? Sorry to dissapoint.

#CODE

#Function: godelta_Settings
#Syntax: godelta_Settings(string $setting)
#Description: Sets general settings for the site. Edit this function to fit your needs.

function godelta_Settings($setting){

$settings=Array(
#Start editing now!
"site_location" => "/var/www/delta_beta", #the directory where Go Delta is situated (remember to CHMOD)
"site_webloc" => "http://mysite.com/delta_beta/index.php", #the URL where Go Delta is situated
"site_name" => "TDLive Go Delta 11", #site name
"site_admin" => "TDLive Development, Inc.", #name of site admin
#Used to be "required username/password", that was stupid
"allow_registration" => true, #Allow registration? (Probably yes.)
"registration_classcode" => "687dhv84", #Class code (if allow_registration is true)
#All done!
"version" => "11.0.34" #This will ALWAYS be behind.
);
  #Check if the setting string is empty.
	if(! @isset($setting)){
		echo "godelta_Settings: WARNING: You have specified no specific setting. Returning all...";
		return $settings;
	}
	#Check if the setting array value is empty.
	#elseif(! @isset($settings["$setting"])){
	#	die("godelta_Settings: FATAL: The setting you have selected does not exist.");
	#}
#OK, let's return the value...
return $settings["$setting"];
}

#Function: godelta_Diagnostics
#Syntax: godelta_Diagnostics()
#Description: Checks for errors in Go Delta's config. It's recommended that you run this from the CLI as www-data.

function godelta_Diagnostics(){
$whoami=system("whoami > php://stderr", $whoami);
echo "You are $whoami.";
echo "Checking setting site_name.\n";
$site_location=godelta_Settings("site_name");
if(! @isset($site_location) || $site_location == ""){
die("Error: site_name is not set.\n");
}
echo "Checking setting site_admin.\n";
$site_location=godelta_Settings("site_admin");
if(! @isset($site_location) || $site_location == ""){
die("Error: site_admin is not set.\n");
}
$site_name=godelta_Settings("site_name");
$site_admin=godelta_Settings("site_admin");
echo "This server is running $site_name, administered by $site_admin.\n";
echo "Checking setting site_webloc.\n";
$site_location=godelta_Settings("site_webloc");
if(! @isset($site_location) || $site_location == ""){
die("Error: site_webloc is not set.\n");
}
echo "Checking setting site_location.\n";
$site_location=godelta_Settings("site_location");
if(! @isset($site_location) || $site_location == ""){
die("Error: site_webloc is not set.\n");
}
echo "Checking if you can write to site_location.\n";
fopen("$site_location/test.txt", "w") or die("Error: Cannot write to $site_location.\n");
unlink("$site_location/test.txt");
}
#this was stupid also


#this was a stupid function


#Function: godelta_ReadDB
#Syntax: godelta_ReadDB(string $db_file_name);
#Description: Access Go Delta databases.

function godelta_ReadDB($db_file_name){
	if(! @isset($db_file_name){
		die("Error: the DB file name is null.");
	}
	$fh=fopen($db_file_name, 'r') or die("Error: Cannot read DB file at $db_file_name.");
	$dbdata=fread($fh, fileSize($db_file_name));
	fclose($fh);
	#Explode the data by pipes (|)
	$dbdata=explode("|", $dbdata);
	#Automatically throw out the first entry because its <?php die(); ?>|
	unset($dbdata[0]);
	#return the values
	return $dbdata;
	#all done
}

#Function: godelta_WriteDB
#Syntax: godelta_WriteDB(string $db_file_name);
#Description: Write to Go Delta databases. MAKE SURE YOUR VALUES DON'T HAVE PIPES OR YOU WILL CORRUPT YOUR GO DELTA DB!

function godelta_WriteDB($db_file_name, $addrecord){
	#copy-paste the DB open functions as above
	if(! @isset($db_file_name)){
		die("Error: the DB file name is null.");
	}
	elseif(! @isset($addrecord)){
		die("Error: the record to add is null.");
	}
	$fh=fopen($db_file_name, 'a') or die("Error: Cannot read DB file at $db_file_name.");
	if (strpos($addrecord,"|")) {
		// We found a | in the record (thanks maxi-pedia.com for the function)
		die("Error: There's a pipe in the record to add.");
	}
	fwrite($fh, "|$addrecord");
	fclose($fh);
}

#Function: godelta_Register
#Syntax: godelta_Register(string $username, string $password);
#Description: Registers a user in the db in the current directory under user_db.php.

function godelta_Register($username, $password){
	#get database data
	$users=godelta_ReadDB("user_db.php");
	$number_of_records=0; #we'll start here because the first record is a die statement, waste of time
	foreach($users as $value){
		$number=$number+1;
	}
	#lets make a copy of the users because we'll need to make modifications to it
	$users_new=$users;
	#foreach
	foreach($users_new as &$value){ #we use the & because we need to make modifications
		$user=explode($value, "=>");
		$value=user[0];
	}
	#Checking if the username's already registered.
	foreach($users_new as $value){
		if($value == $username){
			#its been registered already, return false
			return false;
		}
	}
	#THE MOMENT YOU'VE ALL BEEN WAITING FOR!
	godelta_WriteDB("user_db.php", "$username => $password");
	return true;
}

#Function: godelta_Login
#Syntax: godelta_Login(string $user, string $password)
#Description: Logs a user in.

function godelta_Login($user, $password){
if(! @isset($_SESSION['godelta_Login_loggedin'])){
	session_start();
	$_SESSION['godelta_Login_loggedin'] = true;
	$_SESSION['godelta_Login_username'] = $user;
	$_SESSION['godelta_UserString_username'] = $user;
	return true;
}
return true;
}

if(!@isset($page)){
  $page=$_GET['page'];
}
//check again
if(! @isset($page)){
  $page="index";
}

//stylesheets
if($page=="css"){
  ?>
  index_body {
    border-top-width: 100%;
    border-right-width: 100%;
    border-bottom-width: 100%;
    border-right-width: 100%;
    width: 100%;
    min-width: 200px;
    max-width: 900px;
  }
  <?php
  exit;
}
elseif($page=="js"){
  ?>
  //placeholder for future JavaScript
  <?php
  exit;
}

//put pages that need header stuff first
if($page == "rd"){
  $location=$_GET['location'];
  if(! @isset($location)){
    //show the end-user that an error occured
    $page="error";
    //description of error, to be used later
    $error_desc="The location of the redirect (page rd) was not set.";
    //skip the redirect
  }
  else{
    //change headers to redirect
    header("Location: $location");
    exit;
  }
  //make sure it exits
  exit;
}

?>
<html>
<head>
<!-- <?php echo godelta_Settings("site_name"); ?> runs TDLive Go Delta 11,
version <?php echo godelta_Settings("version"); ?>. It is open source software, licensed under the GNU GPL
v3 or later.

(c)2010-2012 TDLive Inc.
Source can be found at http://github.com/TDLive/Go-Delta. -->
<title><?php echo godelta_Settings("site_name"); ?> | <?php echo $page; ?></title>
<script type="text/javascript" src="?page=js"></script>
<style type="text/css" src="?page=css" ></style>
<!-- leave the <head> open in case a page needs to do JS, etc. -->
<?php
//here's where the real pages start
if( ! 0 == 0){ } #dummy page for now.
//page wasn't found
else{
  ?>
  </head>
  <body>
  <p align="center"><center><h1>Oh, no!</h1><br>The page you requested wasn't found.<br><br>You may want to:<br>* <a href="?page=index">Go home</a>
  <?php
}