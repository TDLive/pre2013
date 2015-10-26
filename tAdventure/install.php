<?php
define("VERSION", 1);
function install_top(){
	system("clear");
	echo "TDLive tAdventure version r" . VERSION . "\n"
	echo "(c)2012 TDLive Inc.\n\n";
}
install_top();
echo "Preparing to install tAdventure...";
system("wget --version > /dev/null", $wgetv);
		if(! $wgetv == 0){
			echo "Error! wget is not installed!\n";
			echo "\n";
			echo "Exiting in 5...";
			sleep(1);
			echo "Error! wget is not installed!\n";
			echo "\n";
			echo "Exiting in 4...";
			sleep(1);
			echo "Error! wget is not installed!\n";
			echo "\n";
			echo "Exiting in 3...";
			sleep(1);
			echo "Error! wget is not installed!\n";
			echo "\n";
			echo "Exiting in 2...";
			sleep(1);
			echo "Error! wget is not installed!\n";
			echo "\n";
			echo "Exiting in 1...";
			sleep(1);
			system("clear");
		}
install_top();
$filesToGet=Array("https://raw.github.com/TDLive/tAdventure/master/adventure.php");
$nofilesto=count($filesToGet);
$n=0;
while($n < $nofilesto){
$filetoget=$filesToGet[$n];
$fileaddrex=explode($filetoget, '/');
$end=array_pop(array_keys($array));
install_top();
echo "Getting file $n of $nofilesto: $filetoget";
system("wget $filetoget -O $end");
$n=$n++;
}
install_top();
echo "Done!\n";
echo "Starting the game in 5...";
sleep(1);
install_top();
echo "Done!\n";
echo "Starting the game in 4...";
sleep(1);
install_top();
echo "Done!\n";
echo "Starting the game in 3...";
sleep(1);
install_top();
echo "Done!\n";
echo "Starting the game in 2...";
sleep(1);
install_top();
echo "Done!\n";
echo "Starting the game in 1...";
sleep(1);
echo "Starting the game...";
include("adventure.php");
