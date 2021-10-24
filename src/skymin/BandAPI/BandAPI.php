<?php
declare(strict_types = 1);

namespace skymin\BandAPI;

use skymin\BandAPI\manager\BandManager;

use function trim;

final class BandAPI{
	
	public static function loginBand(string $acces_token = '') :?BandManager{
		$token = trim($acces_token);
		if($token = '') return null;
		return new BandManager($token);
	}
	
}