<?php
declare(strict_types = 1);

namespace skymin\BandAPI\manager;

use function json_decode;
use function urlencode;
//curl
use function curl_init;
use function curl_setopt;
use function curl_exec;
use function curl_close; 

use const CURLOPT_RETURNTRANSFER;
use const CURLINFO_HEADER_OUT;

final class BandManager{
	
	public function __construct(private string $token){}
	
	public function getBands() :array{
		$curl = curl_init('https://openapi.band.us/v2.1/bands?access_token=' . $this->token);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		$decode = json_decode(curl_exec($curl), true);
		curl_close($curl);
		return $decode;
	}
	
	public function getBand(string $band_name) :?Band{
		$bands = $this->getBands();
		if(!isset($bands['result_data']['bands'][0])) return null;
		foreach ($bands['result_data']['bands'] as $key => $value){
			if($value['name'] != $band_name) continue;
			return new Band($this->token, $value['band_key']);
			break;
		}
	}
	
}