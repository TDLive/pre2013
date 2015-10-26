<?php

#TrippingRobot
#A 4-H digital record book implementation.

#(c)2012 TDLive.org Inc.
#Licensed under the GNU GPL
#<http://www.gnu.org/licenses/gpl>


#Class TrippingRobotCore
#The core class for TrippingRobot.
class TrippingRobotCore {
	#Function createRecordBookDB
	#Create a record book DB for $username.
	function createRecordBookDB($username){
		$settings=new TrippingRobotSettings();
		if(! @isset($username)){ #checking for a bad API call
			return false; #false is the code for an unsuccessful call
		}
		#create a record book (which is basically a CSV file)
		if(is_readable($settings->prefix() . "$username.trippingrobot")){ #Check if a record book exists for $username.
			return false; #well, it didn't complete successfully
		}
		file_put_contents($settings->prefix() . "$username.trippingrobot", "");
		return true; #the record book was created
	}
	#Function createTrip
	#Create a new "trip", or event, in $username's record book.
	#You'll need to define the date (null for today), location, description (what was done), level (1=club, 2=county, 3=state, 4=national), $award (null if no award)
	function createTrip($username, $club, $date, $location, $description, $level, $award){
		$settings=new TrippingRobotSettings;
		if(! @isset($username) || !@isset($location) || !@isset($description) || !@isset($level) || !@isset($award) || ! @isset($date)){ #do a little inventory
			return false; #all required vars were not set
		}
		if(! @isset($award) || $award == ""){ #check if there were any awards today
			$award="None"; #nope
		}
		#remove commas so that nothing conflicts
		$description=str_replace(",", ";", $description); #commas, ugh
		$location=str_replace(",", "", $location); #commas, ugh
		$date=str_replace(",", "", $data); #dates, ugh
		#format the entry
		$date=$_POST['date'];
		$formatted=file_get_contents($settings->prefix() . $username . ".trippingrobot") . "$club, $date, $location, $description, $level, $award\n";
		#put it in now
		if(! file_put_contents($settings->prefix() . "$username.trippingrobot", $formatted)){ #check if we can't write
			return false; #couldn't write
		}
		return true; #could, done
	}
	#Function openRecordBook
	#Open and attach/deploy $username's record book as a CSV (openable in LibreOffice Calc/Excel/etc)
	function openRecordBook($username){
		$settings=new TrippingRobotSettings;
		#normal API call checking
		if(! @isset($username)){
			return false; #no username, dummieh!
		}
		#check if the file is readable before deploying it
		if(! is_readable($settings->prefix(). "$username.trippingrobot")){ #check if can't read
			return false; #can't read the file, so we won't deploy it
		}
		#NOW we can deploy the file
		$file=$settings->prefix() . $username . ".trippingrobot";	
    header('Content-Description: File Transfer');
    header('Content-Type: text/csv; charset=utf8');
    header('Content-Disposition: attachment; filename=my_record_book.csv');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
		return true; #it got done bro
	}
	#Function createTrippingRobot
	#Create a TrippingRobot
	function createTrippingRobot($username, $password){
		$trippingrobot=new TrippingRobotCore;
		$settings=new TrippingRobotSettings;
		if( is_readable($settings->prefix() . $username . ".trippingrobotlogin")){
			return false;
		}
		else{
			file_put_contents($settings->prefix() . $username . ".trippingrobotlogin", md5($settings->salt() . $password));
		}
		if(! $trippingrobot->createRecordBookDB($username)){
			return false; #definitely done
		}
		return true;
	}
	#maybe trip deletion?
}

#Class TrippingRobotSettings
#Pages for TrippingRobot.
class TrippingRobotPages {
	#The pages are one of the hardest parts so hang in here with me

