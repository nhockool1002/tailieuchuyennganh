<?php
namespace App\Helpers\Traits;
use Illuminate\Support\Facades\Log;
use Exception;

trait LinkTrait
{
	/**
	 * generateShrinkearn function will be generate shrinkearn 
	 * @param $name string
	 * @param $url string
	 * @return boolean | string
	 */
	public function generateShrinkearn($name, $url) {
		try {
			$long_url = urlencode($url);
			$api_token = env('SHRINKEARN_KEY');
			$api_url = env('SHRINKEARN_URL') . "api={$api_token}&url={$long_url}&alias={$name}";
			$result = @json_decode(file_get_contents($api_url),TRUE);
			
			if ($result["status"] === 'error') {
				return false;
			} else {
				return $result["shortenedUrl"];
			}
		} catch (Exception $e) {
			Log::info('LinkTrait - generateShrinkearn');
			Log::error($e);
			return false;
		}
	}
}
