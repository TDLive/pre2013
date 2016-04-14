<?php 
if(! include("trippingrobot.classes.php")){
	die("TrippingRobot fatal error: Cannot access TrippingRobot classes. Are they chmod-d correctly?");
}
$settings=new TrippingRobotSettings;
new TrippingRobotInit;
?>
