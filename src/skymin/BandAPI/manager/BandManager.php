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

use const CURLOPT_URL;
use const CURLOPT_RETURNTRANSFER;
use const CURLINFO_HEADER_OUT;
use const CURLOPT_POSTFIELDS;
use const CURLOPT_HTTPHEADER;
use const CURLOPT_POST;

final class BandManager{
	
	public function __construct(private string $token){}
	
	public function getBands() :array{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://openapi.band.us/v2.1/bands?access_token=' . $this->token);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		$json = curl_exec($curl);
		$decode = json_decode($json, true);
		curl_close($curl);
		return $decode;
	}
	
	public function getPosts(string $band_key = '', string $locale = '') :array{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://openapi.band.us/v2/band/posts?access_token=' . $this->token . '&band_key=' . $band_key . '&locale=' . $locale);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		$json = curl_exec($curl);
		$decode = json_decode($json, true);
		curl_close($curl);
		return $decode;
	}
	
	public function writePost(string $band_key = '', string $content = '', bool $do_push = false) :array{
		$curl = curl_init();
		$post_file = 'access_token=' . $this->token . '&band_key=' . $band_key . '&content=' . urlencode($content) . '&do_push=' . $do_push;
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, 'https://openapi.band.us/v2.2/band/post/create');
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_file);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $this->token]);
		$json = curl_close($curl);
		$decode = json_decode($json, true);
		curl_close($curl);
		return $decode;
	}
	
	public function deletePost(string $band_key = '', string $post_key = '') :array{
		$curl = curl_init();
		$post_file = 'access_token=' . $this->token . '&band_key=' . $band_key. '&post_key=' . $post_key;
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, 'https://openapi.band.us/v2/band/post/remove?');
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_file);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $acces_token]);
		$json =curl_exec($curl);
		$decode = json_decode($json, true);
		curl_close($curl);
		return $decode;
	}
	
	public function getComments(string $band_key = '', string $post_key = '', string $sort = '+') :array{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://openapi.band.us/v2/band/post/comments?access_token=' . $this->token . '&band_key=' . $band_key . '&post_key=' . $post_key . '&sort=' . $sort . 'created_at');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		$json = curl_exec($curl);
		$decode = json_decode($json, true);
		curl_close($curl);
		return $decode;
	}
	
	public function writeComment(string $band_key = '', string $post_key = '', string $body = '') :array{
		$curl = curl_init();
		$post_file = 'access_token=' . $this->token . '&band_key=' . $band_key . '&post_key=' . $post_key . '&body=' . $body;
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, 'https://openapi.band.us/v2/band/post/comment/create');
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_file);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $acces_token]);
		$json = curl_exec($curl);
		$decode = json_decode($json, true);
		curl_close($curl);
		return $decode;
	}
	
	public function deleteComment(string $band_key = '', string $post_key = '', string $comment_key = '') :array{
		$curl = curl_init();
		$post_file = 'access_token=' . $acces_token . '&band_key=' . $band_keys . '&post_key=' . $post_key . '&comment_key=' . $comment_key;
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, 'https://openapi.band.us/v2/band/post/comment/remove');
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_file);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $acces_token]);
		$json = curl_exec($curl);
		$decode = json_decode($json, true);
		curl_close($curl);
		return $decode;
	}
	
	public function getPermissions(string $band_key = '', string $permissions = 'posting,commenting,contents_deletion') :array{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://openapi.band.us/v2/band/permissions?access_token=' . $this->token . '&band_key=' . $band_key . '&permissions=' . $permissions);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		$json = curl_exec($curl);
		$decode = json_decode($json, true);
		curl_close($curl);
		return $json;
	}
	
}