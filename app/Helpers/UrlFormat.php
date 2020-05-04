<?

namespace App\helpers;

use Illuminate\Support\Facades\DB;

class UrlFormat {

	public static function url_limpia($string){
		$string = htmlentities($string);
		$string = mb_strtolower($string);
		$string = preg_replace('/\&(.)[^;]*;/', '\\1', $string);
		return str_replace(" ", "-", $string);
	}

	public static function add_zeros($numero, $cant='5'){
		$long = strlen($numero);
		$rest = $cant - $long;
		for($i=0;$i<$rest;$i++) :
			$numero = "0".$numero;
		endfor;
		return $numero;
	}

}