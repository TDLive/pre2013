<?php
echo "Hold on, opening files...\n";
$fh=fopen("version.txt", "r");
$version=fread($fh, fileSize("version.txt"));
fclose($fh);
echo "Calculating stuffs...";
$version=$version++;
echo "You are committing version r$version.";
$fh=fopen("version.txt", "w");
fwrite($fh, $version);
fclose($fh);
// loop through each element in the $argv array
$i=0;
foreach($argv as $value){
if(! $i == 0){
$commitdata=$commitdata . $value;
}
$i++;
}
system("git commit -a -m 'r$version - $commitdata'");
echo "Done! Run git push to see it on GitHub.";
?>
