<?php

# tripd settings

define("TRIPD_BIND", "0.0.0.0"); #what ip should tripd bind to?
define("TRIPD_PORT", 8080); #what port should tripd bind to?

#Class TrippingRobotSettings
#Defines settings via functions (probably not the best way of doing this)
class TrippingRobotSettings {
	#Prefix: Where *.trippingrobot files should be stored with ending slash, put "./" for current directory.
	function prefix() { return "data/"; }
	#County Clubs: an array of all of the clubs in the county (or, YOUR clubs, for personal use)
	function countyClubs() { return array("Barnyard Kids", "Calico Kids", "Cavy Crusaders", "Communication Sensation", "Cracked Pot Crafters", "Cottontails and Company", "East Brunswick Clovers", "Eco-Maniacs", "Edible Adventures", "Food Frenzy", "Frisky Paws", "Garden Club (Roundabouts)", "Golden Spurs", "Indian Langoor", "Junior Council", "Kendall Park Clovers (Cloverbuds)", "Kendall Park Clovers (4H)", "Mavericks", "Marine Science Club", "Paws and Claws Club", "Puppy Pals", "Reinbow Riders", "Renegade Racers", "Rhythm in Motion", "Roundabouts", "Sharp Shooters", "The Shining Knights", "Teen Council", "Trash to Art", "Wings 'n' Things", "Zoo Crew"); }
	#Salt: Salting passwords. ******CHANGE THIS*********
	function salt(){ return "Dhehewbcdge262gdb"; }
	#Site name: It'll say "Welcome to (value)!"
	function sitename() { return "Middlesex County 4-H"; }
	#Home page for the site (e.g. county web site). Return null for none
	function siteURL() { return "http://co.middlesex.nj.us/extensionservices/4hclubs.asp"; }
	#Run in development mode? Debug info will be shown.
	function devMode() { return true; }
}

?>