	#loginPage(): Allows the user to log in
	function loginPage($error, $success){
#I don't usually comment HTML, just saying.
		$doReturn='
<html>
	<head>
		<title>TrippingRobot: The 4-H record book manager</title>
		<link rel="shortcut icon" href="static/trlogo.png" />
	</head>
	<body>
		<p align="center"><center>
			<img src="/static/trlogo.png" height="100" width="100"/>
			<font face="Comic Sans MS"><h1>TrippingRobot</h1></font><br>
			';
		if(@isset($error)) $doReturn=$doReturn . "<font color='red'>$error</font><br>";
		if(@isset($success)) $doReturn=$doReturn . "<font color='blue'>$success</font><br>";
			$doReturn = $doReturn . "<b>Welcome to " . TrippingRobotSettings::sitename() . "!</b><br><br>
			<b>Please sign in</b> to view your record book(s) and add a trip...
			<form action='?login=true' method='post'>
				<b>User name:</b> <input type='text' name='user' /><br>
				<b>Password:</b> <input type='password' name='pass' /><br>
				<input type='submit' value='Log in' />
			</form>
			<b>...or register</b> to start your own TrippingRobot!
			<form action='?page=signup' method='post'>
				<b>Desired user name:</b> <input type='text' name='user' /><br>
				<b>Desired password:</b> <input type='password' name='pass' /><br>
				<input type='submit' value='Sign up' />
			</form>
		</center></p>
	</body>
	<p align='center'><center>
			<p align='center'><center>TrippingRobot &copy;2012-2016 TDLive.org Inc .<br> TrippingRobot is available <a href='http://github.com/TDLive/trippingrobot/'>for free</a> under the <a href='http://www.gnu.org/licenses/gpl'>GNU GPL</a>.</center></p></center></p></html>";
		//if(! TrippingRobotSettings::siteURL() == null){
		//	$doReturn=$doReturn . "<a href='" . TrippingRobotSettings::siteURL() . "'>";
		//}
		//$doReturn=$doReturn . TrippingRobotSettings::sitename();
		//if(! TrippingRobotSettings::siteURL() == null){
		//	$doReturn = $doReturn . "</a>";
		return $doReturn;
	}
	#homePage(): User's home page.
	function homePage($username){
	$settings=new TrippingRobotSettings;
	#Checking if people are stupid is sometimes annoying. Like, really annoying.
		if(! @isset($username)){
			return false; #omg
		}
	?>
<html>
	<head>
		<title>TrippingRobot: The 4-H record book manager | <?php echo $username; ?>'s record book</title>
		<link rel="shortcut icon" href="trlogo.png" />
	</head>
	<body>
		<p align="center"><center>
			<font face="Comic Sans MS"><img src="trlogo.png" height="64" width="64" /><br> TrippingRobot<br>Hai, <?php echo $username . "!"; ?> <a href="?page=logout">Logout/Not <?php echo $username; ?>?</a></font><br>
			<a href="?page=dump">Get a CSV of your record book</a><br>
			<a href="?page=print">Show a printable copy of the record book</a><br>
			<form action="?page=rcinput" method="post" />
			<h2>New Trip</h2>
			<b>Club: </b><select name="club">
				<?php
foreach($settings->countyClubs() as $value){
	echo "<option value='$value'>$value</option>\n";
}
				?>
			</select><br>
			<b>Date:</b> <!-- fix date regression --><input type="text" name="date" value="<?php echo date("F jS Y"); ?>" /><br>
			<b>Location:</b> <input type="text" name="location" /><br>
			<b>Description of what you did:</b> <input type="text" name="description" /><br>
			<b>Level:</b> <select name="level">
<option value='Club'>Club</option>
<option value='County'>County</option>
<option value='State'>State</option>
<option value='National'>National</option>
			</select><br>
			<b>Award (leave empty for None):</b> <input type="text" name="award" /><br>
			<input type="submit" value="Add..." />
			</form>
</select>
	</body>
	<p align="center"><center>TrippingRobot &copy;2012 TDLive.org Inc.<br> This site is independently owned and operated by <?php if(! TrippingRobotSettings::siteURL() == null){ echo "<a href='" . TrippingRobotSettings::siteURL() . "'>"; } echo TrippingRobotSettings::sitename(); if(! TrippingRobotSettings::siteURL() == null){ echo "</a>"; } ?>.<br> TrippingRobot is available <a href="http://github.com/TDLive/trippingrobot/">for free</a> under <a href="http://tdlive.org/philosophy">TDLive's philosophy</a>.</center></p>
	<?php
	}
}
#Class TrippingRobotInit
#Initialize TrippingRobot.
class TrippingRobotInit {
	#ignite
	#The main function
	function ignite($page="/login"){
		$tripd=new tripd;
		if($page == "/signup"){
			if(! @isset($_POST['user']) || ! @isset($_POST['pass'])){
				return TrippingRobotPages::loginPage("Please fill out both fields.", null);
			}
			if(! TrippingRobotCore::createTrippingRobot($_POST['user'], $_POST['pass'])){
				return TrippingRobotPages::loginPage("There was an error creating your account: that username's already been used!", null);
				exit;
			}
			return TrippingRobotPages::loginPage(null, "Thanks for creating an account! You can now login using the form below.");
			exit;
		}
		if($page == "/logout"){ #logging out?
			setcookie ("username", "", time() - 3600);
			setcookie ("password", "", time() - 3600);
			return TrippingRobotPages::loginPage(null, "Logged out.");
			exit;
		}
		if($page == "/rcinput"){
			$settings= new TrippingRobotSettings;
			#Does the user even exist/can we read the user's profile?
			if(! is_readable($settings->prefix() . $_COOKIE['username'] . ".trippingrobotlogin")){
				return TrippingRobotPages::loginPage("Invalid username!", null);
				exit;
			}
			#Let's store the password, if we can't let's tell the user we can't.
			if(! $storedpass=file_get_contents($settings->prefix() . $_COOKIE['username'] . ".trippingrobotlogin")){
				return TrippingRobotPages::loginPage("Internal server error. Please wait a couple of minutes, and try again.", null);
				exit;
			}
			#Passwords are md5() ed with a salt, so let's encode the current password.
			$password=$_COOKIE['password'];
			if($password != $storedpass){
				return TrippingRobotPages::loginPage("Invalid password!", null);
				exit; #Rookie mistake: logging the user in anyway even though authentication failed.
			}
			if(! TrippingRobotCore::createTrip($_COOKIE['username'], $_POST['club'], $_POST['date'], $_POST['location'], $_POST['description'], $_POST['level'], $_POST['award'])){
				die("<font color='red'>It didn't work.</font> <a href='?'>Click here to try again</a>. Make sure all (required) fields are filled out.");
			}
			else{
				die("<font color='green'>It worked!</font> <a href='?'>Click here to go back</a>, or click <a href='?page=logout'>here</a> to log out.");
			}
		}
		if($page == "/dump"){
			$settings=new TrippingRobotSettings;
			#Does the user even exist/can we read the user's profile?
			if(! is_readable($settings->prefix() . $_COOKIE['username'] . ".trippingrobotlogin")){
				return TrippingRobotPages::loginPage("Invalid username!", null);
				exit;
			}
			#Let's store the password, if we can't let's tell the user we can't.
			if(! $storedpass=file_get_contents($settings->prefix() . $_COOKIE['username'] . ".trippingrobotlogin")){
				return TrippingRobotPages::loginPage("Internal server error. Please wait a couple of minutes, and try again.", null);
				exit;
			}
			#Passwords are md5() ed with a salt, so let's encode the current password.
			$password=$_COOKIE['password'];
			if($password != $storedpass){
				return TrippingRobotPages::loginPage("Invalid password!", null);
				exit; #Rookie mistake: logging the user in anyway even though authentication failed.
			}
			TrippingRobotCore::openRecordBook($_COOKIE['username']);
			exit;
		}
		if($page == "/print"){
			$settings=new TrippingRobotSettings;
			#Does the user even exist/can we read the user's profile?
			if(! is_readable($settings->prefix() . $_COOKIE['username'] . ".trippingrobotlogin")){
				return TrippingRobotPages::loginPage("Invalid username!", null);
				exit;
			}
			#Let's store the password, if we can't let's tell the user we can't.
			if(! $storedpass=file_get_contents($settings->prefix() . $_COOKIE['username'] . ".trippingrobotlogin")){
				return TrippingRobotPages::loginPage("Internal server error. Please wait a couple of minutes, and try again.", null);
				exit;
			}
			#Passwords are md5() ed with a salt, so let's encode the current password.
			$password=$_COOKIE['password'];
			if($password != $storedpass){
				return TrippingRobotPages::loginPage("Invalid password!", null);
				exit; #Rookie mistake: logging the user in anyway even though authentication failed.
			}
			define('USER', $_COOKIE['username']);
			$recordbook=$settings->prefix() . USER . ".trippingrobot";
			$recordbook=file_get_contents($recordbook);
			if(! $recordbook){
				die("<font color='red'>Internal server error.</font>");
			}
			echo "<b>" . USER . "'s Record Book</b><br><table border='1'>
<tr>
<th>Club</th>
<th>Date</th>
<th>Location</th>
<th>Description of What Was Done</th>
<th>Level</th>
<th>Awards (if any)</th>
</tr>";
			$recordbook=explode("\n", $recordbook);
			foreach($recordbook as $value){
				echo "<tr>";
				$val2=explode(",", $value);
				foreach($val2 as $value){
					echo "<td>$value</td>";
				}
			}
			exit;
		}
		$settings=new TrippingRobotSettings;
		if(@isset($_COOKIE['username']) && @isset($_COOKIE['password'])){ #we hav cookiehs!
			#run the authentication process (a lot of this is copied from below)
			#Does the user even exist/can we read the user's profile?
			if(! is_readable($settings->prefix() . $_COOKIE['username'] . ".trippingrobotlogin")){
				return TrippingRobotPages::loginPage("Invalid username/password!", null);
				exit;
			}
			#Let's store the password, if we can't let's tell the user we can't.
			if(! $storedpass=file_get_contents($settings->prefix() . $_COOKIE['username'] . ".trippingrobotlogin")){
				return TrippingRobotPages::loginPage("Internal server error. Please wait a couple of minutes, and try again.", null);
				exit;
			}
			#Passwords are md5() ed with a salt, so let's encode the current password.
			$password=$_COOKIE['password'];
			if($password != $storedpass){
				return TrippingRobotPages::loginPage("Invalid username/password!", null);
				exit; #Rookie mistake: logging the user in anyway even though authentication failed.
			}
			define('USER', $_COOKIE['username']);
			define('PASSWORD', $_COOKIE['password']);
			return TrippingRobotPages::homePage($_COOKIE['username']);
			exit;
		}
		$tripd = new tripd;
		if($tripd->login){ #logging in?
			#YES, is errythin set?
			if(! @isset($_POST['user']) || ! @isset($_POST['pass'])){
				#tell the user that they must do both a username/pass
				return TrippingRobotPages::loginPage("Please define both a user and password.", null);
				exit;
			}
			$username=$_POST['user'];
			$password=$_POST['pass']; #shorten some vars
			#Does the user even exist/can we read the user's profile?
			if(! is_readable($settings->prefix() . $username . ".trippingrobotlogin")){
				return TrippingRobotPages::loginPage("Invalid username/password!", null);
				exit;
			}
			#Let's store the password, if we can't let's tell the user we can't.
			if(! $storedpass=file_get_contents($settings->prefix() . $username . ".trippingrobotlogin")){
				return TrippingRobotPages::loginPage("Internal server error. Please wait a couple of minutes, and try again.", null);
				exit;
			}
			#Passwords are md5() ed with a salt, so let's encode the current password.
			$password=md5($settings->salt() . $password);
			if($password != $storedpass){
				return TrippingRobotPages::loginPage("Invalid username/password!", null);
				exit; #Rookie mistake: logging the user in anyway even though authentication failed.
			}
			#Set the login cookies, 
			setcookie("username", $username);
			setcookie("password", $password);
			define("USER", $username);
			define("PASSWORD", $password);
			return TrippingRobotPages::homePage(USER);
			exit;
		}
		else{ #show us the login page
			return TrippingRobotPages::loginPage(null, null);
		}
	}
}
