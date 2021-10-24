<?php
declare(strict_types = 1);

namespace skymin\test;

use pocketmine\plugin\PluginBase;

use skymin\BandAPI\BandAPI;

class Test extends PluginBase{
	
	public function onEnable() :void{
		$bandApi = BandAPI::loginBand('access_token');
		$bands = $bandApi->getBands();
		$bandApi->writePost($bands['result_data']['bands'][0]['band_key'], 'test', true);
	}
	
}