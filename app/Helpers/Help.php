<?

namespace App\helpers;

use Illuminate\Support\Facades\DB;

use App\Store;

class Help {

	/* Compruebo si el usuario es administrador del negocio
	---------------------------------------------------- */
	public static function isAdmin($alias){
		$store = Store::where('alias', $alias)->first();
		foreach($store->admins as $admin){
			$adminers[] = $admin->user->id;
		}
		if(in_array(\Auth::user()->id, $adminers)){
			return true;
		} else {
			return false;
		}
	}


	/* Comprueba si el negocio no está eliminado
	---------------------------------------------------- */
	public static function isDeleted($alias){
		$store = Store::where('alias', $alias)->first();
		if($store->deleted == 1){
			return true;
		} else {
			return false;
		}
	}


	/* Comprueba si el negocio está activo
	---------------------------------------------------- */
	public static function isActive($alias){
		$store = Store::where('alias', $alias)->first();
		if($store->status == 1){
			return true;
		} else {
			return false;
		}
	}


	/* Comprueba si el negocio existe
	---------------------------------------------------- */
	public static function exists($alias){
		$store = Store::where('alias', $alias)->first();
		if(is_object($store)){
			return true;
		} else {
			return false;
		}
	}


	/* Obtiene keywords de una frase
	---------------------------------------------------- */
	public static function keywords($text){
		$not = array("a","de","al","del","y","e","para","por","con","sin","en","varios","muchos","lindos","motivos");
		$text_clean = preg_replace("([^A-Za-z0-9 áéíóúüñ])", "", $text);
		$words = explode(" ", $text_clean);
		foreach($words as $word){
			if(!in_array($word, $not) && strlen($word)>3){
				$ok[] = $word;
			}
		}
		return $ok;
	}


	/* Consulto si el item está en el carrito
	---------------------------------------------------- */
	public static function inCart($item_id){
		$in_cart = false;
		if(session('cart')){
			foreach(session('cart') as $sess){
				if($sess['id'] == $item_id){
					$in_cart = true;
				}
			}
		}
		return $in_cart;
	}


}