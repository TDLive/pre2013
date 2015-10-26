<?php
define('VERSION',27.5);
#tAdventure

function cmd(){
	echo "What do you do now? ";
	$handle = fopen ("php://stdin","r");
	$line = fgets($handle);
	#Thanks for the user input script from notreallyanaddress at somerandomaddr dot com at php.net.
	return trim($line);
}

function items($id){ #This is so big, it needs it's own function.
	if($id == 1){
		$item["name"]="Lamp";
		$item["desc"]="Just a desk lamp, sitting around...";
	}
	elseif($id == 2){
		$item["name"]="TDLive's computer";
		$item["desc"]="A big octocat is sitting on-screen.";
	}
	elseif($id == 3){
		$item["name"]="Toothpaste and Toothbrush";
		$item["desc"]="Just a regular toothpaste tube and toothbrush. They both read COLGATE.";
	}
	elseif($id == 4){
		$item["name"]="Torch";
		$item["desc"]="A rough wood torch.";
	}
	elseif($id == 5){
		$item["name"]="Matches";
		$item["desc"]="Matches inside a tinderbox.";
	}
return $item;
}
#@function tAdventure
#@description This is the main function for tAdventure.
#@synopsis tAdventure(string start, string pts, array items)

function tAdventure($start=0, $pts=0, $items=Array(), $said=false, $name){
	if($start == 0){
		$rdat["locname"]="Grand Hallway";
		$rdat["locdesc"]="The grandest hallway of the entire mansion.";
		$rdat["isItems"]=false;
		$rdat["connectsLeft"]=true;
		$rdat["connectsLeftId"]=1;
		$rdat["connectsRight"]=true;
		$rdat["connectsRightId"]=5;
		$rdat["connectsStraight"]=false;
		$rdat["connectsBack"]=false;
	}
	elseif($start == 1){
		$rdat["locname"]="Bedroom Hallway";
		$rdat["locdesc"]="The hall with all of the bedrooms.";
		$rdat["isItems"]=true;
		$rdat["items"]=1;
		$rdat["connectsLeft"]=true;
		$rdat["connectsLeftId"]=2;
		$rdat["connectsRight"]=false;
		$rdat["connectsStraight"]=true;
		$rdat["connectsStraightId"]=3;
		$rdat["connectsBack"]=true;
		$rdat["connectsBackId"]=0;
	}
	elseif($start == 2){
		$rdat["locname"]="TDLive's Room";
		$rdat["locdesc"]="TDLive's bedroom.";
		$rdat["isItems"]=true;
		$rdat["items"]=2;
		$rdat["connectsLeft"]=false;
		$rdat["connectsRight"]=false;
		$rdat["connectsStraight"]=false;
		$rdat["connectsBack"]=true;
		$rdat["connectsBackId"]=1;
	}
	elseif($start == 3){
		$rdat["locname"]="$name's Room";
		$rdat["locdesc"]="Your room!";
		$rdat["isItems"]=false;
		$rdat["connectsLeft"]=true;
		$rdat["connectsLeftId"]=4;
		$rdat["connectsRight"]=false;
		$rdat["connectsStraight"]=false;
		$rdat["connectsBack"]=true;
		$rdat["connectsBackId"]=1;
	}
	elseif($start == 4){
		$rdat["locname"]="$name's Bathroom";
		$rdat["locdesc"]="Your bathroom!";
		$rdat["isItems"]=true;
		$rdat["items"]=3;
		$rdat["connectsLeft"]=true;
		$rdat["connectsLeftId"]=2;
		$rdat["connectsRight"]=false;
		$rdat["connectsStraight"]=false;
		$rdat["connectsBack"]=true;
		$rdat["connectsBackId"]=3;
	}
	elseif($start == 5){
		$rdat["locname"]="The Main Hallway";
		$rdat["locdesc"]="Turn 'left' to start the real game.";
		$rdat["isItems"]=false;
		$rdat["items"]=null;
		$rdat["connectsLeft"]=true;
		$rdat["connectsLeftId"]=6;
		$rdat["connectsRight"]=false;
		$rdat["connectsStraight"]=false;
		$rdat["connectsBack"]=true;
		$rdat["connectsBackId"]=0;
	}
	elseif($start == 6){
		if(! $said){
		echo "\n\nAs you close the door, you realize that 
you are at the point of no return.\n\n"; }
		$rdat["locname"]="The Dungeon";
		$rdat["locdesc"]="A very dark and dank room. You swear
that you can hear breathing in the distance.";
		$rdat["isItems"]=true;
		$rdat["items"]=4;
		$rdat["connectsLeft"]=false;
		$rdat["connectsRight"]=false;
		$rdat["connectsStraight"]=true;
		$rdat["connectsStraightId"]=7;
		$rdat["connectsBack"]=false;
	}
	elseif($start == 7){
		$rdat["locname"]="Cell 1";
		$rdat["locdesc"]="The first cell in the dungeon. You hear
many barks.";
		$rdat["isItems"]=true;
		$rdat["items"]=5;
		$rdat["connectsLeft"]=false;
		$rdat["connectsRight"]=false;
		$rdat["connectsStraight"]=true;
		$rdat["connectsStraightId"]=8;
		$rdat["connectsBack"]=true;
		$rdat["connectsBackId"]=6;
	}
	elseif($start == 8){
		$rdat["locname"]="Cell 2";
		$rdat["locdesc"]="The second cell in the dungeon. You hear
many barks.";
		$rdat["isItems"]=false;
		$rdat["connectsLeft"]=false;
		$rdat["connectsRight"]=false;
		$rdat["connectsStraight"]=false;
		$rdat["connectsBack"]=true;
		$rdat["connectsBackId"]=7;
	}
	else{
		die("Error in your save file; the location in it
was not found. If you are using a greater version
of tAdventure than before (or, ahem, cheaters), you
may need to delete your save file (sorry) and start
again.");
	}
	$darkrooms=Array(8);
	if(! $said){
	echo $rdat["locname"] . "\n\n";
	echo $rdat["locdesc"] . "\n\n";
	if(! $rdat["isItems"]){
		echo "There are no items in this room.\n";
	}
	else{
		if($rdat['isItems']){
			$itemdata=items($rdat["items"]);
			$taken=false;
			foreach($itemus as $value){
				if($value == $rdat["items"]){
					$taken=true;
				}
			}
			if(! $taken){
			$name2=$itemdata["name"];
			$desc=$itemdata["desc"];
			echo "There is a $name2 in here!\n$desc\n";
			}
			else{
				echo "There are no items in this room.";
			}
		}
	}
	}
	$cmd=cmd();
	if(! @isset($cmd) || $cmd == ""){
		tadventure($start, $pts, $items, true, $name);
	}
	elseif($cmd == 'quit'){
	if(file_exists(".shocked.tmp")){
		unlink(".shocked.tmp");
	}
	if(file_exists(".torch.tmp")){
		unlink(".torch.tmp");
	}
   	echo "Thanks for playing!\n";
    	exit;
	}
	elseif($cmd == 'save'){
	echo "Saving...\n";
	$fh=fopen("tadventure_save.txt", 'w') or tAdventure($start, $pts, $items, true, $name);
	fwrite($fh, "$start/$pts");
	foreach($items as $value){
		fwrite($fh, "/$value");
	}
	echo "Game saved!\n";
	tAdventure($start, $pts, $items, true, $name);
	}	
	elseif($cmd == "update"){
		system("wget --version > /dev/null", $wgetv);
		if(! $wgetv == 0){
			echo "Error! wget is not installed!\n";
			tAdventure($start, $pts, $items, true);
		}
		echo "Checking the version...\n";
		system("wget -q https://raw.github.com/TDLive/tAdventure/master/version.txt -O version.txt");
		$fh=fopen("version.txt", "r");
		$version=fread($fh, fileSize("version.txt"));
		fclose($fh);
		if($version == VERSION || $version < VERSION){
			echo "Your version is too new/the latest!\n";
			tAdventure($start, $pts, $items, true, $name);
		}
		else{
		echo "Getting tAdventure...\n";
		system("wget -q https://raw.github.com/TDLive/tAdventure/master/adventure.php -O adventure.php");
		echo "Starting tAdventure...\n\n";
		system("php adventure.php", $exitcode);
		exit($exitcode);
		}
	}
	elseif($cmd == "room"){
	echo "\n";
	tAdventure($start, $pts, $items);
	}
	elseif($cmd == "left"){
		if( $rdat["connectsLeft"]){
			foreach($darkrooms as $value){
				if($rdat["connectsLeftId"] == $value){
					if(! file_exists(".torch.tmp")){
						echo "It's too dark to go down this way!\n";
						tAdventure($start, $pts, $items, true, $name);
					}
				}
			}
			tAdventure($rdat["connectsLeftId"], $pts, $items, false, $name);
		}
		else{
			echo "You can't go left.\n";
			tAdventure($start, $pts, $items, true, $name);
		}
	}
	elseif($cmd == "right"){
		if( $rdat["connectsRight"]){
			foreach($darkrooms as $value){
				if($rdat["connectsRightId"] == $value){
					if(! file_exists(".torch.tmp")){
						echo "It's too dark to go down this way!\n";
						tAdventure($start, $pts, $items, true, $name);
					}
				}
			}
			tAdventure($rdat["connectsRightId"], $pts, $items, false, $name);
		}
		else{
			echo "You can't go right.\n";
			tAdventure($start, $pts, $items, true, $name);
		}
	}
	elseif($cmd == "back"){
		if( $rdat["connectsBack"]){
			foreach($darkrooms as $value){
				if($rdat["connectsBackId"] == $value){
					if(! file_exists(".torch.tmp")){
						echo "It's too dark to go down this way!\n";
						tAdventure($start, $pts, $items, true, $name);
					}
				}
			}
			tAdventure($rdat["connectsBackId"], $pts, $items, false, $name);
		}
		else{
			echo "You can't go back.\n";
			tAdventure($start, $pts, $items, true, $name);
		}
	}
	elseif($cmd == "straight"){
		if( $rdat["connectsStraight"]){
			foreach($darkrooms as $value){
				if($rdat["connectsStraightId"] == $value){
					if(! file_exists(".torch.tmp")){
						echo "It's too dark to go down this way!\n";
						tAdventure($start, $pts, $items, true, $name);
					}
				}
			}
			tAdventure($rdat["connectsStraightId"], $pts, $items, false, $name);
		}
		else{
			echo "You can't go straight.\n";
			tAdventure($start, $pts, $items, true, $name);
		}
	}
	elseif($cmd == "pickup"){
		if(! $rdat['isItems']){
			echo "There isn't anything I can pick up here.\n";
			tAdventure($start, $pts, $items, true, $name);
		}
		else{
			if($rdat["items"] == 2){
				if(! file_exists(".shocked.tmp")){
				echo "The moment you pick the computer up,
it shocks you, and TDLive runs in to put it
back on his desk.\n";
				$fh=fopen(".shocked.tmp", 'w');
				fclose($fh);
				}
				else{
				echo "TDLive: SO YOU DIDN'T LEARN, HUH?!?\n";
				echo "You: AAAAHHHHHHHHHHHHHHH\n";
				echo "YOU ARE DEAD!\n";
				unlink(".shocked.tmp");
				sleep(5);
				tAdventure(null,null,null,null,$name);
			}

			tAdventure($start, $pts, $items, true, $name);
		}
			foreach($items as $value){
				if($value == $rdat["items"]){
					echo "You can't have two $value.\n";
					tAdventure($start, $pts, $items, true, $name);
				}
			}
			$itemdata=items($rdat["items"]);
			$name1=$itemdata["name"];
			$desc=$itemdata["desc"];
			echo "You picked up a $name1!\n";
			$items[]=$rdat["items"];
			tAdventure($start, $pts, $items, true, $name);
		}
	}
	elseif($cmd == "version"){
		echo "This is TDLive tAdventure.\n";
		tAdventure($start, $pts, $items, true, $name);
	}
	elseif($cmd == "inventory"){
		foreach($items as $value){
			$itemdat=items($value);
			$name2=$itemdat["name"];
			$desc=$itemdat["desc"];
			echo "$name2 - $desc\n";
		}
		tAdventure($start, $pts, $items, true, $name);
	}
	elseif($cmd == "brush"){
		foreach($items as $value){
			if($value == 3){
				$can=true;
			}
		}
		if($can && $start == 4){
			echo "You brush your teeth. Your teeth feel minty.\n";
			tAdventure($start, $pts, $items, true, $name);
		}
		else{
			echo "You must posess the toothbrush and toothpaste
and be in a bathroom to do this.\n";
	tAdventure($start, $pts, $items, true, $name);
		}
	}
	elseif($cmd == "torch"){
		foreach($items as $value){
			if($value == 4){
				$can1=true;
			}
			elseif($value == 5){
				$can2=true;
			}
		}
		if(@$can1 && @$can2 && ! file_exists(".torch.tmp")){
			echo "You light up the torch and savor its
light.\n";
		$fh=fopen(".torch.tmp", "w");
		fclose($fh);
		tAdventure($start, $pts, $items, true, $name);
		}
		elseif(! @$can1 || ! @$can2){
		echo "You need the Torch and Matches to do this.\n";
		tAdventure($start, $pts, $items, true, $name);
		}
		elseif(file_exists('.torch.tmp')){
		echo "Your torch is already lit.\n";
		tAdventure($start, $pts, $items, true, $name);
		}
	}
elseif($cmd == "laugh") {
if(! $start == 2) echo "There isn't anything to laugh at.\n";
else echo "Haha. Octocats.\n";
tAdventure($start, $pts, $items, true, $name);
}
	else{
		echo "I don't know what '$cmd' is!\n";
	tAdventure($start, $pts, $items, true, $name);
	}
}
if (! PHP_SAPI === 'cli') 
{ 
   die("You're not using the CLI! This is a CLI script, and must be executed
using the CLI. For more information, see

http://php.net/manual/en/features.commandline.php\n");
} 

echo "tAdventure";
echo "(c)2012 TDLive Inc. 
Licensed under the GNU GPL v3 or later.
The source code is available at http://github.com/TDLive/tadventure.\n\n";

if( file_exists("tadventure_save.txt")){
	$fh=fopen("tadventure_save.txt", "r");
	$data=fread($fh, fileSize("tadventure_save.txt"));
	fclose($fh);
	$data=explode('/', $data);
	$save[0]=$data[0];
	unset($data[0]);
	@$save[1]=$data[1];
	unset($data[1]);
	$items=0;
	foreach($data as $value){
	$item[$items]=$value;
	$items++;
	}
}
else{
	$save[0]=0;
	$save[1]=0;
	$item=Array();
}
echo "\nHello there!\n";
	echo "What is your name? ";
	$handle = fopen ("php://stdin","r");
	$line = fgets($handle);
	#Thanks for the user input script from notreallyanaddress at somerandomaddr dot com at php.net.
	$cmd=trim($line);
	echo "It's $cmd, huh?\n";
	echo "Okay, $cmd, let's start!\n\n";
@tAdventure($save[0], $save[1], $item, false, $cmd);
?>
