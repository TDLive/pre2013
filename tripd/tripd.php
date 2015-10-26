<?php

require_once 'lib/kelpie.php';
require_once 'trippingrobot/trippingrobot.php';
require_once 'settings.php';

class tripd
{
	public $params;
	public $fullURL;
	public $postparams;
	public $getparams;
	public $login;

	public function call($env)
	{
		$this->params = $env;
		if(! @isset($env["REQUEST_METHOD"])){
			echo "Receiving request from " . $env["REMOTE_ADDR"] . ".\n";
		}
		else {
			if( @isset($env["REQUEST_URI"])){
				echo "Receiving " . $env["REQUEST_METHOD"] . " request from " . $env["REMOTE_ADDR"] . " for " . $env["REQUEST_URI"] . ".\n";
			}
			else{
				echo "Receiving " . $env["REQUEST_METHOD"] . " request from " . $env["REMOTE_ADDR"] . ".\n";
			}
		}
		if(@isset($env["REQUEST_URI"])){
			if($env["REQUEST_URI"][0] . $env["REQUEST_URI"][1] == "/?"){
				$getparams=str_replace("/?", "", $env["REQUEST_URI"]);
				$getparams=explode("&", $getparams);
				foreach($getparams as $value){
					if($value == "login=true"){
						$this->login=true;
					}
				}
				$this->getparams=$getparams;
			}
			$this->fullURL = $env["REQUEST_URI"];
			$statictest=explode("/", $this->fullURL);
			if($statictest[1] == "static"){
				return array(200,
				array("Content-Type" => "image/png"),
				array(file_get_contents("static/" . $statictest[2])));
			}
			if(strlen($env["REQUEST_URI"]) == 1){
				$page="index";
			}
			else{
				$page=$this->fullURL;
			}
			// if(TrippingRobotSettings::devMode()){
			// 	echo $page;
			// }
		}
		if(@isset($env["REQUEST_METHOD"])){
			if( $env["REQUEST_METHOD"] == "POST"){
				$postparams=explode("=", $env["REQUEST_BODY"]);
				$i=1;
				foreach($postparams as $val){
					if($i&1) {
						$postparams["$val"] = $postparams[$i+1];
					}
					$i++;
				}
			}
		}
		$doReturn=TrippingRobotInit::ignite($page);
		return array(200,
		array("Content-Type" => "text/html"),
		array($doReturn));
	}
}

echo "TDLive.org presents
                                      _
    _              /_\               | |
 __| |__    _____   _   _  ___     __| |
|__   __|  /  ___| | | | |/   \   /    |
   | |__  |  |     | | |    .  | |  |  |
   |____| |__|     |_| | |\___/   \____|
                       |_|
A web server for trippingrobot based on Kelpie.

Copyright (c)2010-2012 dhotson.
Copyright (c)2012-2013 TDLive.org.

Initializing Kelpie.\r";
$kelpie = new Kelpie_Server(TRIPD_BIND, TRIPD_PORT);
echo "Done! Listening for requests on " . TRIPD_BIND . ":" . TRIPD_PORT . ".\n";
$kelpie->start(new tripd());
?>